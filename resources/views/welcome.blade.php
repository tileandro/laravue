@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <index-component v-once></index-component>
        </div>
        <div class="col-md-4">
            <rodada-component v-once></rodada-component>
        </div>
    </div>
</div>
@endsection
