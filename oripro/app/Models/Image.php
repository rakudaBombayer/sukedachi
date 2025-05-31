<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $table = 'images';
    protected $primaryKey = 'image_ID';
    public $incrementing = true;
    protected $fillable = ['image'];

    public $timestamps = false; // ← これを追加

    
    public function request()
    {
        return $this->belongsTo(Request::class, 'image_ID'); 
    }
}