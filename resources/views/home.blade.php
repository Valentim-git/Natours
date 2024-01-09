@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mb-10">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>

                <div>
                    <form action="{{ route('spot.search') }}" method="GET">
                        <label for="city">Pesquisar por cidade:</label>
                        <input type="text" name="city" id="city" required>
                        <button type="submit" class="btn btn-primary">Pesquisar</button>
                    </form>
                </div>

                <div class="card-body">
                    @include('partials.upload')
                </div>

                <div class="card-body">
                    @include('partials.list')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection