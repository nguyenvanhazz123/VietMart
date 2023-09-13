
@extends('layouts.admin')
@section('title', 'DashBoard')
@section('content')
<div class="container-fluid py-5">
    <div class="row">
        <div class="col">
            <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                <div class="card-header">Tổng đơn hàng trên hệ thống</div>
                <div class="card-body">
                    <h5 class="card-title">{{$count[0]}}</h5>
                    <p class="card-text">Đơn hàng giao dịch thành công</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                <div class="card-header">ĐANG XỬ LÝ</div>
                <div class="card-body">
                    <h5 class="card-title">{{$count[1]}}</h5>
                    <p class="card-text">Số lượng đơn hàng đang xử lý</p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                <div class="card-header">DOANH SỐ</div>
                <div class="card-body">
                    <h5 class="card-title">{{number_format($total, 0, '', '.')}}đ</h5>
                    <p class="card-text">Doanh số hệ thống</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                <div class="card-header">ĐƠN HÀNG HỦY</div>
                <div class="card-body">
                    <h5 class="card-title">{{$sum_order_trash}}</h5>
                    <p class="card-text">Số đơn bị hủy trong hệ thống</p>
                </div>
            </div>
        </div>
    </div>
    <!-- end analytic  -->
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>            
    @endif
    <div class="card">
        <div class="card-header font-weight-bold">
            ĐƠN HÀNG MỚI
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Mã đơn hàng</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Giá trị</th>
                        <th scope="col">Tổng giá trị</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Thời gian</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $stt=0;
                    @endphp
                    @foreach ($list_order_detail as $order_detail)
                        @php
                            $stt++;
                        @endphp
                        <tr>
                            <td>{{$stt}}</td>
                            <td>{{$order_detail->order->code}}</td>
                            <td>{{$order_detail->product->name}}</td>
                            <td>{{$order_detail->quantity}}</td>
                            <td>{{number_format($order_detail->price, 0, '', '.')}}</td>
                            <td>{{number_format($order_detail->total, 0, '', '.')}}</td>
                            <td>
                                @if ($order_detail->status_id == 1)
                                    <span class="badge badge-warning">{{$order_detail->status->name}}</span>
                                    @else
                                    <span class="badge badge-success">{{$order_detail->status->name}}</span>
                                    @endif
                            </td>
                            <td>{{$order_detail->created_at}}</td>
                            <td>
                                <a href="{{route('delete_order_dashboard', $order_detail->id)}}" onclick="return confirm('Bạn có chắc muốn hủy Đơn hàng?');" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach        
                </tbody>
            </table>
           {{$list_order_detail->links()}}
        </div>
    </div>

</div>
@endsection