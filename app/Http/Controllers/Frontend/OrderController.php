<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Mail\OrderConfirm;
use App\Models\ChiTietDonHang;
use App\Models\DonHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $donHangs = Auth::user()->donHang;
        $trangThaiDonHang = DonHang::TRANG_THAI_DON_HANG;
        $type_cho_xac_nhan = DonHang::CHO_XAC_NHAN;

        $type_dang_van_chuyen = DonHang::DANG_VAN_CHUYEN;
        return view('client.donhangs.index', compact('donHangs', 'trangThaiDonHang', 'type_cho_xac_nhan', 'type_dang_van_chuyen'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $carts = session()->get('cart');
        if (!empty($carts)) {
            $total = 0;
            $subTotal = 0;
            foreach ($carts as $item) {
                $subTotal += $item['gia'] * $item['so_luong'];
            }
            $shipping = 30000;

            $total = $subTotal + $shipping;
            return view('client.donhangs.create', compact('carts', 'subTotal', 'shipping', 'total'));
        }
        return redirect()->route('cart.list');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request)
    {
        if ($request->isMethod('POST')) {
            DB::beginTransaction();
            try {
                $params = $request->except('_token');
                $params['ma_don_hang'] = $this->generateUniqueOrderCode();
                $donHang = DonHang::query()->create($params);
                $don_hang_id = $donHang->id;
                $carts = session()->get('cart', []);
                foreach ($carts as $key => $item) {
                    $thanhTien = $item['gia'] * $item['so_luong'];
                    $donHang->chiTietDonHang()->create([
                        'don_hang_id' => $don_hang_id,
                        'san_pham_id' => $key,
                        'don_gia' => $item['gia'],
                        'so_luong' => $item['so_luong'],
                        'thanh_tien' => $thanhTien,
                    ]);
                }
                DB::commit();

                // Khi thêm thành công sẽ thực hiện các công việc bên dưới này
                // Trừ số lượng sản phẩm khi đặt hàng thành công
                // Gửi mail khi đặt hàng thành công
                Mail::to($donHang->email_nguoi_nhan)->queue(new OrderConfirm($donHang));
                session()->put('cart', []);
                toastr('Đơn hàng đã được tạo thành công', 'success');
                return redirect()->route('cart.list');
            } catch (\Exception $e) {
                DB::rollBack();
                toastr('Có lỗi khi tạo đơn hàng. Vui lòng thử lại sau', 'error');
                return redirect()->route('cart.list');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $donHang = DonHang::query()->findOrFail($id);

        $trangThaiDonHang = DonHang::TRANG_THAI_DON_HANG;

        $trangThaiThanhToan = DonHang::TRANG_THAI_THANH_TOAN;

        return view('client.donhangs.show', compact('donHang', 'trangThaiDonHang', 'trangThaiThanhToan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    function generateUniqueOrderCode()
    {
        do {
            $orderCode = 'ORD-' . Auth::id() . '-' . now()->timestamp;
        } while (DonHang::where('ma_don_hang', $orderCode)->exists());

        return $orderCode;
    }
}
