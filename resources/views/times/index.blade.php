@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>{{$titulo}}</h1>
            <timebackend-component v-once></timebackend-component>
            <div class="d-flex justify-content-center mt-3 carregandoTabela">
                <div class="spinner-border" role="status">
                    <span class="sr-only"></span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
