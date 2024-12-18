<?php

namespace App\Http\Controllers\Actl;

use App\Http\Controllers\Controller;
use App\Models\Purchaseorderc;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Carbon;

class PurchaseOrderCController extends Controller
{
    public function PurchaseOrderCAll(){
    $purchaseOrderc = Purchaseorderc::latest()->get();
    return view('backend.purchaseOrderc.purchaseOrderc_all',compact('purchaseOrderc'));
    }

    public function PurchaseOrderCAdd(){
        return view('backend.purchaseOrderc.purchaseOrderc_add');
}
}
