@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add New Package</h1>
    </div>
    <div class="box-white ms-3 me-3 shadow-sm">
        @include('layouts.errors')
        <form method="POST" action="{{ url('/packages') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 row">
                <label for="title" class="col-sm-3 col-form-label">Package Title</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="title" name="title" required>
                    <small id="name" class="form-text text-muted">@lang('admin.required')</small>
                </div>
            </div>
            <div class="mb-4 row">
                <label for="detail" class="col-sm-3 col-form-label">Package Detail</label>
                <div class="col-sm-9 myeditor">
                    <div id="pageeditor"></div>
                    <input class="txtcont" type="hidden" name="detail" required>
                    <small id="name" class="form-text text-muted">@lang('admin.required')</small>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="price" class="col-sm-3 col-form-label">Package Price</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" id="price" name="price" required>
                    <small id="name" class="form-text text-muted">@lang('admin.required')</small>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="audience" class="col-sm-3 col-form-label">Audience</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="audience" name="audience" required>
                    <small id="name" class="form-text text-muted">@lang('admin.required')</small>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="duration" class="col-sm-3 col-form-label">Duration</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="duration" name="duration" required>
                    <small id="name" class="form-text text-muted">@lang('admin.required')</small>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="status" class="col-sm-3 col-form-label">Package Status</label>
                <div class="col-sm-9">
                    <select class="form-control" id="status" name="status" required>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                    <small id="name" class="form-text text-muted">@lang('admin.required')</small>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="offset-sm-3 col-sm-9">
                    <button onclick="ClickSave()" type="submit" class="btn btn-primary me-2">@lang('admin.create')</button>
                    <a class="btn btn-danger" role="button" href="{{ url('packages') }}"> @lang('admin.cancel') </a>
                </div>
            </div>
        </form>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('quill/dist/quill.min.js') }}"></script>
    <script>
        function checkAll(o) {
            var boxes = document.getElementsByTagName('input');
            for (var x = 0; x < boxes.length; x++) {
                var obj = boxes[x];
                if (obj.type == 'checkbox') {
                    if (obj.name != 'check') obj.checked = o.checked;
                }
            }
        }

        function ClickSave() {
            let elements = document.querySelectorAll('.ql-editor');
            if (elements.length > 0) {
                elements.forEach(function(element) {
                    element.closest('.myeditor').querySelector('.txtcont').value =
                        element.innerHTML;
                });
            }
        }
    </script>

    <script>
        var toolbarOptions = [
            ['bold', 'italic', 'underline', 'strike'],
            ['blockquote', 'code-block', 'link', 'image'],
            [{
                'list': 'ordered'
            }, {
                'list': 'bullet'
            }],
            [{
                'color': []
            }, {
                'background': []
            }],
            ['clean']
        ];

        var Image = Quill.import('formats/image');
        Image.className = 'img-fluid';
        Quill.register(Image, true);

        var quill = new Quill('#pageeditor', {
            theme: 'snow',
            modules: {
                toolbar: toolbarOptions
            },
        });
    </script>
@endpush
