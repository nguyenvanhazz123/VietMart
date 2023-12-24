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
                    <li class="active"><a href="#">Yêu thích</a></li>
                </ul>
            </div>
        </div>
        <!-- Container End -->
    </div>
    <!-- Breadcrumb End -->
    <!-- Wish List Start -->
    <div class="cart-main-area wish-list ptb-100 ptb-sm-60">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <!-- Form Start -->
                    <form action="#">
                        <!-- Table Content Start -->
                        <div class="table-content table-responsive">
                            @if($list_wish_list->count() > 0)
                            <table>
                                <thead>
                                    <tr>
                                        <th class="product-remove">Xóa</th>
                                        <th class="product-thumbnail">Ảnh</th>
                                        <th class="product-name">Tên sản phẩm</th>
                                        <th class="product-price">Giá</th>
                                        <th class="product-quantity">Tình trạng</th>
                                        <th class="product-subtotal">Xem chi tiết</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list_wish_list as $item)
                                        <tr>
                                            <td class="product-remove">
                                                 <a href="javascript:void(0);" onclick="removeFromWishlist('{{ $item->id }}')"><i class="fa fa-times" aria-hidden="true"></i></a>
                                                </td>
                                            <td class="product-thumbnail">
                                                <a href="{{route('product.detail', $item->product->id)}}"><img src="{{asset($item->product->thumbnail)}}" alt="cart-image"></a>
                                            </td>
                                            <td class="product-name"><a href="{{route('product.detail', $item->product->id)}}">{{$item->product->name}}</a></td>
                                            <td class="product-price"><span class="amount">{{number_format($item->product->price, 0, '', '.')}}đ</span></td>
                                            <td class="product-stock-status"><span>{{$item->product->Status->name_status}}</span></td>
                                            @if ($item->product->Status->id == 1)
                                            <td class="product-add-to-cart"><a href="{{route('product.detail', $item->product->id)}}">Details</a></td>
                                            @else
                                            <td class="product-add-to-cart"><a href="#">Hết Hàng</a></td>
                                            @endif
                                            
                                            
                                        </tr>
                                    @endforeach                         
                                </tbody>
                            </table>
                            @else
                            <p>Không có sản phẩm yêu thích</p>
                            @endif
                        </div>
                        <!-- Table Content Start -->
                    </form>
                    <!-- Form End -->
                </div>
            </div>
            <!-- Row End -->
        </div>
    </div>
    <!-- Wish List End -->
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