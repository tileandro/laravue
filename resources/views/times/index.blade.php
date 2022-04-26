@extends('layouts.app')

@section('content')
<div class="container">
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
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <timebackend-component v-once></timebackend-component>
        </div>
    </div>
</div>
@endsection
