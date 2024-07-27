<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SanPhamRequest;
use App\Models\DanhMuc;
use App\Models\HinhAnhSanPham;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SanPhamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Thông tin sản phẩm';
        $listSanPham = SanPham::orderByDesc('is_type')->get();
        return view('admin.sanpham.index', compact(['title', 'listSanPham']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Thêm sản phẩm';
        $listDanhMuc = DanhMuc::query()->get();

        return view('admin.sanpham.create', compact(['title', 'listDanhMuc']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SanPhamRequest $request)
    {
        if ($request->isMethod('POST')) {
            $params = $request->except('_token');
            // Chuyển đổi giá trị checkbox thành boolean
            $params['is_new'] = $request->has('is_new') ? 1 : 0;
            $params['is_hot'] = $request->has('is_hot') ? 1 : 0;
            $params['is_hot_deal'] = $request->has('is_hot_deal') ? 1 : 0;
            $params['is_show_home'] = $request->has('is_show_home') ? 1 : 0;
            // Xử lý hình ảnh sản phẩm
            if ($request->hasFile('hinh_anh')) {
                $params['hinh_anh'] = $request->file('hinh_anh')->store('uploads/sanpham', 'public');
            } else {
                $params['hinh_anh'] = null;
            }

            // Thêm sản phẩm
            $sanPham = SanPham::query()->create($params);

            // Lấy id sản phẩm vừa thêm để thêm được album
            $sanPhamId = $sanPham->id;

            // Xử lý thêm album
            if ($request->hasFile('list_hinh_anh')) {
                foreach ($request->file('list_hinh_anh') as $image) {
                    if ($image) {
                        $path = $image->store('uploads/hinhanhsanpham/id_' . $sanPhamId, 'public');
                        $sanPham->hinhAnhSanPhams()->create([
                            'san_pham_id' => $sanPhamId,
                            'hinh_anh' => $path,
                        ]);
                    }
                }
            }
            toastr('Thêm sản phẩm thành công', 'success');

            return redirect()->route('admin.san-pham.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Chỉnh sửa sản phẩm';
        $sanPham = SanPham::query()->findOrFail($id);
        $listDanhMuc = DanhMuc::query()->get();
        return view('admin.sanpham.edit', compact(['sanPham', 'listDanhMuc', 'title']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($request->isMethod('PUT')) {
            $params = $request->except('_token', '_method');
            // Chuyển đổi giá trị checkbox thành boolean
            $params['is_new'] = $request->has('is_new') ? 1 : 0;
            $params['is_hot'] = $request->has('is_hot') ? 1 : 0;
            $params['is_hot_deal'] = $request->has('is_hot_deal') ? 1 : 0;
            $params['is_show_home'] = $request->has('is_show_home') ? 1 : 0;

            $sanPham = SanPham::query()->findOrFail($id);


            // Xử lý hình ảnh sản phẩm
            if ($request->hasFile('hinh_anh')) {
                if ($sanPham->hinh_anh && Storage::disk('public')->exists($sanPham->hinh_anh)) {
                    Storage::disk('public')->delete($sanPham->hinh_anh);
                }
                $params['hinh_anh'] = $request->file('hinh_anh')->store('uploads/sanpham', 'public');
            } else {
                $params['hinh_anh'] = $sanPham->hinh_anh;
            }

            // Xử lý album

            $currentImage = $sanPham->hinhAnhSanPhams->pluck('id')->toArray();
            $arrayCombine = array_combine($currentImage, $currentImage);
            foreach ($arrayCombine as $key => $value) {
                // Tìm kiếm id hình trong mảng hình ảnh mới đẩy lên
                // Nếu không tồn tại Id thì tức là người đùng đã xóa
                if (!array_key_exists($key, $request->list_hinh_anh)) {
                    $hinhAnhSanPham = HinhAnhSanPham::query()->find($key);

                    if ($hinhAnhSanPham->hinh_anh && Storage::disk('public')->exists($hinhAnhSanPham->hinh_anh)) {
                        Storage::disk('public')->delete($hinhAnhSanPham->hinh_anh);
                        $hinhAnhSanPham->delete();
                    }
                }
            }


            foreach ($request->list_hinh_anh as $key => $image) {
                if (!array_key_exists($key, $arrayCombine)) {
                    // Thêm hình ảnh
                    if ($request->hasFile("list_hinh_anh.$key")) {
                        $path = $image->store('uploads/hinhanhsanpham/id_' . $id, 'public');
                        $sanPham->hinhAnhSanPhams()->create([
                            'san_pham_id' => $id,
                            'hinh_anh' => $path,
                        ]);
                    }
                } else if (is_file($image) && $request->hasFile("list_hinh_anh.$key")) {
                    // Trường hợp thay đổi hình ảnh
                    $hinhAnhSanPham = HinhAnhSanPham::query()->find($key);
                    if ($hinhAnhSanPham->hinh_anh && Storage::disk('public')->exists($hinhAnhSanPham->hinh_anh)) {
                        Storage::disk('public')->delete($hinhAnhSanPham->hinh_anh);
                    }
                    $path = $image->store('uploads/hinhanhsanpham/id_' . $id, 'public');
                    $hinhAnhSanPham->update([
                        'hinh_anh' => $path,
                    ]);
                }
            }
            $sanPham->update($params);
            toastr('Chỉnh sửa sản phẩm thành công', 'success');

            return redirect()->route('admin.san-pham.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sanPham = SanPham::query()->findOrFail($id);
        // Xóa hình ảnh sản phẩm
        if ($sanPham->hinh_anh && Storage::disk('public')->exists($sanPham->hinh_anh)) {
            Storage::disk('public')->delete($sanPham->hinh_anh);
        }
        // Xóa album
        $sanPham->hinhAnhSanPhams()->delete();

        // Xóa toàn bộ hình ảnh trong thư mục
        $path = 'uploads/hinhanhsanpham/id_' . $sanPham->id;
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->deleteDirectory($path);
        }
        $sanPham->delete();

        toastr('Xóa sản phẩm thành công', 'success');

        return response([
            'status' => 'success',
            'message' => 'Xóa thành công',
        ]);
    }
}
