<!DOCTYPE html>
<html>

<head>
 @include('home.css')
 <style type="text/css">
     .div_deg{
        display:flex;
        justify-content: center;
        align-items:center;
        margin:60px;
    }
    table{
        border: 2px solid black;
        text-align:center;
        width:800px;
    }
    th{
        border:2px solid black;
        text-align:center;
        color:white;
        font:20px;
        font-weight:bold;
        background-color:black;
        width:800px;
    }
   
    td{
        border: 1px solid skyblue;
    }
    .cart_totdeg{
        text-align:center;
        font-weight:bold;
    }
    .order_deg{
        padding-right:150px;
        margin-top:-40px;
    }
    label:{
        display:inline-block;
        width:50px;
    }
    .div_gap{
        padding:15px;
    }
 </style>   
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
   @include('home.header')
    <!-- end header section -->
  
  </div>
  <div class="div_deg">

  
  
  <table>
    <tr>
        <th>Product Title</th>
        <th>Price</th>
        <th>Image</th>
        <th>Remove</th>
    </tr>  
    <?php
    $value=0;
    ?>
    @foreach($cart as $cart)
    <tr>
        <td>{{$cart->product->title}}</td>
        <td>{{$cart->product->price}}</td>
        <td><img width="80px" src="prducts/{{$cart->product->image}}" alt=""></td>
        <td><a href="{{url('delete_cart',$cart->id)}}" class="btn btn-danger">Remove</td>
    </tr>
    <?php
    $value=$value + $cart->product->price;
    ?>
    @endforeach
</table>
</div>
       <div class="cart_totdeg"> Total cart value is: ${{$value}} </div>

       <div class="order_deg">
    <form action="{{url('confirm_order')}}" method="post">
        @csrf
        <div class="div_gap">
            <label>Receiver Name</label>
            <input type="text" name="name" value="{{Auth::user()->name}}">
        </div>
        <div class="div_gap">
            <label>Receiver Address</label>
            <textarea name="address">{{Auth::user()->address}}</textarea>
        </div>
        <div class="div_gap">
            <label>Receiver Phone</label>
            <input type="text" name="phone" value="{{Auth::user()->phone}}">
        </div>
        
        <div class="div_gap">             
            <input class="btn btn-danger" type="submit" value="Cash on Delivery">
            <a class="btn btn-primary" href="{{url('stripe',$value)}}">Pay using cards</a>
        </div>
    </form>
 </div>
  @include('home.footer')

</body>

</html>