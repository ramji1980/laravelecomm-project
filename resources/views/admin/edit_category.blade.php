<!DOCTYPE html>
<html lang="en">
<head>
@include('admin.css')
    <style>
    
    input[type='text']{
        width:400px;
        height:40px;
    }
    .div_deg{
        display:flex;
        justify-content:center;
        align-items:center;
        margin:30px;
    }
        </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
</head>
<body>
@include('admin.header')
@include('admin.sidebar')
<div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
    <h1>Edit Category</h1>
    <div class="div_deg">    
            <form action="{{url('update_category',$data->slug)}}" method="post">
                @csrf
                <div>
                    <input class="text" type="text" name="category" value="{{$data->category_name}}">
                    <input class="btn btn-primary" type="submit" value="Edit Category">
                 </div>
            </form>
            </div>
            </div>
      </div>
    </div>
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