@extends('admin.layouts.master')

@section('title')
    {{ $title }}
@endsection

@section('css')
@endsection

@section('content')
    <div class="container-xxl">
        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Quản lý thông tin sản phẩm</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">{{ $title }}</h5>
                    </div><!-- end card header -->
                    <div class="p-3">
                        <a href="{{ route('admin.san-pham.create') }}"><button class="btn btn-primary"><i
                                    class="fas fa-plus"></i>
                                Thêm sản phẩm</button></a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">STT</th>
                                        <th scope="col">Mã sản phẩm</th>
                                        <th scope="col">Hình ảnh</th>
                                        <th scope="col">Tên sản phẩm</th>
                                        <th scope="col">Danh mục</th>
                                        <th scope="col">Giá sản phẩm</th>
                                        <th scope="col">Giá khuyến mãi</th>
                                        <th scope="col">Số lượng</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($listSanPham as $index => $sanPham)
                                        <tr>
                                            <th scope="row">{{ $index + 1 }}</th>
                                            <td>{{ $sanPham->ma_san_pham }}</td>
                                            <td><img width="100px" src="{{ Storage::url($sanPham->hinh_anh) }}"
                                                    alt=""></td>
                                            <td>{{ $sanPham->ten_san_pham }}</td>

                                            <td>{{ $sanPham->danhMuc->ten_danh_muc }}</td>
                                            <td>{{ number_format($sanPham->gia_san_pham) }} VND</td>
                                            <td>{{ empty($sanPham->gia_khuyen_mai) ? '0' : number_format($sanPham->gia_khuyen_mai) . 'VND' }}
                                            </td>
                                            <td>{{ $sanPham->so_luong }}</td>
                                            <td class="{{ $sanPham->is_type == true ? 'text-success' : 'text-danger' }}">
                                                {{ $sanPham->is_type == true ? 'Hiển thị' : 'Ẩn' }}
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.san-pham.edit', $sanPham->id) }}"><button
                                                        class="btn btn-primary"><i class="far fa-edit"></i></button></a>
                                                <a class="btn btn-danger delete-item"
                                                    href="{{ route('admin.san-pham.destroy', $sanPham->id) }}"><i
                                                        class="far fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
