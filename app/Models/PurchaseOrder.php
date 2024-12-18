<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;
    protected $table = "PurchaseOrderC";
    protected $guarded = [];

    public function purchaseordercLink(){
        return $this->belongsTO(Purchaseorderc::class ,'purchaseOrderC', 'purchaseOrderC');
    }
}
