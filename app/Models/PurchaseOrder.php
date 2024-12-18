<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;
    protected $table = "PurchaseOrderc";
    protected $guarded = [];

    public function supplierLink(){
        return $this->belongsTO(Supplier::class ,'name', 'name');
    }
}
