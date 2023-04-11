@extends('layouts.master')
@section('bodyclass')

    <body class="bg-userside">
    @endsection
    @section('jumbotron')
        <div class="jumbotron">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h1 class="display-4">Increase your posts visibility with Go Buzz Me!</h1>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('content')
        <div class="container pt-3 pb-5">
            <div class="row">
                <div class="col-md-12">
                    <form id="multipleCheck" action="{{ route('paypal.add.promote') }}" method="POST">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <div class="table-responsive">
                            <table class="table" style="color: var(--text-color);">
                                <thead>
                                    <tr>
                                        <th class="col">Title</th>
                                        <th class="col">Price</th>
                                        <th class="col">Audience</th>
                                        <th class="col">Duration</th>
                                        <th class="col text-center" style="width: 150px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($packages as $package)
                                        <tr>
                                            <td>
                                                {{ $package->title }}
                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal{{ $package->id }}"><i
                                                        class="icon-info-circle"></i></a>
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal{{ $package->id }}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel{{ $package->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content" style="color: #000;">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="exampleModalLabel{{ $package->id }}">Details
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                {!! $package->detail !!}
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>${{ $package->price }}</td>
                                            <td>{{ $package->audience }}</td>
                                            <td>{{ $package->duration }}</td>
                                            <td class="text-center">
                                                <input class="d-none pc" type="checkbox" value="{{ $package->id }}"
                                                    name="package_ids[]">
                                                <button type="button" data-price="{{ $package->price }}"
                                                    class="btn btn-warning add">+ Add</button>
                                                <button type="button" data-price="{{ $package->price }}"
                                                    class="btn btn-danger del" style="display: none;">- Remove</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="4">
                                            <p class="text-end">Total: <span id="total"></span></p>
                                        </td>
                                        <td>
                                            <p class="text-center">
                                                <button type="submit" class="btn btn-success">Order
                                                    Now</button>
                                            </p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection

    @push('scripts')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                var total = 0;
                $(document).on('click', '.add', function() {
                    let price = Number($(this).data('price'));
                    total += price;
                    $('#total').html('$' + total);
                    $(this).hide();
                    $(this).parent().find('.del').show();
                    $(this).parent().find('.pc').prop('checked', true);
                });

                $(document).on('click', '.del', function() {
                    let price = Number($(this).data('price'));
                    total -= price;
                    $('#total').html('$' + total);
                    $(this).hide();
                    $(this).parent().find('.add').show();
                    $(this).parent().find('.pc').prop('checked', false);
                });
            });
        </script>
    @endpush
