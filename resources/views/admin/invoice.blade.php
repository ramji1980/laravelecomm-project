<!DOCTYPE html>
<html>
    <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width,intial-scale=1">
</head>

  <body>
    <center>
    <h3>Customer Name:{{$data->name}}</h3>
    <h3>Customer Address:{{$data->rec_address}}</h3>
    <h3>Customer Phone:{{$data->phone}}</h3>
    
    <table>
        <tr>
            <th>Product Name</th>
            <th>Product Price</th>
        </tr>
        <tr>
            
            <td>{{$data->product->title}}</td>
            <td>{{$data->product->price}}</td>
        </tr>
    </table>
    </center>
  </body>
</html>