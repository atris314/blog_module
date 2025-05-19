<?php

namespace Modules\Blog\Http\Controllers;

use App\Http\Controllers\Controller;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Exception;
use Illuminate\Http\Request;
use Modules\Blog\Models\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::orderBy('created_at','desc')->get();
        return view('blogs::tags.index',get_defined_vars());
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
            $tag = new Tag();
            if(empty($request->slug))
            {
                $slug = SlugService::createSlug(Tag::class, 'slug', $request->title);
            }else
            {
                $slug = SlugService::createSlug(Tag::class, 'slug', $request->slug);
            }
            $tag->slug = $slug;

            $tag->title = $request->title;
            $tag->save();

            return redirect()->route('blogs.tags')->with('success', 'با موفقیت ایجاد شد');

        }
        catch (\Exception $exception)
        {
            return redirect()->back()->with('warning', 'خطایی رخ داده است، لطفا مجددا تلاش نمایید');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        try {
            if(empty($request->slug))
            {
                $slug = SlugService::createSlug(Tag::class, 'slug', $request->title);
                $tag->slug = $slug;
            }else
            {
                if ($request->slug == $tag->slug)
                {
                    $tag->slug = $request->slug;
                }
                else {
                    $slug = SlugService::createSlug(Tag::class, 'slug', $request->slug);
                    $tag->slug = $slug;
                }
            }
            $tag->title = $request->title;
            $tag->update();

            return redirect()->route('blogs.tags')->with('success', 'با موفقیت ویرایش شد');

        }
        catch (\Exception $exception)
        {
            return redirect()->back()->with('warning', 'خطایی رخ داده است، لطفا مجددا تلاش نمایید');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        try{
            $tag->delete();
            return redirect(route('blogs.tags'))->with('success', 'با موفقیت حذف شد');
        }catch (Exception $exception){
            return redirect()->back()->with('warning', 'خطایی رخ داده است، لطفا مجددا تلاش نمایید');
        }
    }
}
