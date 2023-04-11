@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">View Package</h1>
    </div>
    <div class="box-white ms-3 me-3 shadow-sm">
        @include('layouts.errors')
        <div class="mb-3 row">
            <label for="title" class="col-sm-3 col-form-label">Package Title</label>
            <div class="col-sm-9">
                {{ $package->title }}
            </div>
        </div>
        <div class="mb-3 row">
            <label for="detail" class="col-sm-3 col-form-label">Package Detail</label>
            <div class="col-sm-9">
                <p>{!! $package->detail !!}</p>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="price" class="col-sm-3 col-form-label">Package Price</label>
            <div class="col-sm-9">
                ${{ $package->price }}
            </div>
        </div>
        <div class="mb-3 row">
            <label for="status" class="col-sm-3 col-form-label">Package Status</label>
            <div class="col-sm-9">
                @if ($package->status)
                    <span class="badge bg-success">Active</span>
                @else
                    <span class="badge bg-danger">Inactive</span>
                @endif
            </div>
        </div>
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
