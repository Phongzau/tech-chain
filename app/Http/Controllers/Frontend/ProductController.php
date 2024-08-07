<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\SanPham;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function listSanPham()
    {
        $products = SanPham::query()->where('is_type', 1)->get();
        return view('client.sanphams.sanpham', compact(['products']));
    }
    public function detailSanPham(string $id)
    {
        $sanPham = SanPham::query()->findOrFail($id);
        $listSanPham = SanPham::query()->get();
        return view('client.sanphams.chitiet', compact(['sanPham', 'listSanPham']));
    }
}
