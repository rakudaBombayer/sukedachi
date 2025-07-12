<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $table = 'requests';
    protected $primaryKey = 'request_ID';
    public $incrementing = true; // プライマリキーが自動増分の場合

    protected $fillable = [
        'user_ID',
        'help_category_ID',
        'help_details',
        'title',
        'requested_date',
        'image_ID',
        'payment_ID',
        'payment_method',
        'estimated_time',
        'general_area',
        'image_path' // 既存の画像パスカラム
    ];

    public function applicants()
    {
        return $this->hasMany(Applicant::class, 'request_ID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_ID');
    }

    // public function helpCategory()
    // {
    //     return $this->belongsTo(HelpCategory::class, 'help_category_ID');
    // }

    public function image()
    {
        return $this->belongsTo(Image::class, 'image_ID');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'payment_ID');
    }
}
