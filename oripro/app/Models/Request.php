<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;
    
    protected $table = 'requests';
    protected $primaryKey = 'request_ID';
    protected $fillable = [
        'user_ID', 'help_category_ID', 'title', 'requested_date',
        'image_ID', 'payment_ID', 'payment_method', 'estimated_time', 'general_area'
    ];

    public function applicants()
    {
        return $this->hasMany(Applicant::class, 'request_ID');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_ID');
    }

    public function helpCategory()
    {
        return $this->hasMany(HelpCategory::class, 'help_category_ID');
    }

    public function image()
    {
        return $this->hasMany(Image::class, 'image_ID');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'payment_ID');
    }
    
}