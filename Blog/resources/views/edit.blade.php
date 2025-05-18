@extends('admin.index')

@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin') }}">
                        داشبورد
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('blogs.index') }}">
                        مقالات
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    ویرایش مقاله
                </li>
            </ol>
        </nav>
    </div>
    <hr>
    @php
        foreach ($blog->tags as $key => $tag_item) {
            $tag_items[$key] = $tag_item->id;
        }
    @endphp
    <div class="card">
        <div class="card-body p-4">
            <h5 class="card-title">ویرایش مقاله</h5>
            <hr />
            <form action='{{route('blogs.update',$blog->slug)}}' method="post" class="form-body mt-4 needs-validation" novalidate enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="border border-3 p-4 rounded">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="title" class="form-label">دسته بندی</label>
                            <select class="form-select" name="category_id" id="inputProductType" required>
                                <option>انتخاب کنید</option>
                                @foreach($categories as $category)
                                <option value="{{$category->id}}" @if($blog->category_id == $category->id) selected @endif>{{$category->title}} </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">دسته بندی الزامی است</div>
                        </div>
                        <div class="col-md-12">
                            <label for="techStacks" class="form-label">تگ های مقاله</label>
                            <select class="form-select" id="techStacks" name="tag_id[]" data-placeholder="انتخاب کنید" multiple required>
                                @foreach($tags as $tag)
                                    <option value="{{$tag->id}}" @if(in_array($tag['id'], $tag_items)) selected @endif>{{$tag->title}} </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">تگ های مقاله الزامی است</div>
                        </div>
                        <div class="col-md-6">
                            <label for="title" class="form-label">نام مقاله</label>
                            <input type="text" name="title" value="{{$blog->title}}" class="form-control" id="title" required>
                            <div class="invalid-feedback">نام مقاله الزامی است</div>
                        </div>
                        <div class="col-md-6">
                            <label for="slug" class="form-label">نامک مقاله</label>
                            <input type="text" name="slug" value="{{$blog->slug}}" class="form-control" id="slug" required>
                            <div class="invalid-feedback">نامک مقاله الزامی است</div>
                        </div>
                        <div class="col-md-12">
                            <label for="description" class="form-label">توضیحات متا</label>
                            <input type="text" name="meta_description" value="{{$blog->meta_description}}" class="form-control" id="description">
                        </div>
                        <div class="col-md-5">
                            <label for="image" class="form-label">تصویر شاخص مقاله</label>
                            <input type="file" name="image" class="form-control" id="image" accept="image/*"
                              @if(!$blog->image)   required @endif>
                            <div class="invalid-feedback">تصویر شاخص مقاله الزامی است</div>
                        </div>
                        <div class="col-md-1 product-img">
                            <img src="{{url($blog->image)}}">
                        </div>
                        <div class="col-md-6">
                            <label for="imageAlt" class="form-label">توضیح تصویر شاخص</label>
                            <input type="text" name="alt" value="{{$blog->alt}}" class="form-control" id="imageAlt">
                        </div>
                        <div class="col-11">
                            <label for="banner" class="form-label">بنر مقاله</label>
                            <input type="file" name="banner" class="form-control" id="banner" accept="image/*">
                        </div>
                        <div class="col-1 product-img">
                            <img src="{{url($blog->banner)}}">
                        </div>
                        <hr>
                        <div class="col-12">
                            <label for="textOne" class="form-label">محتوا</label>
                            <textarea name="description" id="textOne" cols="30" rows="10">{{$blog->content}}</textarea>
                        </div>
                        <div class="col-12 mt-5">
                            <div class="d-flex align-items-center justify-content-end">
                                <button type="submit" class="btn btn-success">
                                    ویرایش مقاله
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(function() {
            $('#textOne').summernote();
        });

        $(function() {
            $('#techStacks').select2({
                theme: "bootstrap-5"
            });
        });
    </script>

@endpush
