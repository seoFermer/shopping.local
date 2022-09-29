@extends('backend.layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ trans('translate.Product') }}</h1>
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
                        <div class="card-header">
                            <a href="{{ route('dashboard.product.create') }}" class="btn btn-outline-primary">{{ trans('translate.Create') }}</a>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ trans('translate.Name') }}</th>
                                    <th>{{ trans('translate.Description') }}</th>
                                    <th>{{ trans('translate.Price') }}</th>
                                    <th>{{ trans('translate.Added') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products AS $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td><a href="{{ route('dashboard.product.show', $product->id) }}">{{ $product->title }}</a></td>
                                        <td class="text-wrap">{{ $product->description }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->created_at->format('d.m.Y') }}</td>
                                        <td class="d-flex">
                                            <a href="{{ route('dashboard.product.edit', $product->id) }}" class="btn btn-outline-primary mr-1"><i class="far fa-edit"></i></a>
                                            <form action="{{ route('dashboard.product.delete', $product->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
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
            <div class="row">
                <div class="mx-auto">
                    {{ $products->appends(request()->input())->onEachSide(1)->links() }}
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
