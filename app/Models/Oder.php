<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Oder extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['user_id', 'sub_total', 'tax', 'note', 'address', 'phone', 'name', 'status'];
    public function oderProducts()
    {
        $this->hasMany(OderProduct::class);
    }
}