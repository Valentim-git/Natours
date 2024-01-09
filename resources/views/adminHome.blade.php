@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Criar Spot</h4>
                </div>

                <div class="card-body">
                    @include('partials.upload')
                </div>

                <div class="card-body">
                    <div class="btn-group" role="group">
                        <a href="{{ url('/users') }}" class="btn btn-primary">List Users</a>
                        <a href="{{ url('/spots') }}" class="btn btn-primary">List Spots</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection