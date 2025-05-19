<?php

namespace Modules\Blog\Http\Controllers;

use App\Http\Controllers\Controller;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Exception;
use Illuminate\Http\Request;
use Modules\Blog\Models\CategoryBlog;

class CategoryBlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categoryBlogs = CategoryBlog::orderBy('created_at','desc')->get();
        return view('blogs::categories.index',get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $categoryBlog = new CategoryBlog();

            if(empty($request->slug))
            {
                $slug = SlugService::createSlug(CategoryBlog::class, 'slug', $request->title);
            }else
            {
                $slug = SlugService::createSlug(CategoryBlog::class, 'slug', $request->slug);
            }
            $categoryBlog->slug = $slug;
            $categoryBlog->title = $request->title;

            if ($request->meta_title)
            {
                $categoryBlog->meta_title = $request->meta_title;
            }
            if ($request->meta_description)
            {
                $categoryBlog->meta_description = $request->meta_description;
            }

            $categoryBlog->save();

            return redirect()->route('blogs.categories')->with('success', 'با موفقیت ایجاد شد');

        }
        catch (\Exception $exception)
        {
            return redirect()->back()->with('warning', 'خطایی رخ داده است، لطفا مجددا تلاش نمایید');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CategoryBlog $categoryBlog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CategoryBlog $categoryBlog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CategoryBlog $categoryBlog)
    {
        try {
            if(empty($request->slug))
            {
                $slug = SlugService::createSlug(CategoryBlog::class, 'slug', $request->title);
                $categoryBlog->slug = $slug;
            }else
            {
                if ($request->slug == $categoryBlog->slug)
                {
                    $categoryBlog->slug = $request->slug;
                }
                else {
                    $slug = SlugService::createSlug(CategoryBlog::class, 'slug', $request->slug);
                    $categoryBlog->slug = $slug;
                }
            }
            $categoryBlog->title = $request->title;

            if ($request->meta_title)
            {
                $categoryBlog->meta_title = $request->meta_title;
            }
            if ($request->meta_description)
            {
                $categoryBlog->meta_description = $request->meta_description;
            }

            $categoryBlog->update();

            return redirect()->route('blogs.categories')->with('success', 'با موفقیت ویرایش شد');

        }
        catch (\Exception $exception)
        {
            return redirect()->back()->with('warning', 'خطایی رخ داده است، لطفا مجددا تلاش نمایید');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryBlog $categoryBlog)
    {
        try{
            $categoryBlog->delete();
            return redirect(route('blogs.categories'))->with('success', 'با موفقیت حذف شد');
        }catch (Exception $exception){
            return redirect()->back()->with('warning', 'خطایی رخ داده است، لطفا مجددا تلاش نمایید');
        }
    }
}
