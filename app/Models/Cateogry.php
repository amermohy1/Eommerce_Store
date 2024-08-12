<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Product;
class Cateogry extends Model
{
    use HasFactory , SoftDeletes;
  
    protected $table = 'categories';
    protected $fillable = [
           'name',
           'parent_id',
           'slug',
           'description',
           'status',
           'slug',
           'image',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'cateogry_id','id');
    }

    public function parent()
    {
        return $this->belongsTo(Cateogry::class,'parent_id','id')
        ->withDefault([
            'name' => 'main Cateogry'
        ]);
    }

    public function children()
    {
        return $this->hasMany(Cateogry::class,'parent_id','id');

    }

    public function scopeFilter(Builder $builder,$filter)
    {
        if($filter['name'] ?? false){
            $builder->where('name' , 'LIKE' , "%{$filter['name']}%");
        }
        if($filter['status'] ?? false){
            $builder->where('status' , '=' , $filter['status']);
        }    }

    public static function rules($id = 0){
        return[
            'name' => [
            'required',
            'string',
            'min:3',
            'max:255',
            Rule::unique('categories','name')->ignore($id),
           // "unique:categories,name,$id",
            ],
            'parent_id' => [
                'nullable','int', 'exists:categories,id' 
            ],
            'image' => [
                'image','max:1048576','dimensions:min_width=100,min_height=100'
            ],
            'status' => 'required|in:active,archived',
        ];
    }


}
