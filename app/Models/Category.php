<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $appends = ['visibility_status'];

    public function getVisibilityStatusAttribute()
    {
        return $this->is_visible ? 'Visible' : 'Hidden';
    }

    public function books()
    {
        return $this->hasMany(Book::class, 'category_id', 'id');
    }
}
