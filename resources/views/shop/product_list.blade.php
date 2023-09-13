<div class="row" id="product-list-container">
    @foreach ($list_product as $product)
    <!-- Single Product Start -->
   <div class="col-lg-4 col-md-4 col-sm-6 col-6">
       <div class="single-product">
          <!-- Product Image Start -->
           <div class="pro-img">
               <a href="{{route('product.detail', $product->id)}}">
                   <img class="primary-img" src="{{asset($product->thumbnail)}}" alt="single-product">
                   <img class="secondary-img" src="{{asset('img\products\7.jpg')}}" alt="single-product">
               </a>
               <a href="#" class="quick_view" data-toggle="modal" data-target="#myModal" title="Quick View"><i class="lnr lnr-magnifier"></i></a>
           </div>
           <!-- Product Image End -->
           <!-- Product Content Start -->
           <div class="pro-content">
               <div class="pro-info">
                   <h4><a href="product.html">{{$product->name}}</a></h4>
                   <p><span class="price">{{number_format($product->price, 0, '', '.')}}đ</span><del class="prev-price">$105.50</del></p>
                   <div class="label-product l_sale">20<span class="symbol-percent">%</span></div>
               </div>
               <div class="pro-actions">
                   <div class="actions-primary">
                       <a href="{{route('cart.add', $product->id)}}" title="Add to Cart"> + Add To Cart</a>
                   </div>
                   <div class="actions-secondary">
                       <a href="compare.html" title="Compare"><i class="lnr lnr-sync"></i> <span>Add To Compare</span></a>
                       <a href="{{route('wishlist.add', $product->id)}}" title="WishList"><i class="lnr lnr-heart"></i> <span>Add to WishList</span></a>
                   </div>
               </div>
           </div>
           <!-- Product Content End -->
       </div>
   </div>
   <!-- Single Product End -->
@endforeach
</div>
