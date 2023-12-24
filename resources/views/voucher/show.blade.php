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
                                    <li class="@if (isset($industry_id) && $industry_id == $industry->id) active @endif"><a
                                            href="{{ route('industry_list', ['industry' => $industry->id]) }}"><span><img
                                                    src="{{ asset('img\vertical-menu\1.png') }}"
                                                    alt="menu-icon"></span>{{ $industry->name }}</a></li>
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
                    <li class="active"><a href="#">Mã giảm giá</a></li>
                </ul>
            </div>
        </div>
        <!-- Container End -->
    </div>
    <!-- Breadcrumb End -->
    <!-- Blog Page Start Here -->
    <div class="blog pb-100  pb-sm-60">
        <div class="container">
            <div class="main-blog">
                <div class="row">
                    <div class="col-sm-12">
                        <img style="max-width: 100%; height: 100" src="{{ asset('/img/banner/voucher.jpg') }}" alt="">
                    </div>
                </div>
                <div class="row">
                    @foreach ($list_voucher as $voucher)                                           
                    <div class="col-sm-6 mt-2">
                        <div class="card card-voucher">
                            <div class="main">
                                <div class="co-img">
                                    <img src="https://down-vn.img.susercontent.com/file/aa73f8aa302834aa9fc6adbf6e704cf2" alt="Voucher Image" class="voucher-image">
                                </div>
                                <div class="vertical"></div>
                                <div class="content">
                                    <h2>VietMart</h2>
                                    <h1>
                                        @if($voucher->discount_type === 'fixed')
                                        {{ rtrim(rtrim(number_format($voucher->discount_value), '0'), ',') }}k <span>giảm</span>
                                        @else
                                        {{ rtrim(rtrim(number_format($voucher->discount_value, 2), '0'), '.') }}% <span>giảm</span>
                                        @endif
                                    </h1>
                                    <p>Đơn tối thiếu: {{ rtrim(rtrim(number_format($voucher->min_order_value), '0'), ',') }}k</p>
                                    @if($voucher->discount_type !== 'fixed')
                                    <p>Giảm tối đa: {{ rtrim(rtrim(number_format($voucher->max_discount), '0'), ',') }}k</p>
                                    @endif
                                </div>
                            </div>
                            <div class="copy-button">
                                <input id="copyValue_{{$voucher->id}}" type="text" readonly value="{{$voucher->voucher_code}}" />
                                <button class="copyBtn" data-voucher-id="{{$voucher->id}}" onclick="copyIt({{$voucher->id}})">Copy</button>
                            </div>
                        </div>
                    </div>                                         
                    @endforeach                  
                </div>
                <!-- Row End -->
            </div>
        </div>
        <!-- Container End -->
    </div>
    <script>         
   function copyIt(voucherId){
        let copyInput = document.querySelector(`#copyValue_${voucherId}`);

        copyInput.select();
        document.execCommand("copy");
        
        // Làm thay đổi trên nút copy liên quan đến voucher cụ thể
        let copyBtn = document.querySelector(`.copyBtn[data-voucher-id="${voucherId}"]`);
        copyBtn.textContent = "COPIED";
    }

    </script>
    <!-- Blog Page End Here -->
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
                        <span>Faucibus dictum suscipit eget metus. Duis elit sem, sed.</span>
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
