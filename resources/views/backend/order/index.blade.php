@extends('backend.layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ trans('translate.Order') }}</h1>
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
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ trans('translate.User') }}</th>
                                    <th>{{ trans('translate.Quantity') }}</th>
                                    <th>{{ trans('translate.Price') }}</th>
                                    <th>{{ trans('translate.Added') }}</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders AS $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td><a href="{{ route('dashboard.user.show', $order->user->id) }}">{{ $order->user->name }}</a></td>
                                        <td>{{ $order->product->count() }}</td>
                                        <td>{{ $order->product->sum('price') }}</td>
                                        <td>{{ $order->created_at->format('d.m.Y') }}</td>
                                        <th><a class="btn btn-outline-success" href="{{ route('dashboard.order.show', $order->id) }}"><i class="fas fa-shopping-basket"></i></a></th>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
            <div class="row">
                <div class="mx-auto">
                    {{ $orders->appends(request()->input())->onEachSide(1)->links() }}
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
