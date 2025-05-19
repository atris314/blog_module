<?php

namespace Modules\Blog\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Blog\Models\CategoryBlog;
use Modules\Blog\Models\Tag;

// use Modules\Blog\Database\Factories\BlogFactory;

class Blog extends Model
{
    use HasFactory;
    use Sluggable;

    protected $guarded = ['id', 'created_at', 'updated_at'];
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['title','slug','main_image','image','content','meta_title'
        ,'meta_keyword','meta_description','category_id','user_id'];

     protected static function newFactory(): BlogFactory
     {
          return BlogFactory::new();
     }


    public function category()
    {
        return $this->belongsTo(CategoryBlog::class,'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class,'blog_tag','blog_id','tag_id');
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
