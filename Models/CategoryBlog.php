<?php

namespace Modules\Blog\app\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Blog\Database\Factories\CategoryBlogFactory;

class CategoryBlog extends Model
{
    use HasFactory;
    use Sluggable;

    protected $guarded = ['id', 'created_at', 'updated_at'];
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['title','slug','meta_title','meta_description'];

     protected static function newFactory(): CategoryBlogFactory
     {
          return CategoryBlogFactory::new();
     }



    public function Sluggable() : array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
