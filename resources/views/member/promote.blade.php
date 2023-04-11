@extends('layouts.master')
@section('bodyclass')

    <body class="bg-userside">
    @endsection
    @section('jumbotron')
        <div class="jumbotron">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h1 class="display-4">My Orders</h1>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('content')
        <div class="container pt-2 pb-5">
            <div class="row ms-3 me-3">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link @if (request('status') !== '0') active @endif"
                            href="{{ url('user-orders') }}">ACTIVE</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (request('status') === '0') active @endif"
                            href="{{ url('user-orders') }}?status=0">COMPLETED</a>
                    </li>
                </ul>
            </div>

            <div class="row my-3">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table" style="color: var(--text-color);">
                            <thead>
                                <tr>
                                    <th class="col">Title</th>
                                    <th class="col">Views</th>
                                    <th class="col">Price</th>
                                    <th class="col">Time</th>
                                    <th class="col">Package</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($promotes as $promote)
                                    @continue(!isset($promote->post))
                                    <tr>
                                        <td>
                                            @if (!empty($promote->post->post_media))
                                                <img class="img-fluid" style="max-width: 50px;"
                                                    src="{{ url('/uploads/' . $promote->post->post_media) }}"
                                                    alt="{{ $promote->post->media_alt }}">
                                            @endif
                                            <a target="_blank"
                                                href="{{ url('posts') . '/' . $promote->post->post_slug }}">{{ $promote->post->post_title }}</a>
                                        </td>
                                        <td>{{ $promote->post->counter }}</td>
                                        <td>${{ $promote->price }}</td>
                                        <td>{{ $promote->created_at }}</td>
                                        <td>{{ $promote->package->title }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    {{ $promotes->withQueryString()->links() }}
                </div>
            </div>
        </div>
    @endsection
