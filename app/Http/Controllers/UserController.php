<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;

class UserController extends Controller
{
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
