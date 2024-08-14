@extends('layouts.app')

@section('content')
    <div class="container">
        @if(Auth::check())
            <form>
                <div class="mb-3">
                    <label for="exampleInputAddress" class="form-label">Адрес</label>
                    <input type="text" class="form-control" id="addressInput" aria-describedby="addressHelp" required>
                    <div id="addressHelp" class="form-text">Введите адрес, по которому хотите получить информацию</div>
                </div>
                <button type="submit" class="btn btn-primary">Получить</button>
            </form>
        @else
            <h4>Чтобы получить информацию по адресу, сначала вам нужно авторизоваться</h4>
        @endif
    </div>
@endsection
