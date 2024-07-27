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
                <h4 class="fs-18 fw-semibold m-0">Quản lý danh mục sản phẩm</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">{{ $title }}</h5>
                    </div><!-- end card header -->
                    <div class="p-3">
                        <a href="{{ route('admin.danh-muc.create') }}"><button class="btn btn-primary"><i
                                    class="fas fa-plus"></i>
                                Thêm danh mục</button></a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">STT</th>
                                        <th scope="col">Hình ảnh</th>
                                        <th scope="col">Tên danh mục</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($listDanhMuc as $index => $danhMuc)
                                        <tr>
                                            <th scope="row">{{ $index + 1 }}</th>
                                            <td><img width="100px" src="{{ Storage::url($danhMuc->hinh_anh) }}"
                                                    alt=""></td>
                                            <td>{{ $danhMuc->ten_danh_muc }}</td>
                                            <td class="{{ $danhMuc->trang_thai == true ? 'text-success' : 'text-danger' }}">
                                                {{ $danhMuc->trang_thai == true ? 'Hiển thị' : 'Ẩn' }}
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.danh-muc.edit', $danhMuc->id) }}"><button
                                                        class="btn btn-primary"><i class="far fa-edit"></i></button></a>
                                                <a class="btn btn-danger delete-item"
                                                    href="{{ route('admin.danh-muc.destroy', $danhMuc->id) }}"><i
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