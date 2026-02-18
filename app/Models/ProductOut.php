<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOut extends Model
{
    use HasFactory;

    protected $fillable = [
        'tag_id',
        'part_number',
        'time_out',
        'quantity',
    ];

    public function productIns()
    {
        return $this->hasMany(ProductIn::class);
    }
}
