<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistributorProduct extends Model
{
    use HasFactory;
    
    protected $guarded = [
        'id'
    ];

    public function distributor() {
        return $this->belongsTo('App\Models\Distributor');
    }

    public function product() {
        return $this->belongsTo('App\Models\Product');
    }
}
