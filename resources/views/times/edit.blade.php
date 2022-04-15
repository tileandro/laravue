@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{$titulo}}</h1>
    <div class="row justify-content-center">
        <div class="col-6" style="margin:auto;">
            @if ($errors->any())
              <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                @foreach ($errors->all() as $erro)
                  <p>{{ $erro }}</p>
                @endforeach
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
            @if (session()->has('success'))
              <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
            @component('time.form_create_edit', ['time' => $time])
            @endcomponent
        </div>
    </div>
</div>
@endsection
