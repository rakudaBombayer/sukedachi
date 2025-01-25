<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class HelpCategory extends Model
{
    use HasFactory;
    
    protected $table = 'help_categories';
    protected $primaryKey = 'help_category_ID';
    protected $fillable = ['help_name','help_details'];

    public function requests()
    {
        return $this->belongsTo(Request::class, 'help_category_ID');
    }

}