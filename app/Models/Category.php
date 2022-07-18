<?php

namespace App\Models;

use App\Models\Link;
use App\Models\Ketua;
use App\Models\Office;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    
    public function ketuas()
    {
        return $this->hasMany(Ketua::class);
    }
    
    public function offices()
    {
        return $this->hasMany(Office::class);
    }
}
