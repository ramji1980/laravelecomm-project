<!DOCTYPE html>
<html>

<head>
 @include('home.css')
 <style type="text/css">
  .div_center{
    display:flex;
    justify-content:center;
    align-items:center;
    padding:30px;
  }
  .detail-box{
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

  <!-- shop section -->

 @include('home.product_details')

  <!-- end shop section -->

  

  <!-- info section -->

  @include('home.footer')

</body>

</html>