@extends('backend.layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ trans('translate.User') }}</h1>
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
                            <a href="{{ route('dashboard.user.create') }}" class="btn btn-outline-primary">{{ trans('translate.Create') }}</a>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ trans('translate.Name') }}</th>
                                    <th>{{ trans('translate.Mail') }}</th>
                                    <th>{{ trans('translate.Added') }}</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users AS $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>
                                            <a href="{{ route('dashboard.user.show', $user->id) }}">{{ $user->name }}</a>
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->created_at->format('d.m.Y') }}</td>
                                        <td class="d-flex">
                                            <a href="{{ route('dashboard.user.edit', $user->id) }}" class="btn btn-outline-primary mr-1"><i class="far fa-edit"></i></a>
                                            <form action="{{ route('dashboard.user.delete', $user->id) }}" method="POST">
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
                    {{ $users->appends(request()->input())->onEachSide(1)->links() }}
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
