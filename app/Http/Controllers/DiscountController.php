<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discount;

class DiscountController extends Controller
{
    public function index() {
        $discounts = Discount::all();
        return view('admin.discount.index', compact('discounts'));
    }
}
