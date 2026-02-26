<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Product extends Model {
    protected $guarded = [];
    protected $casts = [
        'images' => 'array',
        'before_after_images' => 'array',
        'show_before_after' => 'boolean',
    ];
}
