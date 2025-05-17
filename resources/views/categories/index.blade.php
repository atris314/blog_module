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
                <li class="breadcrumb-item active" aria-current="page">
                    لیست دسته بندی مقالات
                </li>
            </ol>
        </nav>
    </div>
    <hr>

    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-end">
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#createCategoryModal">افزودن دسته بندی</button>
            </div>
            <hr>
            <div class="table-responsive">
                <table id="table" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>نام</th>
                        <th style='width:50px;'>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($categoryBlogs as $categoryBlog)
                        <tr>
                            <td> {{$loop->iteration}}</td>
                            <td> {{ $categoryBlog->title }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="#"
                                       onclick="openEditModal('{{ route('blogs.categories.update',$categoryBlog->id) }}', JSON.stringify({title:'{{$categoryBlog->title}}', slug:'{{$categoryBlog->slug}}', meta_title:'{{$categoryBlog->meta_title}}', description:'{{$categoryBlog->meta_description}}'}))"
                                       class='text-warning'>
                                        <i class="bx bxs-edit"></i>
                                    </a>
                                    <a href="#" onclick="openDeleteModal('{{ route('blogs.categories.destroy',$categoryBlog->id) }}','{{ $categoryBlog->title }}')"
                                       class="text-danger ms-3">
                                        <i class="bx bxs-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createCategoryModalLabel">
                        افزودن دسته بندی
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('blogs.categories.store')}}" method="post" id='createForm'>
                    @csrf
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="title" class="form-label">نام دسته بندی</label>
                                <input type="text" name="title" value="{{old('title')}}" class="form-control" id="title" required>
                                <div class="invalid-feedback">نام دسته بندی الزامی است</div>
                            </div>
                            <div class="col-12">
                                <label for="slug" class="form-label">نامک دسته بندی</label>
                                <input type="text" name="slug" value="{{old('slug')}}" class="form-control" id="slug" >
                            </div>
                            <div class="col-12">
                                <label for="title" class="form-label">عنوان سئو </label>
                                <input type="text" name="meta_title" value="{{old('meta_title')}}"  class="form-control" id="title" >
                            </div>
                            <div class="col-12">
                                <label for="meta_description" class="form-label">توضیحات متا سئو</label>
                                <input type="text" name="meta_description" value="{{old('meta_description')}}" class="form-control" id="meta_description">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">
                            ثبت دسته بندی
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCategoryModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post" id='editForm'>
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="title" class="form-label">نام دسته بندی</label>
                                <input type="text" name="title" class="form-control" id="title" required>
                                <div class="invalid-feedback">نام دسته بندی الزامی است</div>
                            </div>
                            <div class="col-12">
                                <label for="slug" class="form-label">نامک دسته بندی</label>
                                <input type="text" name="slug" class="form-control" id="slug" >
                            </div>
                            <div class="col-12">
                                <label for="meta_title" class="form-label">عنوان سئو</label>
                                <input type="text" name="meta_title" class="form-control" id="meta_title" >
                            </div>
                            <div class="col-12">
                                <label for="description" class="form-label">توضیحات متا</label>
                                <input type="text" name="meta_description" class="form-control" id="description" >
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">
                            ویرایش دسته بندی
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteCategoryModal" tabindex="-1" aria-labelledby="deleteCategoryModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteCategoryModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" id='deleteForm'>
                    <div class="modal-body">
                        آیا از حذف دسته بندی مطمئن هستید؟
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
                            خیر
                        </button>
                        <button type="submit" class="btn btn-danger">
                            بله
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                language: {
                    "url": dataTableLangUrl
                }
            });
        });

        function openDeleteModal(url, name) {
            $('#deleteCategoryModalLabel').text(`حذف دسته بندی "${name}"`);
            $('#deleteForm').attr('action', url);
            $('#deleteCategoryModal').modal('show');
        }

        function openEditModal(url, currentData) {
            let data = JSON.parse(currentData);

            $('#editCategoryModalLabel').text(`ویرایش دسته بندی "${data.title}"`);

            $('#editForm #title').val(data.title);
            $('#editForm #slug').val(data.slug);
            $('#editForm #meta_title').val(data.meta_title);
            $('#editForm #description').val(data.description);

            $('#editForm').attr('action', url);

            $('#editCategoryModal').modal('show');
        }
    </script>
@endpush
