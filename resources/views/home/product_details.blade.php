<section class="shop_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Latest Products
        </h2>
      </div>
      <div class="row">
        
        <div class="col-md-10">
          <div class="box">
           
              <div class="img-box">
                <div class="div_center">
                    <img width="100" src="/prducts/{{$product->image}}" alt="">
                </div>
              </div>
              <div class="detail-box">
                <h6>
                 {{$product->title}}
                </h6>
                <h6>
                  Price
                  <span>
                    ${{$product->price}}
                  </span>
                </h6>
              </div>

              <div class="detail-box">
                <h6>
                Category: {{$product->category}}
                </h6>
                <h6>
                  Available Quantity
                  <span>
                    {{$product->quantity}}
                  </span>
                </h6>
              </div>

              <div class="detail-box">
              
                  <p>{{$product->description}}</p>
              </div>
              <div style="padding:15px">
             
              <a class="btn btn-primary" href="{{url('add_cart',$product->id)}}">Add To Cart</a>
            </div>
          </div>
        </div>
      
      </div>
     
    </div>
  </section>