<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $table = 'images';
    protected $primaryKey = 'image_ID';
    protected $fillable = ['image'];
    
    public function requests()
    {
        return $this->belongsTo(Request::class, 'image_ID');
    }
}