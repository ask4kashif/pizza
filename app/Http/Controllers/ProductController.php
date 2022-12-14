<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::latest()->paginate(10);
        return view('admin.indexProduct',[
            'products'=>$products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.createProduct');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'description'=>'required',
            'price'=>'required|integer',
            'category_id'=>'required',
            'image'=>'required|mimes:png,jpg,jpeg'
        ]);

         $image=$request->file('image');
         $name=time().'.'.$image->getClientOriginalExtension();
         $destinationPath=public_path('/images');
         $image->move($destinationPath,$name);

         $product=Product::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'price'=>$request->price,
            'image'=>$name,
            'category_id'=>$request->category_id,
            'slug'=>Str::slug($request->name,'-'),
         ]);

         return redirect()->back()->with('status','Product created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $product=Product::where('slug',$slug)->first();
        return view('admin.editProduct',[
            'product'=>$product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $request->validate([
            'name'=>'required',
            'description'=>'required',
            'price'=>'required|integer',
            'category_id'=>'required',
            'image'=>'mimes:png,jpg,jpeg'
        ]);

        $product=Product::where('slug',$slug)->first();
        $name=$product->image;

        if($request->hasFile('image')){
            $image=$request->file('image');
            $image_path = public_path('/images/').$name;  // prev image path
                if(file_exists($image_path)) {
                    unlink($image_path);
                }
            $name=time().'.'.$image->getClientOriginalExtension();
            $destinationPath=public_path('/images');
            $image->move($destinationPath,$name);
        }
        $product->name=$request->name;
        $product->description=$request->description;
        $product->price=$request->price;
        $product->image=$name;
        $product->category_id=$request->category_id;
        $product->slug=Str::slug($request->name,'-');
        $product->save();
        return redirect()->route('product.index')->with('status','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $product=Product::where('slug',$slug)->first();
        $product->delete();
        return redirect()->route('product.index')->with('status','Product deleted sucessfully');
    }
}
