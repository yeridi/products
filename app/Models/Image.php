<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use CloudinaryLabs\CloudinaryLaravel\MediaAlly;

class Image extends Model
{
    use MediaAlly;
    protected $fillable = ['product_id','url','key'];

    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
}
