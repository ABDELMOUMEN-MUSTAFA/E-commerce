<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;

class UserController extends Controller
{
    public function index()
    {
        return view('app.users.index', ['users' => User::where('id', '!=', auth()->user()->id)->get()]);
    }

    public function create()
    {
    	return view('app.users.createAdmin', ['countries' => Country::all()]);
    }

    public function store(StoreUserRequest $request) 
    {
    	$validated = $request->validated();
    	$validated['is_admin'] = true;
        $validated['ip_address'] = $request->ip();
    	$validated['password'] = bcrypt($validated['password']);
    	$validated['avatar'] = 'storage/images/avatars/default-avatar.png';
    	User::create($validated);
    	return redirect()->route('users.index')->with('message', 'Admin created successfully.');
    }

    public function show(User $user)
    {        
        $boughtProducts = DB::table('users')
        ->select(DB::raw('COUNT(DISTINCT product_id) as boughtProducts'))
        ->where('users.id', $user->id)
        ->join('orders', 'users.id', '=', 'orders.user_id')
        ->join('order_product', 'orders.id', '=', 'order_id')
        ->groupBy('users.id')
        ->get();

        $revenue = DB::table('users')
        ->select(DB::raw('SUM(unit_price * quantity) AS revenue'))
        ->where('users.id', $user->id)
        ->join('orders', 'users.id', '=', 'orders.user_id')
        ->join('order_product', 'orders.id', '=', 'order_id')
        ->groupBy('users.id')
        ->get();

        $boughtProductsDetails = DB::table('users')
        ->select(DB::raw('
            products.name,
            unit_price,
            order_product.quantity,
            unit_price * order_product.quantity as amount,
            order_product.created_at
        '))
        ->where('users.id', $user->id)
        ->join('orders', 'users.id', '=', 'orders.user_id')
        ->join('order_product', 'orders.id', '=', 'order_id')
        ->join('products', 'order_product.product_id', '=', 'products.id')
        ->get();

        return view('app.users.show', compact('user', 'boughtProducts', 'revenue', 'boughtProductsDetails'));
    }

    public function edit(User $user)
    {
        return view('app.users.edit', ['user' => $user, 'countries' => Country::all()]);
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'phone_number' => 'required|max:25|regex:/^\([0-9]{3}\)\s[0-9]{9}$/',
            'email' => 'required|email|max:255|unique:users',
            'country_id' => 'required|integer|exists:countries,id'
        ]);

        User::where('id', $user->id)->update($validated);
        return redirect()->route('users.index')->with('message', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('message', 'The user deleted successfully.');
    }

    public function toggleActive(User $user)
    {
    	$user->is_active = !$user->is_active;
    	$user->save();
    	if($user->is_active === true){
    		$message = "The account <strong>{$user->email}</strong> activated successfully.";
    	}else{
    		$message = "The account <strong>{$user->email}</strong> disactivated successfully.";
    	}
    	return redirect()->route('users.index')->with('message', $message);
    }

    public function editSettings()
    {
        return view('auth.settings');
    }

    public function updateSettings(UpdateUserRequest $request){
        $validated = array_filter($request->validated());
        unset($validated['current_password']);
        
        if($request->hasFile('avatar')){
        	$validated['avatar'] = 'storage/'.$request->avatar->store('images/avatars', 'public');
        }

        $user = auth()->user();

        if(isset($validated['password'])){
        	$validated['password'] = bcrypt($validated['password']);
        }

        $user->update($validated);

        if($user->wasChanged('email')){
        	$user->update([
        		'email_verified_at' => null
        	]);

        	$user->sendEmailVerificationNotification();
        }
        return back()->with('message', 'Settings updated successfully.');
    }
}
