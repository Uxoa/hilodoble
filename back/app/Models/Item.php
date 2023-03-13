<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;


    static $rules = [
        'itemName' => 'required|max:255',
        'category' => 'required|max:255',
        'description' => 'required',
        'image' => 'required|url',
        'stockQuantity' => 'required|integer|min:0',
        'price' => 'required|numeric|min:0',
    ];


    protected $fillable = [
        'itemName',
        'category',
        'description',
        'image',
        'stockQuantity',
        'price',
    ];


    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }



}
