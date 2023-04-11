@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Packages</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a class="btn btn-success fw-bold" href="{{ url('/packages/create/') }}" role="button">Add New Package</a>
        </div>
    </div>
    <div class="row box-white ms-3 me-3 mt-2 shadow-sm">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">@lang('admin.title')</th>
                    <th scope="col">Price</th>
                    <th scope="col">Audience</th>
                    <th scope="col">Duration</th>
                    <th scope="col">Status</th>
                    <th scope="col">@lang('admin.edit')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($packages as $package)
                    <tr>
                        <td>
                            <a href="{{ route('packages.show', $package) }}">{{ $package->title }}</a>
                        </td>
                        <td>${{ $package->price }}</td>
                        <td>{{ $package->audience }}</td>
                        <td>{{ $package->duration }}</td>
                        <td>
                            @if ($package->status)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('packages.edit', $package) }}">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-md-12">
            {{ $packages->links() }}
        </div>
    </div>
@endsection
