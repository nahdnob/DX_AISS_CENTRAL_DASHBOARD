<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'part_id',
        'part_number',
        'time_in',
        'qty_in',
        'tag_id',
        'time_out',
        'qty_out',
        'is_processed',
    ];
}
