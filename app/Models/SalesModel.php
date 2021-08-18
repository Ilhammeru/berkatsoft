<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesModel extends Model
{
    use HasFactory;
    
    protected $table = "sales";
    protected $fillable = [
        'date',
        'customer_id',
        'product_id',
        'created_at',
        'updated_at'
    ];

    public $timestamps = false;
}
