@extends('layout.layout')
@section('content')
<style>
    .publ__creating {
        display: flex;
        flex-direction: column;
        width: fit-content;
        margin: 0 auto;
    }

    form>input,
    select {
        width: 500px;
        height: 30px;
        margin: 10px 0;
    }

    .article_type {
        padding: 10px;
    }
</style>

<section>
    <form class="publ__creating" action="/publs/add/send" method="post">
        @if (count($errors) > 0)
        <div style="background-color:lightcoral">
            <ul>
                @foreach ($errors->all() as $error)
                <li style="color: red;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @elseif (session('success'))
        <div style="background-color: lightgreen;">
            <p style="color: green;">{{ session('success') }}</p>
        </div>
        @endif

        <label for="author">Автор</label>
        <select name="author" id="author">
            @foreach($employees as $empl)
            <option value="{{$empl->id}}">{{$empl->FIO()}}</option>
            @endforeach
        </select>
        
        <label for="title">Название публикации</label>
        <input id="title" name="title" type="text">
        <label for="DOI">DOI адрес</label>
        <input id="DOI" name="DOI" type="text">
        <label for="imprint">Выходные данные статьи</label>
        <input id="imprint" name="imprint" type="text">
        <label for="publ_level">Уровень публикации</label>
        <select name="publ_level" id="publ_level">
            @foreach($publLevels as $level)
            <option value="{{$level->id}}">{{$level->title}}</option>
            @endforeach
        </select>
        <label for="article_type">Тип публикации</label>
        <div id="article_type" class="article_type">
            <input type="radio" id="article" name="article_type" value="A" checked />
            <label for="article">Статья</label>

            <input type="radio" id="posobie" name="article_type" value="P" />
            <label for="posobie">Пособие</label>
        </div>

        <button type="submit">Добавить публикацию</button>
    </form>
</section>
@endsection
