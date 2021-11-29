<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OderProduct extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'oder_id',  'name', 'price', 'quantity'];
    public function oder()
    {
        $this->belongsTo(Oder::class);
    }
}