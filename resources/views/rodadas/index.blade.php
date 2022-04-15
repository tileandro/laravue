@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>{{$titulo}}</h1>
            <rodadabackend-component></rodadabackend-component>
        </div>
    </div>
</div>
@endsection
