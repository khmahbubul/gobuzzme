@extends('layouts.master')
@section('bodyclass')

    <body class="bg-userside">
    @endsection
    @section('jumbotron')
        <div class="jumbotron">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h1 class="display-4">My Posts</h1>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('content')
        <div class="container pt-5 pb-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table text-white">
                            <thead>
                                <tr>
                                    <th class="col">Title</th>
                                    <th class="col">Last Updated</th>
                                    <th class="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                    <tr>
                                        <td>
                                            <a target="_blank"
                                                href="{{ url('posts') . '/' . $post->post_slug }}">{{ $post->post_title }}</a>
                                        </td>
                                        <td>{{ $post->updated_at }}</td>
                                        <td>
                                            <a href="{{ url('/user-promotes-select-package') . '/' . $post->post_slug }}"
                                                class="btn btn-success">
                                                <i class="icon-play"></i>
                                                Promote
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    {{ $posts->withQueryString()->links() }}
                </div>
            </div>
        </div>
    @endsection
