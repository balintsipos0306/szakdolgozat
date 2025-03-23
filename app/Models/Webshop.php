<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Webshop extends Model
{
    use HasFactory;

    protected $table = 'webshop';

    protected $fillable = [
        'name',
        'text',
        'image_path',
        'price',

    ];
}
