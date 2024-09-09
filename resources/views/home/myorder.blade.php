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
  <!-- end hero area -->

  <div class="div_deg">
  <div class="order_deg">
  <table>
    <tr>
        <th>Product Title</th>
        <th>Price</th>
        <th>Image</th>
        <th>Delivery Status</th>
       
    </tr>  
   @foreach($order as $orders)
    <tr>
        <td>{{$orders->product->title}}</td>
        <td>{{$orders->product->price}}</td>
        <td><img width="80px" src="prducts/{{$orders->product->image}}" alt=""></td>
        <td>{{$orders->status}}</td>

       
    </tr>
    @endforeach
</table>
</div>
</div>
   

  <!-- info section -->

  @include('home.footer')

</body>

</html>