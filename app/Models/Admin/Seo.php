<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    use HasFactory;
    protected $guarded;

    public function getPageAttribute($value)
    {
        return ucwords(str_replace('_', ' ', $value));
    }
}
