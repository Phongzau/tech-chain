@extends('admin.layouts.master')

@section('title')
    {{ $title }}
@endsection

@section('css')
    <!-- Quill css -->
    <link href="{{ asset('admin/assets/libs/quill/quill.core.js') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/libs/quill/quill.snow.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/libs/quill/quill.bubble.css') }}" rel="stylesheet" type="text/css" />
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
                        <form action="{{ route('admin.san-pham.update', $sanPham->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="example-input-normal" class="form-label">Mã sản phẩm</label>
                                        <input type="text" id="ma_san_pham" name="ma_san_pham"
                                            class="form-control @error('ma_san_pham') is-invaild  @enderror"
                                            placeholder="Nhập tên danh mục" value="{{ $sanPham->ma_san_pham }}">
                                        @error('ma_san_pham')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="example-input-normal" class="form-label">Tên sản phẩm</label>
                                        <input type="text" id="ten_san_pham" name="ten_san_pham"
                                            class="form-control @error('ten_san_pham') is-invaild  @enderror"
                                            placeholder="Nhập tên danh mục" value="{{ $sanPham->ten_san_pham }}">
                                        @error('ten_san_pham')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>


                                    <div class="mb-3">
                                        <label for="example-input-normal" class="form-label">Giá sản phẩm</label>
                                        <input type="number" id="gia_san_pham" name="gia_san_pham"
                                            class="form-control @error('gia_san_pham') is-invaild  @enderror"
                                            placeholder="Nhập tên danh mục" value="{{ $sanPham->gia_san_pham }}">
                                        @error('gia_san_pham')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>


                                    <div class="mb-3">
                                        <label for="example-input-normal" class="form-label">Giá khuyến mãi</label>
                                        <input type="number" id="gia_khuyen_mai" name="gia_khuyen_mai"
                                            class="form-control @error('gia_khuyen_mai') is-invaild  @enderror"
                                            placeholder="Nhập tên danh mục" value="{{ $sanPham->gia_khuyen_mai }}">
                                        @error('gia_khuyen_mai')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="example-input-normal" class="form-label">Danh mục</label>
                                        <select name="danh_muc_id"
                                            class="form-select @error('danh_muc_id') is-invaild  @enderror" id="">
                                            <option value="" hidden>---Chọn danh mục---</option>
                                            @foreach ($listDanhMuc as $item)
                                                <option {{ $item->id == $sanPham->danh_muc_id ? 'selected' : '' }}
                                                    value="{{ $item->id }}">{{ $item->ten_danh_muc }}</option>
                                            @endforeach
                                        </select>
                                        @error('gia_khuyen_mai')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="example-input-normal" class="form-label">Số lượng sản phẩm</label>
                                        <input type="number" id="so_luong" name="so_luong"
                                            class="form-control @error('so_luong') is-invaild  @enderror"
                                            placeholder="Nhập tên danh mục" value="{{ $sanPham->so_luong }}">
                                        @error('so_luong')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>


                                    <div class="mb-3">
                                        <label for="example-input-normal" class="form-label">Ngày nhập</label>
                                        <input type="date" id="ngay_nhap" name="ngay_nhap"
                                            class="form-control @error('ngay_nhap') is-invaild  @enderror"
                                            placeholder="Nhập tên danh mục" value="{{ $sanPham->ngay_nhap }}">
                                        @error('ngay_nhap')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="example-input-normal" class="form-label">Mô tả ngắn </label>
                                        <textarea name="mo_ta_ngan" id="mo_ta_ngan" class="form-control @error('ngay_nhap') is-invaild  @enderror"
                                            rows="3">{{ $sanPham->mo_ta_ngan }}</textarea>
                                        @error('ngay_nhap')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="trang_thai">Trạng thái</label>
                                        <div class="col-sm-10 mb-3 d-flex gap-2">
                                            <div class="form-check">
                                                <input {{ $sanPham->is_type == 1 ? 'checked' : '' }}
                                                    class="form-check-input" type="radio" name="is_type"
                                                    id="is_type" value="1">
                                                <label class="form-check-label" for="gridRadios1">
                                                    Hiển thị
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input {{ $sanPham->is_type == 0 ? 'checked' : '' }}
                                                    class="form-check-input" type="radio" name="is_type"
                                                    id="is_type" value="0">
                                                <label class="form-check-label" for="gridRadios2">
                                                    Ẩn
                                                </label>
                                            </div>
                                        </div>
                                    </div>


                                    <label for="" class="form-label">Tùy chỉnh khác</label>
                                    <div class="form-switch ps-3 mb-2 d-flex justify-content-between">
                                        <div class="form-check">
                                            <input {{ $sanPham->is_type == 1 ? 'checked' : '' }}
                                                class="form-check-input bg-danger" type="checkbox" name="is_new">
                                            <label class="form-check-label" for="flexSwitchCheckChecked">New</label>
                                        </div>
                                        <div class="form-check">
                                            <input {{ $sanPham->is_hot == 1 ? 'checked' : '' }}
                                                class="form-check-input btn-secondary" type="checkbox" name="is_hot">
                                            <label class="form-check-label" for="flexSwitchCheckChecked">Hot</label>
                                        </div>
                                        <div class="form-check">
                                            <input {{ $sanPham->is_hot_deal == 1 ? 'checked' : '' }}
                                                class="form-check-input bg-warning" type="checkbox" name="is_hot_deal">
                                            <label class="form-check-label" for="flexSwitchCheckChecked">Hot Deal</label>
                                        </div>
                                        <div class="form-check">
                                            <input {{ $sanPham->is_show_home == 1 ? 'checked' : '' }}
                                                class="form-check-input bg-success" type="checkbox" name="is_show_home">
                                            <label class="form-check-label" for="flexSwitchCheckChecked">Show home</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-8">
                                    <div class="mb-3">
                                        <label for="example-input-large" class="form-label">Mô tả chi tiết sản
                                            phẩm</label>
                                        <div id="quill-editor" style="height: 400px;" class="ql-container ql-snow">
                                            <div class="ql-editor" data-gramm="false" contenteditable="true">
                                            </div>
                                        </div>
                                        <textarea name="noi_dung" id="noi_dung_content" class="d-none">{{ $sanPham->noi_dung }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="example-input-large" class="form-label">Hình ảnh</label>
                                        <input type="file" name="hinh_anh" onchange="showImage(event)"
                                            class="form-control">
                                        <img src="{{ Storage::url($sanPham->hinh_anh) }}" id="img_danh_muc"
                                            alt="Hình ảnh sản phẩm" style="width:150px">
                                    </div>

                                    <div class="mb-3">
                                        <label for="example-input-large" class="form-label me-2">Album hình ảnh</label>
                                        <i id="add-row" class="fas fa-plus p-2 border" style="cursor: pointer;"></i>

                                        <table class="table align-middle table-nowrap mb-0">
                                            <tbody id="image-table-body">
                                                @foreach ($sanPham->hinhAnhSanPhams as $index => $item)
                                                    <tr>
                                                        <td class="d-flex align-items-center">
                                                            <img id="preview_{{ $index }}"
                                                                src="{{ Storage::url($item->hinh_anh) }}"
                                                                alt="Hình ảnh sản phẩm" style="width:50px"
                                                                class="me-3">
                                                            <input type="file" id="hinh_anh"
                                                                name="list_hinh_anh[{{ $item->id }}]"
                                                                class="form-control"
                                                                onchange="previewImage(this, {{ $index }})">
                                                            <input type="hidden"
                                                                name="list_hinh_anh[{{ $item->id }}]"
                                                                value="{{ $item->id }}">
                                                        </td>
                                                        <td>
                                                            <i class="far fa-trash-alt" style="cursor: pointer"
                                                                onclick="removeRow(this)"></i>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>



                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- Quill Editor Js -->
    <script src="{{ asset('admin/assets/libs/quill/quill.core.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/quill/quill.min.js') }}"></script>

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
    {{-- Của phần nội dung --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var quill = new Quill("#quill-editor", {
                theme: "snow",


            })
            // Hiển thị nội dung cũ
            var old_content = `{!! $sanPham->noi_dung !!}`;
            quill.root.innerHTML = old_content;

            // Cập nhật lại textarea ẩn khi nội dung của quill-editor thay đổi
            quill.on('text-change', function() {
                var html = quill.root.innerHTML;
                document.getElementById('noi_dung_content').value = html;
            })
        })
    </script>

    {{-- Thêm ablum ảnh --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var rowCount = {{ count($sanPham->hinhAnhSanPhams) }};

            document.getElementById('add-row').addEventListener('click', function() {
                const tableBody = document.getElementById('image-table-body');

                var newRow = document.createElement('tr');

                newRow.innerHTML =
                    `<td class="d-flex align-items-center">
                        <img id="preview_${rowCount}" src="https://www.pikpng.com/pngl/m/74-745720_download-img-icon-png-clipart.png" alt="Hình ảnh sản phẩm"
                        style="width:50px" class="me-3">
                        <input type="file" id="hinh_anh" name="list_hinh_anh[id_${rowCount}]"
                        class="form-control" onchange="previewImage(this, ${rowCount})">
                    </td>
                    <td>
                        <i class="far fa-trash-alt" style="cursor: pointer" onclick="removeRow(this)"></i>
                    </td>`;
                tableBody.appendChild(newRow);
                rowCount++;
            })

        })

        function previewImage(input, rowIndex) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    document.getElementById(`preview_${rowIndex}`).setAttribute('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);

            }
        }

        function removeRow(item) {
            var row = item.closest('tr');
            row.remove();
        }
    </script>
@endsection
