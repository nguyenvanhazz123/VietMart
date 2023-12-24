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
                                            <li class=""><a href="{{route('industry_list', ['industry' => $industry->id])}}"><span><img src="{{asset('img\vertical-menu\1.png')}}" alt="menu-icon"></span>{{$industry->name}}</a></li>                                       
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
                            <li><a href="#">Trang chủ</a></li>
                            <li class="active"><a href="#">Sản phẩm</a></li>
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
                                            <select name="orderby" class="select-box sorter wide order_by">
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
                            </div>
                            <!-- Grid & List View End -->
                            <div class="main-categorie mb-all-40">
                                <!-- Grid & List Main Area End -->
                                <div class="tab-content fix">
                                    <div id="grid-view" class="tab-pane fade show active">
                                        @include('shop.product_list')
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
                                                        </a>                                                                                                                 
                                                    </div>
                                                </div>
                                                <!-- Product Image End -->
                                                <!-- Product Content Start -->
                                                <div class="col-lg-8 col-md-7 col-sm-12">
                                                    <div class="pro-content hot-product2">
                                                        <h4><a href="product.html">{{$product->name}}</a></h4>                                                        
                                                        <p><span class="price priceName">{{number_format($product->price, 0, '', '.')}}đ</span></p>
                                                        <p>{!! $product->description !!}</p>
                                                        <div class="pro-actions">                                                           
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
          
@endsection
