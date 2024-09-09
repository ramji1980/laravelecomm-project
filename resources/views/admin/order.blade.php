<!DOCTYPE html>
<html>
  <head> 
   @include('admin.css')
   <style type="text/css">
      .div_deg{
        display:flex;
        justify-content:center;
        align-items:center;
        margin:30px;
    }
    .table_deg{
        text-align:center;
        margin:auto;
        border:2px solid yellowgreen;
        margin-top:50px;
        width:900px;
    }
th{
    background-color: skyblue;
    padding:15px;
    font-size:20px;
    font-weight:bold;
    color:white;
}
td {
    color:white;
    padding:10px;
    border:1px solid skyblue;
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
          <h1 style="color:white"> View Orders</h1>
          <div>
                <table class="table_deg">
                    <tr>
                        <th>Customer Name</th>
                        <th>Customer Address</th>
                        <th>Customer Phone</th>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Product Status</th>
                        <th>Change Status</th>
                        <th>Print PDF</th>

                    </tr>

                    @foreach($data as $orders)
                   
                    <tr>
                        <td>{{$orders->name}}</td>
                        <td>{{$orders->rec_address}}</td>
                        <td>{{$orders->phone}}</td>
                        <td>{{$orders->product->title}}</td>
                        <td>{{$orders->product->price}}</td>
                        <td>{{$orders->status}}</td>
                        <td>
                            <a class="btn btn-danger" href="{{url('on_the_way',$orders->id)}}">On the way</a>
                            <a class="btn btn-success" href="{{url('delivered',$orders->id)}}">Delivered</a>

                        </td>
                        <td>
                            <a class="btn btn-secondary" href="{{url('printpdf',$orders->id)}}">Print PDF</a>
                          

                        </td>
                        
                    </tr>
                    @endforeach
                </table>
            </div>
            </div>
      </div>
    </div>
    <!-- JavaScript files-->
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