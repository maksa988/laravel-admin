@extends('admin::layout')

@section('content')
    <div class="container-fluid">

    @breadcrumbs()

    @if(session('message'))
        <div class="row mb-3">
            <div class="col-12">
                <div class="alert alert-info">
                    {{ session('message')  }}
                </div>
            </div>
        </div>
    @endif

    <div class="row mb-3">
        <div class="col-12">
            <a href="{{ route('admin.cache.clear') }}" class="btn btn-success">Очистить кэш сайта</a>
        </div>
    </div>

    </div>
    <!-- /.container-fluid -->
@endsection