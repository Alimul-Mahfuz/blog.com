@section('title')
    Edit Blog Page
@endsection
@extends('frontend.layouts.authuser')
@section('user-content')
    <style>
        .ck_editor__editable_inline {
            height: 450px !important;
        }
    </style>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
    <div class="col-12 mb-2 col-md-9">
        <div class="card">
            @if (session('success'))
                <x-alert type='success'>
                    {{ session('success') }}
                </x-alert>
            @endif
            <div class="card-header">
                Edit Blog
            </div>
            <div class="card-body">
                <img src="{{ asset('storage/' . $post->cover_image) }}" style="max-height: 300px;" class="img-fluid w-100 mb-3"
                    alt="...">
                {{-- PUT method is not directly support. --}}
                <form action="{{ route('post.update', ['post' => $post->id]) }}" method="post"
                    enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <div class="mb-3">
                        <label for="blog-title" class="form-label">Title of your blog</label>
                        <input type="text" name="title" value="{{ $post->title }}" class="form-control"
                            id="blog-title" placeholder="Your blog's title">
                        @error('title')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="cover-image" class="form-label">Cover image of your blog</label>
                        <input type="file" name="cover_image" class="form-control" id="cover-image"
                            placeholder="Blog's cover">
                        @error('cover_image')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Write your blogs</label>
                        <textarea class="form-control" name="blog_body" id="editor">{{ $post->description }}</textarea>
                    </div>
                    <div class="mb-3">
                        <div class="float-end">
                            <button class="d-inline-block btn btn-primary" type="submit">Save</button>
                            <button id="btn-del" type="button" class="d-inline-block btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#delete_confirmation_modal">Delete</button>
                        </div>
                    </div>
                </form>
                <!-- Modal -->
                <div class="modal fade" id="delete_confirmation_modal" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="delete_confirmation_modalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="delete_confirmation_modalLabel">Modal title</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{route('post.destroy',['post'=>$post->id])}}" method="post">
                                @csrf
                                @method('delete')
                                <div class="modal-body">
                                    <p>Are you sure to delete this post? Action cannot be undone</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Understood</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Custom upload adapter class
        class MyUploadAdapter {
            constructor(loader) {
                // The file loader instance to use during the upload. It sounds scary but do not
                // worry — the loader will be passed into the adapter later on in this guide.
                this.loader = loader;
            }
            // Starts the upload process.
            upload() {
                return this.loader.file
                    .then(file => new Promise((resolve, reject) => {
                        this._initRequest();
                        this._initListeners(resolve, reject, file);
                        this._sendRequest(file);
                    }));
            }

            // Aborts the upload process.
            abort() {
                if (this.xhr) {
                    this.xhr.abort();
                }
            }

            // Initializes the XMLHttpRequest object using the URL passed to the constructor.
            _initRequest() {
                const xhr = this.xhr = new XMLHttpRequest();

                // Note that your request may look different. It is up to you and your editor
                // integration to choose the right communication channel. This example uses
                // a POST request with JSON as a data structure but your configuration
                // could be different.
                xhr.open('POST', '{{ route('user.post.cke-image') }}', true);
                xhr.setRequestHeader('x-csrf-token', '{{ csrf_token() }}');
                xhr.responseType = 'json';
            }

            // Initializes XMLHttpRequest listeners.
            _initListeners(resolve, reject, file) {
                const xhr = this.xhr;
                const loader = this.loader;
                const genericErrorText = `Couldn't upload file: ${ file.name }.`;

                xhr.addEventListener('error', () => reject(genericErrorText));
                xhr.addEventListener('abort', () => reject());
                xhr.addEventListener('load', () => {
                    const response = xhr.response;

                    // This example assumes the XHR server's "response" object will come with
                    // an "error" which has its own "message" that can be passed to reject()
                    // in the upload promise.
                    //
                    // Your integration may handle upload errors in a different way so make sure
                    // it is done properly. The reject() function must be called when the upload fails.
                    if (!response || response.error) {
                        return reject(response && response.error ? response.error.message : genericErrorText);
                    }

                    // If the upload is successful, resolve the upload promise with an object containing
                    // at least the "default" URL, pointing to the image on the server.
                    // This URL will be used to display the image in the content. Learn more in the
                    // UploadAdapter#upload documentation.
                    resolve({
                        default: response.url
                    });
                });

                // Upload progress when it is supported. The file loader has the #uploadTotal and #uploaded
                // properties which are used e.g. to display the upload progress bar in the editor
                // user interface.
                if (xhr.upload) {
                    xhr.upload.addEventListener('progress', evt => {
                        if (evt.lengthComputable) {
                            loader.uploadTotal = evt.total;
                            loader.uploaded = evt.loaded;
                        }
                    });
                }
            }
            // Prepares the data and sends the request.
            _sendRequest(file) {
                // Prepare the form data.
                const data = new FormData();

                data.append('upload', file);

                // Important note: This is the right place to implement security mechanisms
                // like authentication and CSRF protection. For instance, you can use
                // XMLHttpRequest.setRequestHeader() to set the request headers containing
                // the CSRF token generated earlier by your application.

                // Send the request.
                this.xhr.send(data);
            }

        }

        // Activating a custom upload adapter
        function CKEUploadAdapterPlugin(editor) {
            editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                // Configure the URL to the upload script in your back-end here!
                return new MyUploadAdapter(loader);
            };
        }

        // Adding to the cke-editor
        ClassicEditor
            .create(document.querySelector('#editor'), {
                extraPlugins: [CKEUploadAdapterPlugin],

                // More configuration options.
                // ...
            })
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });

        // To viewing the upload file name
    </script>
@endsection
