<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->get();
        return view('backend.product.index',compact('products'));
    }


     // Chnage product status
     public function ChangeStatus(Request $request){
       
        if($request->mode =='true'){
            DB::table('products')->where('id',$request->id)->update(['status'=>'active']);
        }else{
            DB::table('products')->where('id',$request->id)->update(['status'=>'inactive']);
        }
        return response()->json(['msg'=>'Status updated successfully','status'=>true]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();
        $vendors = User::where('role','vendor')->get();
        return view('backend.product.create',compact('brands','categories','vendors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //return $request->all();
        $this->validate($request,[
            'title' => 'required|string',
            'summary' => 'required|string',
            'description' => 'required|nullable',
            'stock' => 'nullable|numeric',
            'price' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'photo' => 'required',
            'brand_id' => 'nullable',
            'cat_id' => 'required|exists:categories,id',
            'child_cat_id' => 'nullable|exists:categories,id',
            'size' => 'nullable',
            'conditions' => 'nullable|in:new,winter,popular',
            'status' => 'nullable|in:active,inactive',
        ]);

        $data = new Product();

        $data->title = $request->title;
        $data->summary = $request->summary;
        $data->description = $request->description;
        $data->stock = $request->stock;
        $data->price = $request->price;
        $data->discount = $request->discount;
        $data->photo = $request->photo;
        $data->cat_id = $request->cat_id;
        $data->brand_id = $request->brand_id;
        $data->vendor_id = $request->vendor_id;
        $data->child_cat_id = $request->child_cat_id;
        $data->size = $request->size;
        $data->conditions = $request->conditions;
        $data->status = $request->status;
       
        $data->offer_price = $request->price - ($request->price * $request->discount)/100;
        $slug = Str::slug($request->title);
 
        $data->slug =  $slug;
 
        //return $data;
        $existingSlug = Product::where('slug',$slug)->count();
 
        if($existingSlug){
            $slug = time().'-'.$slug;
        } 
 
       $result = $data->save();

       if($result){
        return redirect()->route('product.index')->with('success','Product inserted successfully');
       }else{
           return back()->with('error','Something went wrong');
       }


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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
