<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Flasher\Prime\FlasherInterface;
use Session;
use Stripe;
class HomeController extends Controller
{
    //
    public function index(){
        $user=User::where('usertype','user')->get()->count();
        $product=Product::all()->count();
        $order=Order::all()->count();
        $orderdelivered=Order::where('status','Delivered')->get()->count();
        return view('admin.index',compact('user','product','order','orderdelivered'));
    }

    public function home(){
        $product=Product::all();
        if(Auth::id()){
            $user=Auth::user();
        $user_id=$user->id;
        $count=Cart::where('user_id',$user_id)->count();
        } else {
            
            $count='';
        }
        
        return view('home.index',compact('product','count'));
    }

    public function shop(){
        $product=Product::all();
        if(Auth::id()){
            $user=Auth::user();
        $user_id=$user->id;
        $count=Cart::where('user_id',$user_id)->count();
        } else {
            
            $count='';
        }
        
        return view('home.shop',compact('product','count'));
    }

    public function testimonial(){
        
        if(Auth::id()){
            $user=Auth::user();
        $user_id=$user->id;
        $count=Cart::where('user_id',$user_id)->count();
        } else {
            
            $count='';
        }
        
        return view('home.testimonial',compact('count'));
    }

    public function why(){
        
        if(Auth::id()){
            $user=Auth::user();
        $user_id=$user->id;
        $count=Cart::where('user_id',$user_id)->count();
        } else {
            
            $count='';
        }
        
        return view('home.why',compact('count'));
    }

    public function contact(){
        
        if(Auth::id()){
            $user=Auth::user();
        $user_id=$user->id;
        $count=Cart::where('user_id',$user_id)->count();
        } else {
            
            $count='';
        }
        
        return view('home.contact',compact('count'));
    }

    public function login_home(){
        $product=Product::all();
        if(Auth::id()){
            $user=Auth::user();
            $user_id=$user->id;
            $count=Cart::where('user_id',$user_id)->count();
            } else {
                
                $count='';
            }
        return view('home.index',compact('product','count'));
    }

    public function view_details($id){
        $product=Product::find($id);
        if(Auth::id()){
        $user=Auth::user();
        $user_id=$user->id;
        $count=Cart::where('user_id',$user_id)->count();
        } else {
            
            $count='';
        }
        return view('home.view_details',compact('product','count'));
    }

    public function add_cart($id){
        $productid=$id;
        $user=Auth::user();
        $userid=$user->id;
        $data=new Cart;
        $data->user_id=$userid;
        $data->product_id=$productid;
        $data->save();
        flash() ->options([
            'timeout' => 3000, // 3 seconds
            'position' => 'top-center',
        ])->success('Product added successfullly in Cart!.');
        
        return redirect()->back();
    }

    public function mycart(){    
        if(Auth::id()){
        $user=Auth::user();
        $user_id=$user->id;
        $count=Cart::where('user_id',$user_id)->count();
        $cart=Cart::where('user_id',$user_id)->get();
        } else {            
            $count='';
        } 

        return view('home.mycart',compact('count','cart'));
    }

    public function delete_cart($id){
        $data=Cart::find($id);
        $data->delete();
        
        return redirect()->back();
    }
    public function confirm_order(Request $request){
        
        $name=$request->name;
        $recaddress=$request->address;
        $phone= $request->phone;
        $userid=Auth::user()->id;
        $cart=Cart::where('user_id',$userid)->get();

        foreach($cart as $carts){
            $confirmorder=new Order;
            $confirmorder->name=$name;
            $confirmorder->rec_address=$recaddress;
            $confirmorder->phone=$phone;
            $confirmorder->user_id=$userid;
            $confirmorder->product_id=$carts->product_id;

            $confirmorder->save();
        }
$cart_remove=Cart::where('user_id',$userid)->get();
        foreach($cart_remove as $cartremove){
            $data=Cart::find($cartremove->id);
            $data->delete();
        }

        flash() ->options([
            'timeout' => 3000, // 3 seconds
            'position' => 'top-center',
        ])->success('Product order added successfullly!.');
        
        return redirect()->back();
    }

    public function myorder(){
        
        if(Auth::id()){
            $user=Auth::user();
            $user_id=$user->id;
            $count=Cart::where('user_id',$user_id)->count();
            $order=Order::where('user_id',$user_id)->get();
            } else {
                $count='';
                $order='';
            }
        return view('home.myorder',compact('count','order'));
    }

    public function stripe($value)
    {
        return view('home.stripe',compact('value'));
    }
    public function stripePost(Request $request,$value)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
        Stripe\Charge::create ([
                "amount" => $value * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test Laravel Ecommerce." 
        ]);
      
        $name=Auth::user()->name;
        $recaddress=Auth::user()->address;
        $phone= Auth::user()->phone;
        $userid=Auth::user()->id;
        $cart=Cart::where('user_id',$userid)->get();

        foreach($cart as $carts){
            $confirmorder=new Order;
            $confirmorder->name=$name;
            $confirmorder->rec_address=$recaddress;
            $confirmorder->phone=$phone;
            $confirmorder->user_id=$userid;
            $confirmorder->product_id=$carts->product_id;
            $confirmorder->payment_status='paid';

            $confirmorder->save();
        }
$cart_remove=Cart::where('user_id',$userid)->get();
        foreach($cart_remove as $cartremove){
            $data=Cart::find($cartremove->id);
            $data->delete();
        }

        flash() ->options([
            'timeout' => 3000, // 3 seconds
            'position' => 'top-center',
        ])->success('Payment successfullly!.');
        
        return redirect('/mycart');
    }
}
