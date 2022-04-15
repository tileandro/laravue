@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1>{{$titulo}}</h1>
            <index-component v-once></index-component>
            <div class="d-flex justify-content-center mt-3 carregandoTabela">
                <div class="spinner-border" role="status">
                    <span class="sr-only"></span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <rodada-component v-once></rodada-component>
        </div>
    </div>
</div>
@endsection
