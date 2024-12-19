<?php

namespace App\Http\Controllers\Actl;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Carbon;

use App\Models\Purchaseorder;
use App\Models\Product;
use App\Models\Family;
use App\Models\TaxRate;
use App\Models\UnitMeasure;
use App\Models\Supplier;

class PurchaseOrderController extends Controller
{
    public function PurchaseOrderAll(){
        $purchaseOrderCs = PurchaseOrder::latest()->get();
        return view('backend.purchaseOrder.purchaseOrder_all',compact('purchaseOrderCs'));
    }

    public function PurchaseOrderAdd(){
        // $suppliers = Supplier::all();
        $suppliers = Supplier::latest()->get();
        $familys = Family::latest()->get();
        $products = Product::latest()->get();
        
        $unitMeasures = UnitMeasure::latest()->get();
        return view('backend.purchaseOrder.purchaseOrder_add', compact('suppliers', 'unitMeasures', 'familys', 'products'));
}
}
