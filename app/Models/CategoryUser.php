<?php

namespace App\Models;

use App\Models\Link;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryUser extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function links()
    {
        return $this->hasMany(Link::class);
    }

    
}
