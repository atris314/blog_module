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
                    لیست مقالات
                </li>
            </ol>
        </nav>
    </div>
    <hr>

    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-end">
                <a href="{{ route('blogs.create') }}" class="btn btn-primary btn-sm">افزودن مقاله</a>
            </div>
            <hr>
            <div class="table-responsive">
                <table id="table" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>نام</th>
                        <th>دسته بندی</th>
                        <th style='width:50px;'>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($blogs as $blog)
                        <tr>
                            <td> {{ $blog->title }}</td>
                            <td>{{$blog->category?->title}}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('blogs.edit',$blog->slug) }}" class='text-warning'>
                                        <i class="bx bxs-edit"></i>
                                    </a>
                                    <a href="#" onclick="openDeleteModal('{{ route('blogs.destroy',$blog->id) }}', '{{$blog->title}}')"
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

    <div class="modal fade" id="deleteBlogModal" tabindex="-1" aria-labelledby="deleteBlogModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteBlogModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" id='deleteForm'>
                    <div class="modal-body">
                        آیا از حذف مقاله مطمئن هستید؟
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
            $('#deleteBlogModalLabel').text(`حذف مقاله "${name}"`);
            $('#deleteForm').attr('action', url);
            $('#deleteBlogModal').modal('show');
        }
    </script>
@endpush
