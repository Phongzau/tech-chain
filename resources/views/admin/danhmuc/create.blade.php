@extends('admin.layouts.master')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="container-xxl">
        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">{{ $title }}</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">

                    <div class="card-header">
                        <h5 class="card-title mb-0">{{ $title }}</h5>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <form action="{{ route('admin.danh-muc.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="example-input-normal" class="form-label">Tên danh mục</label>
                                        <input type="text" id="ten_danh_muc" name="ten_danh_muc"
                                            class="form-control @error('ten_danh_muc') is-invaild  @enderror"
                                            placeholder="Nhập tên danh mục" value="{{ old('ten_danh_muc') }}">
                                        @error('ten_danh_muc')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="example-input-large" class="form-label">Hình ảnh</label>
                                        <input type="file" name="hinh_anh" onchange="showImage(event)"
                                            class="form-control">
                                        <img src="" id="img_danh_muc" alt="Hình ảnh sản phẩm"
                                            style="width:150px; display: none">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="trang_thai">Trạng thái</label>
                                <div class="col-sm-10 mb-3 d-flex gap-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="trang_thai" id="trang_thai"
                                            value="1">
                                        <label class="form-check-label" for="gridRadios1">
                                            Hiển thị
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="trang_thai" id="trang_thai"
                                            value="0">
                                        <label class="form-check-label" for="gridRadios2">
                                            Ẩn
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <button type="submit" class="btn btn-primary">Thêm</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function showImage(event) {
            const img_danh_muc = document.getElementById('img_danh_muc');

            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function() {
                img_danh_muc.src = reader.result;
                img_danh_muc.style.display = 'block';
            }
            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
