<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProductController extends Controller
{
    //
// for index
    public function index(Request $request, Product $products){
        $products = Product::query()->orderby('created_at', 'desc')->simplepaginate(4);
      
        return view('products.index',['products'=> $products]);
    }



    // / for create
    public function create(){
        return view('products.create');
    }
    

    // / for store
        public function store(Request $request){
       $data =$request->validate([
        'username' => 'required|string|max:255',
        'product_name' => 'required|string|max:255',
        'product_description' => 'required|string|max:1000',
        'image'=> 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'price' => 'required|numeric|min:0',

       ]);
        // Handle file upload if an image is provided
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $Extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $Extension;
            $path = 'public/images/';
            $file->move($path, $filename);
            $data['image'] = $filename; 
        }
        $save = Product::create($data);
        if($save){
            return redirect()->route('products.index')->with('success', 'Product created successfully!');
        }else{
            return redirect()->back()->with('error', 'Failed to create product.');
        }
    }

// / for edit
    public function edit(Product $product){
        return view('products.edit', ['product' => $product])  ;
    }


    // for update
public function update(Product $product, Request $request){

$data =$request->validate([
        'username' => 'required|string|max:255',
        'product_name' => 'required|string|max:255',
        'product_description' => 'required|string|max:1000',
        'image'=> 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'price' => 'required|numeric|min:0',

       ]);
        // Handle file upload if an image is provided
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $Extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $Extension;
            $path = 'public/images/'.$product->image;
            $file->move($path, $filename);
            $data['image'] = $filename; 
        }
        $save = $product->update($data);
        if($save){
            return redirect()->route('products.index')->with('success', 'Product created successfully!!');
        }else{
            return redirect()->back()->with('error', 'Failed to create product.');
        }
    }


        public function destroy(Product $product){
            if( $product->image){
                $path = 'public/images/'.$product->image;
                // Check if the file exists before attempting to delete it      ;   
                if(file_exists($path)){
                    unlink($path);
                }
            
            $product->delete();

            if(!$product->delete() ){    
                return redirect()->route('products.index');
            }else{
                 return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
            }
           
            
        }
        $product->delete();
        return redirect()->route('products.index')->with('error', 'Failed to delete product.');

}



}