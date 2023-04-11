@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Promote</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
        </div>
    </div>
    <div class="row ms-3 me-3">
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link @if (request('status') !== '0') active @endif" href="{{ url('/promotes/') }}">Running</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (request('status') === '0') active @endif"
                    href="{{ url('/promotes/') }}?status=0">Completed</a>
            </li>
        </ul>
    </div>
    <div class="row box-white ms-3 me-3 mt-2 shadow-sm">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Post</th>
                    <th scope="col">Package</th>
                    <th scope="col">Price</th>
                    <th scope="col">Start Date</th>
                    @if (request('status') === '0')
                        <th scope="col">End Date</th>
                    @endif
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($promotes as $promote)
                    @continue(!isset($promote->post))
                    <tr>
                        <td><a href="{{ url('posts') . '/' . $promote->post->post_slug }}"
                                target="_blank">{{ $promote->post->post_title }}</a></td>
                        <td><a href="{{ route('packages.show', $promote->package->id) }}"
                                target="_blank">{{ $promote->package->title }}</a></td>
                        <td>${{ $promote->price }}</td>
                        <td>{{ $promote->created_at }}</td>
                        @if (request('status') === '0')
                            <td>{{ $promote->updated_at }}</td>
                        @endif
                        <td>
                            @if ($promote->status)
                                <form action="{{ route('promotes.update', $promote) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn btn-success" type="submit">Mark Complete</button>
                                </form>
                            @else
                                <span class="badge bg-success">Completed</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-md-12">
            {{ $promotes->withQueryString()->links() }}
        </div>
    </div>
@endsection
