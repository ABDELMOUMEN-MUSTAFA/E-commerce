<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Product;
use App\Http\Requests\StoreFileRequest;
use App\Http\Requests\UpdateFileRequest;
use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product)
    {
        return view('app.admin.products.files.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'bail|required|numeric|exists:products,id',
            'files' => 'required|mimes:jpg,png,zip,svg,rar,7z,txt,pdf|between:2,30000'
        ]);

        if($request->hasFile('files')){
            $source = 'storage/'.$request->file('files')->store('images/products/files/'.$validated['product_id'], 'public');
            $filename = $request->file('files')->getClientOriginalName();
            $file = new File;
            $file->product_id = $validated['product_id'];
            $file->name = $filename;
            $size = $request->file('files')->getSize();
            if($size >= 1024000){
                $file->size = (round($size / 1024000, 2))." MB";
            }else{
                $file->size = (round($size / 1024, 2)).' KB';
            }
            $file->source = $source; 
            $file->save();
            return response()->json([
                "message" => "The File ".$filename." uploaded successfully."
            ]);
        }else{
            abort(400);
        }
    }

    public function download(File $file)
    {
        return response()->download($file->source);
    }

    public function rename(Request $request, File $file){
        $validated = $request->validate([
            'name' => 'bail|required|between:3,25|regex:/^[a-zA-Z0-9\-_\.]+$/',
        ]);

        if(substr($validated['name'], -3) === substr($file->name, -3)){
            $file->name = $validated['name'];
        }else{
            $file->name = $validated['name'].'.'.substr($file->name, -3);
        }
        $file->save();
        return response()->json(['message' => 'The file renamed to <strong>'.$validated['name'].'</strong> successfully.']);
    }

    public function destroy(File $file)
    {
        $file->delete();
        return redirect()->back()->with('message', 'The file <strong>'.$file->name.'</strong> deleted successfully.');
    }
}
