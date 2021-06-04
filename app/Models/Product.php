<?php

namespace App\Models;

use App\Models\Image;
use Illuminate\Database\Eloquent\Model;
use CloudinaryLabs\CloudinaryLaravel\MediaAlly;

class Product extends Model
{
    use MediaAlly;
    protected $fillable = ['name','stock','price','category','image'];
    
    public function images()
    {
        return $this->hasMany(Image::class);
    }
    
}
