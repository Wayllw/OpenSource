<?php

namespace App\Http\Controllers\Actl;

use App\Http\Controllers\Controller;
use App\Models\Purchaseorder;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Carbon;

class PurchaseOrderController extends Controller
{
    public function PurchaseOrderAll(){
        $purchaseOrderCs = PurchaseOrder::latest()->get();
        return view('backend.purchaseOrder.purchaseOrder_all',compact('purchaseOrderCs'));
    }

    public function PurchaseOrderAdd(){
        return view('backend.purchaseOrder.purchaseOrder_add');
}
}
