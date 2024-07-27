<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\DanhMucRequest;
use App\Models\DanhMuc;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DanhMucController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Danh mục sản phẩm';
        $listDanhMuc = DanhMuc::orderByDesc('trang_thai')->get();
        return view('admin.danhmuc.index', compact(['title', 'listDanhMuc']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tạo danh mục';
        return view('admin.danhmuc.create', compact(['title']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DanhMucRequest $request)
    {
        if ($request->isMethod('POST')) {
            $param = $request->except('_token');

            if ($request->hasFile('hinh_anh')) {
                $filePath = $request->file('hinh_anh')->store('uploads/danhmuc', 'public');
            } else {
                $filePath = null;
            }
            $param['hinh_anh'] = $filePath;
            DanhMuc::create($param);
            toastr('Thêm thành công', 'success');
            return redirect()->route('admin.danh-muc.index');
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
        $title = 'Sửa danh mục';
        $danhMuc = DanhMuc::findOrFail($id);
        return view('admin.danhmuc.edit', compact(['title', 'danhMuc']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DanhMucRequest $request, string $id)
    {


        if ($request->isMethod('PUT')) {
            $param = $request->except('_token');
            $danhMuc = DanhMuc::findOrFail($id);

            if ($request->hasFile('hinh_anh')) {
                if ($danhMuc->hinh_anh && Storage::disk('public')->exists($danhMuc->hinh_anh)) {
                    Storage::disk('public')->delete($danhMuc->hinh_anh);
                }
                $filePath = $request->file('hinh_anh')->store('uploads/danhmuc', 'public');

                $param['hinh_anh'] = $filePath;
            }

            $danhMuc->update($param);

            toastr('Cập nhật thành công', 'success');

            return redirect()->route('admin.danh-muc.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $danhMuc = DanhMuc::findOrFail($id);
        if ($danhMuc->hinh_anh && Storage::disk('public')->exists($danhMuc->hinh_anh)) {
            Storage::disk('public')->delete($danhMuc->hinh_anh);
        }
        $danhMuc->delete();

        return response([
            'status' => 'success',
            'message' => 'Xóa thành công',
        ]);
    }
}
