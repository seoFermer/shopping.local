@extends('backend.layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">#{{ $order->id }} {{ $order->user->name }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <tbody>
                                    <tr>
                                        <td>#</td>
                                        <td>{{ $order->id }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ trans('translate.User') }}</td>
                                        <td><a href="{{ route('dashboard.user.show', $order->user->id) }}">{{ $order->user->name }}</a></td>
                                    </tr>
                                    <tr>
                                        <td>{{ trans('translate.Quantity') }}</td>
                                        <td>{{ $order->product->count() }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ trans('translate.Amount') }}</td>
                                        <td>{{ $order->product->sum('price') }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ trans('translate.Added') }}</td>
                                        <td>{{ $order->created_at->format('d.m.Y') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{ trans('translate.Title') }}</th>
                                    <th scope="col">{{ trans('translate.Price') }}</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order->product AS $product)
                                <tr>
                                    <th scope="row">{{ $product->id }}</th>
                                    <td><a href="{{ route('dashboard.product.show', $product->id) }}">{{ $product->title }}</a></td>
                                    <td>{{ $product->price }}</td>
                                    <td>
                                        <form action="{{ route('dashboard.order.product.delete',[$order->id, $product->id]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
