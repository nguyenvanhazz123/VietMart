<div class="row" id="product-list-container">
    @foreach ($list_product as $product)
    <!-- Single Product Start -->
   <div class="col-lg-4 col-md-4 col-sm-6 col-6">
       <div class="single-product">
          <!-- Product Image Start -->
           <div class="pro-img">
               <a href="{{route('product.detail', $product->id)}}">
                   <img class="primary-img" src="{{asset($product->thumbnail)}}" alt="single-product">                   
               </a>
               <a href="#" class="quick_view" data-toggle="modal" data-target="#myModal" title="Quick View"><i class="lnr lnr-magnifier"></i></a>
           </div>
           <!-- Product Image End -->
           <!-- Product Content Start -->
           <div class="pro-content">
               <div style="text-align: center" class="pro-info">
                   <h4><a href="product.html">{{$product->name}}</a></h4> 
                   <p><span class="price priceName">{{number_format($product->price, 0, '', '.')}}đ</span></p>                  
               </div>
               <div class="pro-actions">
                   {{-- <div class="actions-primary">
                        <a href="#" data-product-id="{{ $product->id }}" class="add-to-cart" title="Add to Cart"> + Add To Cart</a>
                   </div> --}}
                   <div class="actions-secondary">                    
                        <a href="#" title="WishList" data-product-id="{{ $product->id }}" class="add-to-wishlist"><i style="color: red"  class="lnr lnr-heart"></i> <span style="color: red;" >Add to WishList</span></a>
                   </div>
               </div>
           </div>
           <!-- Product Content End -->
       </div>
   </div>
   <!-- Single Product End -->
@endforeach
</div>
