@extends('client.layouts.master')


@section('css')
@endsection

@section('content')
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Đặt hàng</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- checkout main wrapper start -->
    <div class="checkout-page-wrapper section-padding">
        <div class="container">
            <form action="{{ route('don-hang.store') }}" method="POST">
                @csrf
                <div class="row">
                    <!-- Checkout Billing Details -->
                    <div class="col-lg-6">
                        <div class="checkout-billing-details-wrap">
                            <h5 class="checkout-title">Billing Details</h5>
                            <div class="billing-form-wrap">
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <div class="single-input-item">
                                    <label for="email" class="required">Tên người nhận</label>
                                    <input type="text" id="ten_nguoi_nhan" value="{{ Auth::user()->name }}"
                                        name="ten_nguoi_nhan" placeholder="Nhập tên người nhận" />

                                    @error('ten_nguoi_nhan')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="single-input-item">
                                    <label for="email" class="required">Email người nhận</label>
                                    <input type="email" id="email_nguoi_nhan" value="{{ Auth::user()->email }}"
                                        name="email_nguoi_nhan" placeholder="Nhập Email tên người nhận" />
                                    @error('email_nguoi_nhan')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="single-input-item">
                                    <label for="email" class="required">SDT người nhận</label>
                                    <input type="text" id="sdt_nguoi_nhan" value="{{ Auth::user()->phone }}"
                                        name="sdt_nguoi_nhan" placeholder="SDT người nhận" />
                                    @error('sdt_nguoi_nhan')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>


                                <div class="single-input-item">
                                    <label for="email" class="required">Địa chỉ người nhận</label>
                                    <input type="text" id="dia_chi_nguoi_nhan" value="{{ Auth::user()->address }}"
                                        name="dia_chi_nguoi_nhan" placeholder="Địa chỉ người nhận" />
                                    @error('dia_chi_nguoi_nhan')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="single-input-item">
                                    <label for="ordernote">Ghi chú</label>
                                    <textarea name="ghi_chu" id="ordernote" cols="30" rows="3" placeholder="Nhập ghi chú"></textarea>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Order Summary Details -->
                    <div class="col-lg-6">
                        <div class="order-summary-details">
                            <h5 class="checkout-title">Your Order Summary</h5>
                            <div class="order-summary-content">
                                <!-- Order Summary Table -->
                                <div class="order-summary-table table-responsive text-center">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Products</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($carts as $key => $item)
                                                <tr>
                                                    <td><a href="{{ route('products.detail', $key) }}">{{ $item['ten_san_pham'] }}<strong>
                                                                ×
                                                                {{ $item['so_luong'] }}</strong></a>
                                                    </td>
                                                    <td>{{ number_format($item['so_luong'] * $item['gia'], 0, '', '.') }}VND
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td>Sub Total</td>
                                                <td><strong>{{ number_format($subTotal, 0, '', '.') }}VND</strong>
                                                    <input type="hidden" name="tien_hang" value="{{ $subTotal }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Shipping</td>
                                                <td class="d-flex justify-content-center">
                                                    <strong>{{ number_format($shipping, 0, '', '.') }}VND</strong>
                                                    <input type="hidden" name="tien_ship" value="{{ $shipping }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Total Amount</td>
                                                <td><b>{{ number_format($total, 0, '', '.') }}VND</b></td>
                                                <input type="hidden" name="tong_tien" value="{{ $total }}">
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- Order Payment Method -->
                                <div class="order-payment-method">
                                    <div class="single-payment-method show">
                                        <div class="payment-method-name">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="cashon" value="cash"
                                                    class="custom-control-input" checked />
                                                <label class="custom-control-label" for="cashon">Cash On Delivery</label>
                                            </div>
                                        </div>
                                        <div class="payment-method-details" data-method="cash">
                                            <p>Thanh toán tiền mặt khi nhận hàng.</p>
                                        </div>
                                    </div>
                                    <div class="summary-footer-area">
                                        <button type="submit" class="btn btn-sqr">Đặt Hàng</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- checkout main wrapper end -->
@endsection


@section('js')
@endsection
