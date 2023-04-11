@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Package</h1>
    </div>
    <div class="box-white ms-3 me-3 shadow-sm">
        @include('layouts.errors')
        <form method="POST" action="{{ route('packages.update', $package) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3 row">
                <label for="title" class="col-sm-3 col-form-label">Package Title</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="title" name="title"
                        value="{{ old('title', $package->title) }}" required>
                    <small id="name" class="form-text text-muted">@lang('admin.required')</small>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="detail" class="col-sm-3 col-form-label">Package Detail</label>
                <div class="col-sm-9 myeditor">
                    <div id="pageeditor">{!! old('detail', $package->detail) !!}</div>
                    <input class="txtcont" type="hidden" name="detail" required>
                    <small id="name" class="form-text text-muted">@lang('admin.required')</small>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="price" class="col-sm-3 col-form-label">Package Price</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" id="price" name="price"
                        value="{{ old('price', $package->price) }}" required>
                    <small id="name" class="form-text text-muted">@lang('admin.required')</small>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="audience" class="col-sm-3 col-form-label">Audience</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="audience" name="audience"
                        value="{{ old('audience', $package->audience) }}" required>
                    <small id="name" class="form-text text-muted">@lang('admin.required')</small>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="duration" class="col-sm-3 col-form-label">Duration</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="duration" name="duration"
                        value="{{ old('duration', $package->duration) }}" required>
                    <small id="name" class="form-text text-muted">@lang('admin.required')</small>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="status" class="col-sm-3 col-form-label">Package Status</label>
                <div class="col-sm-9">
                    <select class="form-control" id="status" name="status" required>
                        <option value="1" @selected($package->status == 1)>Active</option>
                        <option value="0" @selected($package->status == 0)>Inactive</option>
                    </select>
                    <small id="name" class="form-text text-muted">@lang('admin.required')</small>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="offset-sm-3 col-sm-9">
                    <button onclick="ClickSave()" type="submit" class="btn btn-primary me-2">@lang('admin.update')</button>
                    <a class="btn btn-danger" role="button" href="{{ url('packages') }}"> @lang('admin.cancel') </a>
                </div>
            </div>
        </form>
    </div>
@endsection
@push('scripts')
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
