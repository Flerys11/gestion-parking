@extends('base')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Parkings</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right"
                       href="{{ route('parkings.create') }}">
                        Add New
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

            @include('adminlte-templates::common.errors')

            <div class="card">

                {!! Form::open(['id' => 'parkingFilterForm', 'route' => 'test.filtre'])!!}

                <div class="card-body">

                    <div class="row">
                        @include('parkings.filtre')
                    </div>


                </div>

                {!! Form::close() !!}

        </div>
        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            @include('parkings.table')
        </div>
    </div>



@endsection
