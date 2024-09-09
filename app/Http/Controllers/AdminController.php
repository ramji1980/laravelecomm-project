<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use Flasher\Prime\FlasherInterface;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    //
    public function view_category(){
        $data=category::all();
        return view('admin.category',compact('data'));
    }

    public function add_category(Request $request){
        $category=new category;
        $category->category_name=$request->category;
        $category->save();
        flash() ->options([
            'timeout' => 3000, // 3 seconds
            'position' => 'top-center',
        ])->success('Category added successfullly!.');
        return redirect()->back();
        //return view('admin.add_category');
    }

    public function edit_category($id){
        $data=category::find($id);
        
        //print_r($data);
        
        return view('admin.edit_category', compact('data'));
    }

    public function update_category(Request $request,$id){
        $data=category::find($id);
        $data->category_name=$request->category;
        $data->save();
        flash() ->options([
            'timeout' => 3000, // 3 seconds
            'position' => 'top-center',
        ])->success('Category updated successfullly!.');
        return redirect('/view_category');
    }
      
    public function delete_category($id){
        $data=category::find($id);
        $data->delete();
        flash() ->options([
            'timeout' => 3000, // 3 seconds
            'position' => 'top-center',
        ])->success('Category deleted successfullly!.');
        return redirect()->back();
    }

    public function add_product(){
        $category=category::all();

        return view('admin.add_product',compact('category'));
    }

    public function insert_product(Request $request){

        $data = new Product;

        $data->title=$request->title;
        $data->description=$request->description;
       
        $data->price=$request->price;
        $data->category=$request->category;
        $data->quantity=$request->qty;

        $image=$request->image;
        if($image){

            $imagename= time().'.'.$image->getClientOriginalExtension();
            $request->image->move('prducts',$imagename);
            $data->image=$imagename;
        }
        


        $data->save();
        flash() ->options([
            'timeout' => 3000, // 3 seconds
            'position' => 'top-center',
        ])->success('Product added successfullly!.');
        return redirect()->back();

    }

    public function view_product(){
        $data=Product::paginate(4);
        return view('admin.view_product',compact('data'));
    }

    public function delete_product($id){
        $data=Product::find($id);

        $image_path=public_path('prducts/'.$data->image);

        if(file_exists($image_path)){
            unlink($image_path);
        }

        $data->delete();
        flash() ->options([
            'timeout' => 3000, // 3 seconds
            'position' => 'top-center',
        ])->success('Product deleted successfullly!.');
        return redirect()->back();
    }

    public function edit_product($slug){
        $data=Product::where('slug',$slug)->get()->first();     
        $category=category::all();         
        return view('admin.edit_product', compact('data','category'));
    }

    public function update_product(Request $request,$slug){
        $data=Product::where('slug',$slug)->get()->first();
        $data->title=$request->title;
        $data->description=$request->description;
       
        $data->price=$request->price;
        $data->category=$request->category;
        $data->quantity=$request->qty;
        if(!isset($request->qty)){
        $image_path=public_path('prducts/'.$data->image);

        if(file_exists($image_path)){
            unlink($image_path);
        }
    }
       $image=$request->image;
        if($image){

            $imagename= time().'.'.$image->getClientOriginalExtension();
            $request->image->move('prducts',$imagename);
            $data->image=$imagename;
        }
        
        $data->save();
        flash() ->options([
            'timeout' => 3000, // 3 seconds
            'position' => 'top-center',
        ])->success('Product updated successfullly!.');
        return redirect('/view_product');
    }

    public function product_search(Request $request)
    {
        $search=$request->search;

        $data=Product::where('title','LIKE','%'.$search.'%')->orwhere('category','LIKE','%'.$search.'%')->paginate(3);
        return view('admin.view_product',compact('data'));

    }

    public function view_orders(){
        $data=Order::all();
        return view('admin.order',compact('data'));
    }

    public function on_the_way($id){
        $data=Order::find($id);
        $data->status='On the way';
        $data->save();
        return redirect('/view_orders');
    }

    public function delivered($id){
        $data=Order::find($id);
        $data->status='Delivered';
        $data->save();
        return redirect('/view_orders');
    }
    
    public function printpdf($id){
        $data=Order::find($id);
        $pdf = Pdf::loadView('admin.invoice',compact('data'));
        return $pdf->download('invoice.pdf');
    }
    
}
