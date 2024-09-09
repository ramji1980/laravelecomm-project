<!DOCTYPE html>
<html>
  <head> 
   @include('admin.css')
   <style>
    input[type='text']{
        width:350px;
        height:40px;
    }
    input[type='number']{
        width:350px;
        height:40px;
    }
    textarea{
        width:350px;
        height:80px;
    }
   
    .div_deg{
        display:flex;
        justify-content:center;
        align-items:center;
        margin:60px;
    }
    label{
        display:inline-block;
        width:250px;
        font-size:15px!important;
        color:white!important;
    }
    
.input_deg{
    padding:15px;
}
    </style>
  </head>
  <body>
    @include('admin.header')
    @include('admin.sidebar')
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
          <h1 style="color:white"> Edit Product</h1>
          <div class="div_deg">
            <form action="{{url('update_product',$data->slug)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="input_deg">
                <label>Product Title</lable>
                <input class="text" type="text" name="title" value="{{$data->title}}" required>
                </div>
                <div class="input_deg">
                <label>Product Description</lable>
                <textarea name="description" required>{{$data->description}}</textarea>
                </div>
                <div class="input_deg">               
                <label>Product price</lable>
                <input class="text" type="text" name="price" value="{{$data->price}}" required>
                </div>
                <div class="input_deg">
                <label>Product category</lable>
                <select name="category" required>                                     
                        @foreach($category as $category)
                          <option value="{{$category->category_name}}" {{$data->category == $category->category_name  ? 'selected' : ''}}>{{$category->category_name}}</option>
                        @endforeach                   
                </select> 
                </div>
                <div class="input_deg">
                <label>Product quantity</lable>
                <input class="text" type="number" name="qty" value="{{$data->quantity}}" required>
                </div>
                <div class="input_deg">
                <label>Product Image</lable>
                    @if(isset($data->image))
                    <img height="120" width="120" src="/prducts/{{$data->image}}">
                    @else
                    <img height="120" width="120" src="/prducts/no-image.svg">
                    @endif
                <input class="text" type="file" name="image">
                </div>
                <div class="input_deg">
                    <input class="btn btn-primary" type="submit" value="Update product">
                </div>
            </form>
            </div>
            <div>
                
            </div>
            </div>
      </div>
    </div>
    <!-- JavaScript files-->
     
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('/admincss/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('/admincss/vendor/popper.js/umd/popper.min.js')}}"> </script>
    <script src="{{asset('/admincss/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('/admincss/vendor/jquery.cookie/jquery.cookie.js')}}"> </script>
    <script src="{{asset('/admincss/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('/admincss/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('/admincss/js/charts-home.js')}}"></script>
    <script src="{{asset('/admincss/js/front.js')}}"></script>
  </body>
</html>