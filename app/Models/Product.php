<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Scopes\StoreScope;
use App\Models\Cateogry;
use App\Models\Store;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';

    protected static function booted()
    {
        static::addGlobalScope('store', new StoreScope());
    }

    public function category()
    {
       return $this->belongsTo(Cateogry::class,'cateogry_id','id');
    }

    public function store()
    {
       return $this->belongsTo(Store::class,'store_id','id');
    }
}




