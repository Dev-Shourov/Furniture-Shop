<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'prod_name',
        'prod_str',
        'prod_desc',
        'prod_ft_img',
        'prod_ad_img',
        'prod_qty',
        'prod_price',
        'prod_cat',
        'prod_tag',
        'prod_dis',
    ];
}
