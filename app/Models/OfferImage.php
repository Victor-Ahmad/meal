<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferImage extends Model
{
    use HasFactory; 
    protected $guarded = ['id'];
    
        public $timestamps = false;
    
        protected $table = 'offer_images';
    
        protected $fillable = [
            'offer_id',
            'image',
        ];
    
        public function product()
        {
            return $this->belongsTo(Offer::class,'offer_id');
        }
    
}
