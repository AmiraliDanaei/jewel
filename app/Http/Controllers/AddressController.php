<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the user's addresses.
     */
    public function index()
    {
        $addresses = auth()->user()->addresses()->latest()->get();
        return view('profile.addresses.index', compact('addresses'));
    }

    /**
     * Show the form for creating a new address.
     */
    public function create()
    {
        
        $provinces = [
            'آذربایجان شرقی', 'آذربایجان غربی', 'اردبیل', 'اصفهان', 'البرز', 'ایلام', 'بوشهر', 'تهران',
            'چهارمحال و بختیاری', 'خراسان جنوبی', 'خراسان رضوی', 'خراسان شمالی', 'خوزستان', 'زنجان',
            'سمنان', 'سیستان و بلوچستان', 'فارس', 'قزوین', 'قم', 'کردستان', 'کرمان', 'کرمانشاه',
            'کهگیلویه و بویراحمد', 'گلستان', 'گیلان', 'لرستان', 'مازندران', 'مرکزی', 'هرمزگان', 'همدان', 'یزد'
        ];

        
        return view('profile.addresses.create', compact('provinces'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'province' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address' => 'required|string',
            'postal_code' => 'required|string|max:20|unique:addresses,postal_code,NULL,id,user_id,'.auth()->id(),
        ]);

        auth()->user()->addresses()->create($validated);

        return redirect()->route('addresses.index')->with('success', 'آدرس جدید با موفقیت اضافه شد.');
    }
    
    
}
