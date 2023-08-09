@section('page-title')
    Create New
@endsection
@extends('frontend.layouts.authuser')
@section('user-content')
    <style>
        .ck_editor__editable_inline{
            height: 450px !important;
        }
    </style>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
    <div class="col-12 mb-2 col-md-9">
        <div class="card">
            <div class="card-header">
                New Blog
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="blog-title" class="form-label">Title of your blog</label>
                        <input type="text" name="title" class="form-control" id="blog-title"
                            placeholder="Your blog's title">
                    </div>
                    <div class="mb-3">
                        <label for="cover-image" class="form-label">Cover image of your blog</label>
                        <input type="file" name="cover-image" class="form-control" id="cover-image"
                            placeholder="Blog's cover">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Write your blogs</label>
                        <textarea class="form-control" id="editor"></textarea>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary float-end">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
