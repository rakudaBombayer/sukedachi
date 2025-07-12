<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;

    protected $table = 'applicants';
    protected $primaryKey = 'applicant_ID';
    protected $fillable = ['user_ID', 'request_ID'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_ID');
    }

    public function request()
    {
        return $this->belongsTo(Request::class, 'request_ID');
    }
}
