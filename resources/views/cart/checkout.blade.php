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
                        <li><a href="index.html">Home</a></li>
                        <li class="active"><a href="checkout.html">Checkout</a></li>
                    </ul>
                </div>
            </div>
            <!-- Container End -->
        </div>
        <!-- Breadcrumb End -->
       
        <!-- checkout-area start -->
        <div class="checkout-area pb-100 pt-15 pb-sm-60">
            <div class="container">
                <form action="{{route('cart.payment')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="checkbox-form mb-sm-40">
                                <h3>Billing Details</h3>
                                <div class="row">
                        
                                    <div class="col-md-12">
                                        <div class="checkout-form-list mb-30">
                                            <label>Full name<span class="required">*</span></label>
                                            <input type="text" name="name" placeholder="" value="{{old('name')}}">
                                            @error('name')                        
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror  
                                        </div>
                                    </div>                                
            
                                    <div class="col-md-12">
                                        <div class="checkout-form-list mb-30">
                                            <div class="country-select clearfix mb-30">
                                                <label>Chọn Tỉnh Thành <span class="required">*</span></label>
                                                <select class="wide" id="province" name="province">
                                                </select>
                                                @error('province')                        
                                                    <small class="text-danger">{{$message}}</small>
                                                @enderror 
                                            </div>
                                            <div class="country-select clearfix mb-30">
                                                <label>Chọn Quận/Huyện <span class="required">*</span></label>
                                                <select class="wide" id="district" name="district">
                                                </select>
                                                @error('district')                        
                                                    <small class="text-danger">{{$message}}</small>
                                                @enderror
                                            </div>
                                            <div class="country-select clearfix mb-30">
                                                <label>Chọn Xã/Phường <span class="required">*</span></label>
                                                <select class="wide" id="ward" name="ward">
                                                </select>
                                                @error('ward')                        
                                                    <small class="text-danger">{{$message}}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list mb-30">
                                            <label>Số nhà cụ thể <span class="required">*</span></label>
                                            <input type="text" name="home_number" id="home_number" value="{{old('home_number')}}" placeholder="Số nhà">
                                            @error('home_number')                        
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror 
                                        </div>
                                    </div>
                                    <input type="hidden" name="address" id="result" />

                                
                                    <div class="col-md-6">
                                        <div class="checkout-form-list mb-30">
                                            <label>Email Address <span class="required">*</span></label>
                                            <input type="email" name="email" placeholder="" value="{{old('email')}}">
                                            @error('email')                        
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror 
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list mb-30">
                                            <label>Phone  <span class="required">*</span></label>
                                            <input type="text" name="phone" placeholder="Postcode / Zip" value="{{old('phone')}}">
                                            @error('phone')                        
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror 
                                        </div>
                                    </div>                                  
                                </div>                          
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="your-order">
                                <h3>Your order </h3>
                                <div class="your-order-table table-responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="product-name">Product</th>
                                                <th class="product-total">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($list_cart as $item)
                                                <tr class="cart_item">
                                                    <td class="product-name">
                                                        {{$item->name}} <span class="product-quantity"> × {{$item->quantity}}</span>
                                                    </td>
                                                    <td class="product-total">
                                                        <span class="amount">{{number_format($item->price*$item->quantity, 0, '', '.')}}đ</span>
                                                    </td>
                                                </tr>
                                            @endforeach                                 
                                        </tbody>
                                        <tfoot>
                                            {{-- <tr class="cart-subtotal">
                                                <th>Cart Subtotal</th>
                                                <td><span class="amount">£215.00</span></td>
                                            </tr> --}}
                                            <tr class="order-total">
                                                <th>Order Total</th>
                                                <td><span class=" total amount">{{number_format(Cart::session(Auth::user()->id)->getTotal(), 0, '', '.')}} VNĐ</span>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                {{-- <div class="payment-method">
                                    <div id="accordion">
                                        <div class="card">
                                            <div class="card-header" id="headingone">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    Direct Bank Transfer
                                                    </button>
                                                </h5>
                                            </div>

                                            <div id="collapseOne" class="collapse show" aria-labelledby="headingone" data-parent="#accordion">
                                                <div class="card-body">
                                                    <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="headingtwo">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Cheque Payment
                                            </button>
                                                </h5>
                                            </div>
                                            <div id="collapseTwo" class="collapse" aria-labelledby="headingtwo" data-parent="#accordion">
                                                <div class="card-body">
                                                    <p>Please send your cheque to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="headingthree">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            PayPal
                                            </button>
                                                </h5>
                                            </div>
                                            <div id="collapseThree" class="collapse" aria-labelledby="headingthree" data-parent="#accordion">
                                                <div class="card-body">
                                                    <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                <input type='submit' name="btn_payment" value="Hoàn tất" class="btn btn-success">
                            </div>
                        </div>
                    </div>
                </form> 
            </div>
        </div>
        <!-- checkout-area end -->
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