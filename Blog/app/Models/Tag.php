<?php

namespace Modules\Blog\app\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Blog\Database\Factories\TagBlogFactory;

class Tag extends Model
{
    use HasFactory;
    use Sluggable;

    protected $guarded = ['id', 'created_at', 'updated_at'];
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

     protected static function newFactory(): TagBlogFactory
     {
          return TagBlogFactory::new();
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
