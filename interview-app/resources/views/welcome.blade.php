@extends('layouts.app')

@section('content')
    <div class="container">
        @if(Auth::check())
            <form method="post" action="{{route('info')}}">
                @csrf <!-- {{ csrf_field() }} -->
                <div class="mb-3">
                    <label for="exampleInputAddress" class="form-label">Адрес</label>
                    <input type="text" class="form-control" id="addressId" name="addressName" aria-describedby="addressHelp" required>
                    <div id="addressHelp" class="form-text">Введите адрес, по которому хотите получить информацию</div>
                </div>
                <button type="submit" class="btn btn-primary">Получить</button>
            </form>
        @else
            <h4>Чтобы получить информацию по адресу, сначала вам нужно авторизоваться</h4>
        @endif
        @if (isset($result) && is_array($result['items']))
            <div>
            <h4 class="my-4">По вашему запросу: {{$result['query']}} найдены следующие места:</h4>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">№</th>
                        <th scope="col">Район города</th>
                        <th scope="col">Улица и дом</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($result['items'] as $key => $item)
                        <tr>
                            <th scope="row">{{$key}}</th>
                            <th>{{$item['district']}}</th>
                            <th>{{$item['name']}}</th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @elseif(isset($result))
            <h4 class="my-4">По вашему запросу {{$result['query']}} ничего не найдено</h4>
        @endif
    </div>
@endsection
