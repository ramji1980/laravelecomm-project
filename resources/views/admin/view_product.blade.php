<!DOCTYPE html>
<html>
  <head> 
   @include('admin.css')
   <style>    
   .div_deg{
        display:flex;
        justify-content:center;
        align-items:center;
        margin:60px;
    }
    .table_deg{
        text-align:center;
        margin:auto;
        border:2px solid yellowgreen;
        margin-top:50px;
        width:600px;
    }
     
th{
    background-color: skyblue;
    padding:19px;
    font-size:20px;
    font-weight:bold;
    color:white;
}
td {
    color:white;
    padding:10px;
    border:1px solid skyblue;
}
input[type='search']{
    margin-left:90px;
    width:500px;
    height:60px;
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
            <form method="get" action="{{url('product_search')}}">
                <input type="search" name="search">
                <input type="submit" class="btn btn-success" value="Search">
            </form>
           <h1 style="color:white">All Product</h1>
           <div>
                <table class="table_deg">
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Image</th>
                        
                        <th>Edit</th>
                        <th>Delete</th>

                    </tr>
                    @foreach($data as $products)
                    
                    <tr>
                        <td>{{$products->title}}</td>
                        <td>{!!Str::limit($products->description,2)!!}</td>
                        <td>{{$products->category}}</td>
                        <td>{{$products->price}}</td>
                        <td>{{$products->quantity}}</td>
                        
                        <td>
                        @if(isset($products->image))
                <img height="120" width="120" src="/prducts/{{$products->image}}">
                @else
                <img height="120" width="120" src="/prducts/no-image.svg">
                @endif
                          
                        </td>
                       
                        <td><a class="btn btn-info" href="{{url('edit_product',$products->slug)}}">Edit</a></td>
                        <td><a class="btn btn-danger" onclick="confirmation(event)" href="{{url('delete_product',$products->id)}}">Delete</a></td>
                    </tr>
                    @endforeach  
                </table>
            </div>
            <div class="div_deg">
                 {{$data->onEachSide(2)->links()}}
</div>
            </div>
      </div>
    </div>
    <!-- JavaScript files-->
    <script type="text/javascript">
        function confirmation(ev){
            ev.preventDefault();
            var urltoRedirect=ev.currentTarget.getAttribute('href');
            swal({
                title:"Are you sure delete this",
                text:"This delete will permanent",
                icon:"warning",
                buttons:true,
                dangerMode:true,
            })
            .then((willCancel)=>{
                if(willCancel){
                    window.location.href=urltoRedirect;
                }

            });
        }
        </script>
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