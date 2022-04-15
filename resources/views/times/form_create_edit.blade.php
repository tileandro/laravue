@if (isset($time->id))
<form method="post" class action="{{ route('times.update', $time['id']) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <input type="hidden" name="id" value="{{$time->id}}" />
@else
<form method="post" action="{{ route('times.store') }}" enctype="multipart/form-data">
    @csrf
@endif
    <div class="form-group mb-3">
        <input type="text" class="form-control" value="{{ $time->time ?? old('time') }}" id="time" name="time"
        placeholder="Nome do time">
    </div>
    <div class="form-group mb-3">
        <label for="escudo">Escudo do time</label>
        <input type="file" class="form-control-file" id="escudo" name="escudo">
    </div>
    <div class="form-group mt-3">
        <button type="submit" class="btn btn-primary">@if (isset($time->id)) Editar @else Cadastrar @endif time </button>
    </div>
</form>
