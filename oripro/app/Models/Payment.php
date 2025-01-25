<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';
    protected $primaryKey = 'payment_ID';
    protected $fillable = ['payment_method', 'amount', 'item_name'];

    public function requests()
    {
        return $this->hasOne(Request::class, 'payment_ID');
    }
}