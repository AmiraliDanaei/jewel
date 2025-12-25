<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    
    public function index()
    {
        $coupons = Coupon::latest()->get();
        return view('admin.coupons.index', compact('coupons'));
    }

    
    public function create()
    {
        return view('admin.coupons.create');
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|unique:coupons,code',
            'type' => 'required|in:fixed,percent',
            'value' => 'required|integer|min:0',
            'expires_at' => 'nullable|date',
        ]);
        Coupon::create($validated);
        return redirect()->route('admin.coupons.index')->with('success', 'کوپن با موفقیت ساخته شد.');
    }

    
    public function edit(Coupon $coupon)
    {
        return view('admin.coupons.edit', compact('coupon'));
    }

    
    public function update(Request $request, Coupon $coupon)
    {
        $validated = $request->validate([
            'code' => 'required|string|unique:coupons,code,'.$coupon->id,
            'type' => 'required|in:fixed,percent',
            'value' => 'required|integer|min:0',
            'expires_at' => 'nullable|date',
        ]);
        $coupon->update($validated);
        return redirect()->route('admin.coupons.index')->with('success', 'کوپن با موفقیت آپدیت شد.');
    }

    
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->route('admin.coupons.index')->with('success', 'کوپن با موفقیت حذف شد.');
    }
}
