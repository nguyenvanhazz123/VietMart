@extends('layouts.layout_guest')
@section('content')
            <!-- Categorie Menu & Slider Area Start Here -->
            <div class="main-page-banner home-3">
                <div class="container">
                    <div class="row">
                        <!-- Vertical Menu Start Here -->
                        <div class="col-xl-3 col-lg-4 d-none d-lg-block">
                            <div class="vertical-menu mb-all-30">
                                <nav>
                                    <ul class="vertical-menu-list">
                                        @foreach ($list_industry as $industry)                                   
                                            <li class="@if(isset($industry_id) && $industry_id == $industry->id) active @endif"><a href="{{route('industry_list', ['industry' => $industry->id])}}"><span><img src="{{asset('img\vertical-menu\1.png')}}" alt="menu-icon"></span>{{$industry->name}}</a></li>                                       
                                        @endforeach
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <!-- Vertical Menu End Here -->
                    </div>
                    <!-- Row End -->
                </div>
                <!-- Container End -->           
            </div>
            <!-- Categorie Menu & Slider Area End Here -->
            <!-- Breadcrumb Start -->
            <div class="breadcrumb-area mt-30">
                <div class="container">
                    <div class="breadcrumb">
                        <ul class="d-flex align-items-center">
                            <li><a href="index.html">Home</a></li>
                            <li class="active"><a href="product.html">Shop</a></li>
                        </ul>
                    </div>
                </div>
                <!-- Container End -->
            </div>
            <!-- Breadcrumb End -->
            <style>
                .category_ul .active{
                    color: red; ;
                }
            </style>
            <!-- Shop Page Start -->
            <div class="main-shop-page pt-100 pb-100 ptb-sm-60">
                <div class="container">
                    <!-- Row End -->
                    <div class="row">
                        <!-- Sidebar Shopping Option Start -->
                        <div class="col-lg-3 order-2 order-lg-1">
                            <div class="sidebar">
                                <!-- Sidebar Electronics Categorie Start -->
                                <div class="electronics mb-40">
                                    <h3 class="sidebar-title">Danh mục</h3>
                                    <div id="shop-cate-toggle" class="category-menu sidebar-menu sidbar-style">
                                        <ul class="category_ul">
                                            @foreach ($list_industry as $industry)                                   
                                                    @if ($industry->id == $industry_id) 
                                                        @foreach ($industry->segment as $segment)                                             
                                                            <li class="">
                                                                {{-- <a class="{{request()->segment == $segment->id ? 'active' : ''}}" href="{{request()->fullUrlWithQuery(['segment'=>$segment->id])}}">{{$segment->name}}</a> --}}
                                                                <a class="category-link" data-segment-id="{{ $segment->id }}" href="#">{{ $segment->name }}</a>
                                                            </li>
                                                        @endforeach
                                                    @endif   
                                            @endforeach
                                        </ul>
                                    </div>
                                    <!-- category-menu-end -->
                                </div>
                                <!-- Sidebar Electronics Categorie End -->
                                <!-- Price Filter Options Start -->
                                <div class="search-filter mb-40">
                                    <h3 class="sidebar-title">Lọc theo khoảng giá</h3>
                                    <form action="" id="price-filter-form" class="sidbar-style" method="GET">
                                        <div id="slider-range"></div>
                                        <input type="text" id="amount" class="amount-range" readonly="">
                                        <input type="hidden" id="min-price" name="min_price">
                                        <input type="hidden" id="max-price" name="max_price">
                                        <button style="margin-left: 50%; transform: translateX(-50%);" class="btn btn-outline-danger filter-price" type="submit">Áp Dụng</button>
                                    </form>
                                </div>
                                <!-- Price Filter Options End -->
                               
                                
                            
                                <!-- Product Top Start -->
                                <div class="top-new mb-40">
                                    <h3 class="sidebar-title">Top New</h3>
                                    <div class="side-product-active owl-carousel">
                                        <!-- Side Item Start -->
                                        <div class="side-pro-item">
                                            <!-- Single Product Start -->
                                            <div class="single-product single-product-sidebar">
                                                <!-- Product Image Start -->
                                                <div class="pro-img">
                                                    <a href="product.html">
                                                        <img class="primary-img" src="img\products\20.jpg" alt="single-product">
                                                        <img class="secondary-img" src="img\products\19.jpg" alt="single-product">
                                                    </a>
                                                    <div class="label-product l_sale">30<span class="symbol-percent">%</span></div>
                                                </div>
                                                <!-- Product Image End -->
                                                <!-- Product Content Start -->
                                                <div class="pro-content">
                                                    <h4><a href="product.html">Work Lamp Silver Proin</a></h4>
                                                    <p><span class="price">$130.45</span><del class="prev-price">180.50</del></p>
                                                </div>
                                                <!-- Product Content End -->
                                            </div>
                                            <!-- Single Product End -->  
                                            <!-- Single Product Start -->
                                            <div class="single-product single-product-sidebar">
                                                <!-- Product Image Start -->
                                                <div class="pro-img">
                                                    <a href="product.html">
                                                        <img class="primary-img" src="img\products\2.jpg" alt="single-product">
                                                        <img class="secondary-img" src="img\products\1.jpg" alt="single-product">
                                                    </a>
                                                </div>
                                                <!-- Product Image End -->
                                                <!-- Product Content Start -->
                                                <div class="pro-content">
                                                    <h4><a href="product.html">Silver Work Lamp  Proin</a></h4>
                                                    <p><span class="price">$320.45</span><del class="prev-price">$400.50</del></p>
                                                </div>
                                                <!-- Product Content End -->
                                            </div>
                                            <!-- Single Product End --> 
                                            <!-- Single Product Start -->
                                            <div class="single-product single-product-sidebar">
                                                <!-- Product Image Start -->
                                                <div class="pro-img">
                                                    <a href="product.html">
                                                        <img class="primary-img" src="img\products\3.jpg" alt="single-product">
                                                        <img class="secondary-img" src="img\products\4.jpg" alt="single-product">
                                                    </a>
                                                </div>
                                                <!-- Product Image End -->
                                                <!-- Product Content Start -->
                                                <div class="pro-content">
                                                    <h4><a href="product.html">Proin Work Lamp Silver </a></h4>
                                                    <p><span class="price">$150.45</span><del class="prev-price">$200.50</del></p>
                                                </div>
                                                <!-- Product Content End -->
                                            </div>
                                            <!-- Single Product End --> 
                                            <!-- Single Product Start -->
                                            <div class="single-product single-product-sidebar">
                                                <!-- Product Image Start -->
                                                <div class="pro-img">
                                                    <a href="product.html">
                                                        <img class="primary-img" src="img\products\25.jpg" alt="single-product">
                                                        <img class="secondary-img" src="img\products\26.jpg" alt="single-product">
                                                    </a>
                                                </div>
                                                <!-- Product Image End -->
                                                <!-- Product Content Start -->
                                                <div class="pro-content">
                                                    <h4><a href="product.html">Work Lamp Silver Proin</a></h4>
                                                    <p><span class="price">$320.45</span><del class="prev-price">$400.50</del></p>
                                                </div>
                                                <!-- Product Content End -->
                                            </div>
                                            <!-- Single Product End -->                                        
                                        </div>
                                        <!-- Side Item End -->
                                        <!-- Side Item Start -->
                                        <div class="side-pro-item">
                                            <!-- Single Product Start -->
                                            <div class="single-product single-product-sidebar">
                                                <!-- Product Image Start -->
                                                <div class="pro-img">
                                                    <a href="product.html">
                                                        <img class="primary-img" src="img\products\41.jpg" alt="single-product">
                                                        <img class="secondary-img" src="img\products\42.jpg" alt="single-product">
                                                    </a>
                                                </div>
                                                <!-- Product Image End -->
                                                <!-- Product Content Start -->
                                                <div class="pro-content">
                                                    <h4><a href="product.html">Silver Work Lamp  Proin</a></h4>
                                                    <p><span class="price">$80.45</span><del class="prev-price">$100.50</del></p>
                                                </div>
                                                <!-- Product Content End -->
                                            </div>
                                            <!-- Single Product End -->  
                                            <!-- Single Product Start -->
                                            <div class="single-product single-product-sidebar">
                                                <!-- Product Image Start -->
                                                <div class="pro-img">
                                                    <a href="product.html">
                                                        <img class="primary-img" src="img\products\36.jpg" alt="single-product">
                                                        <img class="secondary-img" src="img\products\35.jpg" alt="single-product">
                                                    </a>
                                                </div>
                                                <!-- Product Image End -->
                                                <!-- Product Content Start -->
                                                <div class="pro-content">
                                                    <h4><a href="product.html">Silver Work Lamp  Proin</a></h4>
                                                    <p><span class="price">$320.45</span><del class="prev-price">$400.50</del></p>
                                                </div>
                                                <!-- Product Content End -->
                                            </div>
                                            <!-- Single Product End --> 
                                            <!-- Single Product Start -->
                                            <div class="single-product single-product-sidebar">
                                                <!-- Product Image Start -->
                                                <div class="pro-img">
                                                    <a href="product.html">
                                                        <img class="primary-img" src="img\products\33.jpg" alt="single-product">
                                                        <img class="secondary-img" src="img\products\34.jpg" alt="single-product">
                                                    </a>
                                                </div>
                                                <!-- Product Image End -->
                                                <!-- Product Content Start -->
                                                <div class="pro-content">
                                                    <h4><a href="product.html">Lamp Proin Work  Silver </a></h4>
                                                    <p><span class="price">$120.45</span><del class="prev-price">130.50</del></p>
                                                </div>
                                                <!-- Product Content End -->
                                            </div>
                                            <!-- Single Product End --> 
                                            <!-- Single Product Start -->
                                            <div class="single-product single-product-sidebar">
                                                <!-- Product Image Start -->
                                                <div class="pro-img">
                                                    <a href="product.html">
                                                        <img class="primary-img" src="img\products\31.jpg" alt="single-product">
                                                        <img class="secondary-img" src="img\products\32.jpg" alt="single-product">
                                                    </a>
                                                </div>
                                                <!-- Product Image End -->
                                                <!-- Product Content Start -->
                                                <div class="pro-content">
                                                    <h4><a href="product.html">Work Lamp Silver Proin</a></h4>
                                                    <p><span class="price">$140.45</span><del class="prev-price">$150.50</del></p>
                                                </div>
                                                <!-- Product Content End -->
                                            </div>
                                            <!-- Single Product End -->                                        
                                        </div>
                                        <!-- Side Item End -->
                                        <!-- Side Item Start -->
                                        <div class="side-pro-item">
                                            <!-- Single Product Start -->
                                            <div class="single-product single-product-sidebar">
                                                <!-- Product Image Start -->
                                                <div class="pro-img">
                                                    <a href="product.html">
                                                        <img class="primary-img" src="img\products\15.jpg" alt="single-product">
                                                        <img class="secondary-img" src="img\products\16.jpg" alt="single-product">
                                                    </a>
                                                </div>
                                                <!-- Product Image End -->
                                                <!-- Product Content Start -->
                                                <div class="pro-content">
                                                    <h4><a href="product.html">Lamp Work Silver Proin</a></h4>
                                                    <p><span class="price">$320.45</span><del class="prev-price">$400.50</del></p>
                                                </div>
                                                <!-- Product Content End -->
                                            </div>
                                            <!-- Single Product End -->  
                                            <!-- Single Product Start -->
                                            <div class="single-product single-product-sidebar">
                                                <!-- Product Image Start -->
                                                <div class="pro-img">
                                                    <a href="product.html">
                                                        <img class="primary-img" src="img\products\17.jpg" alt="single-product">
                                                        <img class="secondary-img" src="img\products\18.jpg" alt="single-product">
                                                    </a>
                                                    <div class="label-product l_sale">30<span class="symbol-percent">%</span></div>
                                                </div>
                                                <!-- Product Image End -->
                                                <!-- Product Content Start -->
                                                <div class="pro-content">
                                                    <h4><a href="product.html">Silver Work Lamp  Proin</a></h4>
                                                    <p><span class="price">$320.45</span><del class="prev-price">$400.50</del></p>
                                                </div>
                                                <!-- Product Content End -->
                                            </div>
                                            <!-- Single Product End --> 
                                            <!-- Single Product Start -->
                                            <div class="single-product single-product-sidebar">
                                                <!-- Product Image Start -->
                                                <div class="pro-img">
                                                    <a href="product.html">
                                                        <img class="primary-img" src="img\products\23.jpg" alt="single-product">
                                                        <img class="secondary-img" src="img\products\24.jpg" alt="single-product">
                                                    </a>
                                                </div>
                                                <!-- Product Image End -->
                                                <!-- Product Content Start -->
                                                <div class="pro-content">
                                                    <h4><a href="product.html">Proin Work Lamp Silver </a></h4>
                                                    <p><span class="price">$320.45</span><del class="prev-price">$400.50</del></p>
                                                </div>
                                                <!-- Product Content End -->
                                            </div>
                                            <!-- Single Product End --> 
                                            <!-- Single Product Start -->
                                            <div class="single-product single-product-sidebar">
                                                <!-- Product Image Start -->
                                                <div class="pro-img">
                                                    <a href="product.html">
                                                        <img class="primary-img" src="img\products\25.jpg" alt="single-product">
                                                        <img class="secondary-img" src="img\products\26.jpg" alt="single-product">
                                                    </a>
                                                </div>
                                                <!-- Product Image End -->
                                                <!-- Product Content Start -->
                                                <div class="pro-content">
                                                    <h4><a href="product.html">Work Lamp Silver Proin</a></h4>
                                                    <p><span class="price">$320.45</span><del class="prev-price">$400.50</del></p>
                                                </div>
                                                <!-- Product Content End -->
                                            </div>
                                            <!-- Single Product End -->                                        
                                        </div>
                                        <!-- Side Item End -->
                                    </div>
                                </div>
                                <!-- Product Top End -->                            
                                <!-- Single Banner Start -->
                                <div class="col-img">
                                    <a href="shop.html"><img src="img\banner\banner-sidebar.jpg" alt="slider-banner"></a>
                                </div>
                                <!-- Single Banner End -->
                            </div>
                        </div>
                        <!-- Sidebar Shopping Option End -->
                        <!-- Product Categorie List Start -->
                        <div class="col-lg-9 order-1 order-lg-2">
                            <!-- Grid & List View Start -->
                            <div class="grid-list-top border-default universal-padding d-md-flex justify-content-md-between align-items-center mb-30">
                                <div class="grid-list-view  mb-sm-15">
                                    <ul class="nav tabs-area d-flex align-items-center">
                                        <li><a class="active" data-toggle="tab" href="#grid-view"><i class="fa fa-th"></i></a></li>
                                        <li><a data-toggle="tab" href="#list-view"><i class="fa fa-list-ul"></i></a></li>
                                    </ul>
                                </div>
                                <!-- Toolbar Short Area Start -->
                                {{-- <form id="form_order_by" method="GET"> --}}
                                    <div class="main-toolbar-sorter clearfix">
                                        <div class="toolbar-sorter d-flex align-items-center">
                                            <label>Sắp xếp:</label>
                                            <select name="orderby" class="sorter wide order_by">
                                                <option value="" {{ request('orderby') == '' ? 'selected' : '' }}>Mặc định</option>
                                                <option value="name_asc" {{ request('orderby') == 'name_asc' ? 'selected' : '' }}>Từ A đến Z</option>
                                                <option value="name_desc" {{ request('orderby') == 'name_desc' ? 'selected' : '' }}>Từ Z đến A</option>
                                                <option value="price_max" {{ request('orderby') == 'price_max' ? 'selected' : '' }}>Giá tăng dần</option>
                                                <option value="price_min" {{ request('orderby') == 'price_min' ? 'selected' : '' }}>Giá giảm dần</option>
                                            </select>
                                            
                                        </div>
                                    </div>
                                    
                                {{-- </form> --}}
                                <!-- Toolbar Short Area End -->
                                <!-- Toolbar Short Area Start -->
                                <div class="main-toolbar-sorter clearfix">
                                    <div class="toolbar-sorter d-flex align-items-center">
                                        <label>Show:</label>
                                        <select class="sorter wide">
                                            <option value="12">12</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="75">75</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Toolbar Short Area End -->
                            </div>
                            <!-- Grid & List View End -->
                            <div class="main-categorie mb-all-40">
                                <!-- Grid & List Main Area End -->
                                <div class="tab-content fix">
                                    <div id="grid-view" class="tab-pane fade show active">
                                        
                                            @include('shop.product_list')
                                           
                                       
                                        <!-- Row End -->
                                    </div>
                                    <!-- #grid view End -->
                                    <div id="list-view" class="tab-pane fade">
                                        @foreach ($list_product as $product)
                                              <!-- Single Product Start -->
                                        <div class="single-product"> 
                                            <div class="row">        
                                                <!-- Product Image Start -->
                                                <div class="col-lg-4 col-md-5 col-sm-12">
                                                    <div class="pro-img">
                                                        <a href="{{route('product.detail', $product->id)}}">
                                                            <img class="primary-img" src="{{asset($product->thumbnail)}}" alt="single-product">
                                                            <img class="secondary-img" src="img\products\24.jpg" alt="single-product">
                                                        </a>
                                                        <a href="#" class="quick_view" data-toggle="modal" data-target="#myModal" title="Quick View"><i class="lnr lnr-magnifier"></i></a>
                                                         <span class="sticker-new">new</span>
                                                    </div>
                                                </div>
                                                <!-- Product Image End -->
                                                <!-- Product Content Start -->
                                                <div class="col-lg-8 col-md-7 col-sm-12">
                                                    <div class="pro-content hot-product2">
                                                        <h4><a href="product.html">{{$product->name}}</a></h4>
                                                        <p><span class="price">{{number_format($product->price, 0, '', '.')}}đ</span></p>
                                                        <p>{!! $product->description !!}</p>
                                                        <div class="pro-actions">
                                                            <div class="actions-primary">
                                                                <a href="{{route('cart.add', $product->id)}}" title="" data-original-title="Add to Cart"> + Add To Cart</a>
                                                            </div>
                                                            <div class="actions-secondary">
                                                                <a href="compare.html" title="" data-original-title="Compare"><i class="lnr lnr-sync"></i> <span>Add To Compare</span></a>
                                                                <a href="{{route('wishlist.add', $product->id)}}" title="" data-original-title="WishList"><i class="lnr lnr-heart"></i> <span>Add to WishList</span></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Product Content End -->
                                            </div>
                                        </div>
                                        <!-- Single Product End -->
                                        @endforeach
                                      

                                    </div>
                                    <!-- #list view End -->
                                    <div class="pro-pagination">
                                        {{$list_product->withQueryString()->links()}}
                                       
                                        
                                        {{-- <ul class="blog-pagination">
                                            <li class="active"><a href="#">1</a></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                                        </ul>                                    
                                        <div class="product-pagination">
                                            <span class="grid-item-list">Showing 1 to 12 of 51 (5 Pages)</span>
                                        </div> --}}
                                    </div>
                                    <!-- Product Pagination Info -->
                                </div>
                                <!-- Grid & List Main Area End -->
                            </div>
                        </div>
                        <!-- product Categorie List End -->
                    </div>
                    <!-- Row End -->
                </div>
                <!-- Container End -->
            </div>
            <!-- Shop Page End -->
            <!-- Support Area Start Here -->
            <div class="support-area bdr-top">
                <div class="container">
                    <div class="d-flex flex-wrap text-center">
                        <div class="single-support">
                            <div class="support-icon">
                                <i class="lnr lnr-gift"></i>
                            </div>
                            <div class="support-desc">
                                <h6>Great Value</h6>
                                <span>Nunc id ante quis tellus faucibus dictum in eget.</span>
                            </div>
                        </div>
                        <div class="single-support">
                            <div class="support-icon">
                                <i class="lnr lnr-rocket"></i>
                            </div>
                            <div class="support-desc">
                                <h6>Worlwide Delivery</h6>
                                <span>Quisque posuere enim augue, in rhoncus diam dictum non</span>
                            </div>
                        </div>
                        <div class="single-support">
                            <div class="support-icon">
                               <i class="lnr lnr-lock"></i>
                            </div>
                            <div class="support-desc">
                                <h6>Safe Payment</h6>
                                <span>Duis suscipit elit sem, sed mattis tellus accumsan.</span>
                            </div>
                        </div>
                        <div class="single-support">
                            <div class="support-icon">
                               <i class="lnr lnr-enter-down"></i>
                            </div>
                            <div class="support-desc">
                                <h6>Shop Confidence</h6>
                                <span>Faucibus dictum suscipit eget metus. Duis  elit sem, sed.</span>
                            </div>
                        </div>
                        <div class="single-support">
                            <div class="support-icon">
                               <i class="lnr lnr-users"></i>
                            </div>
                            <div class="support-desc">
                                <h6>24/7 Help Center</h6>
                                <span>Quisque posuere enim augue, in rhoncus diam dictum non.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container End -->
            </div>
            <!-- Support Area End Here -->
            <script>
                var industryListURL = "{{ route('industry_list', ['industry' => $industry_id]) }}";
            </script>
            
            
@endsection
