<?php

namespace Modules\Blog\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Exception;
use Illuminate\Http\Request;
use Modules\Blog\app\Models\Blog;
use Modules\Blog\app\Models\CategoryBlog;
use Modules\Blog\app\Models\Tag;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::orderBy('created_at','desc')->get();
        return view('blogs::index',get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = CategoryBlog::get();
        $tags = Tag::get();
        return view('blogs::create',get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $blog = new Blog();
            $blog->title = $request->title;
            $blog->content = $request->description;
            $blog->category_id = $request->category_id;

            if(empty($request->slug))
            {
                $slug = SlugService::createSlug(Blog::class, 'slug', $request->title);
            }else
            {
                $slug = SlugService::createSlug(Blog::class, 'slug', $request->slug);
            }
            $blog->slug = $slug;

            if ($blog->meta_description)
            {
                $blog->meta_description = $request->meta_description;
            }
            if ($request->file('image'))
            {
                $blog->image = file_upload($request->image, 'assets/uploads/photos/blogs/image/', '');
            }
            if ($request->file('banner'))
            {
                $blog->banner = file_upload($request->banner, 'assets/uploads/photos/blogs/banner/', '');
            }
            if ($request->alt)
            {
                $blog->alt = $request->alt;
            }
            $blog->save();
            $blog->tags()->attach($request->tag_id);
            return redirect()->route('blogs.index')->with('success', 'با موفقیت ثبت شد');

        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('warning', 'خطایی رخ داده است، لطفا مجددا تلاش نمایید');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {

        $categories = CategoryBlog::get();
        $tags = Tag::get();
        return view('blogs::edit',get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        try {
            $blog->title = $request->title;
            $blog->content = $request->description;
            $blog->category_id = $request->category_id;

            if(empty($request->slug))
            {
                $slug = SlugService::createSlug(Blog::class, 'slug', $request->title);
                $blog->slug = $slug;
            }else
            {
                if ($request->slug == $blog->slug)
                {
                    $blog->slug = $request->slug;
                }
                else {
                    $slug = SlugService::createSlug(Blog::class, 'slug', $request->slug);
                    $blog->slug = $slug;
                }
            }

            if ($blog->meta_description)
            {
                $blog->meta_description = $request->meta_description;
            }
            if ($request->file('image'))
            {
                $blog->image = file_upload($request->image, 'assets/uploads/photos/blogs/image/', '');
            }
            if ($request->file('banner'))
            {
                $blog->banner = file_upload($request->banner, 'assets/uploads/photos/blogs/banner/', '');
            }
            if ($request->alt)
            {
                $blog->alt = $request->alt;
            }
            $blog->update();
            $blog->tags()->sync($request->tag_id);

            return redirect()->route('blogs.index')->with('success', 'با موفقیت بروزرسانی شد');


        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('warning', 'خطایی رخ داده است، لطفا مجددا تلاش نمایید');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        try{
            $blog->delete();
            return redirect(route('blogs.index'))->with('success', 'با موفقیت حذف شد');
        }catch (Exception $exception){
            return redirect()->back()->with('warning', 'خطایی رخ داده است، لطفا مجددا تلاش نمایید');
        }
    }
}
