@extends('layout.layout')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/Publs/publEdit.css') }}">
@endsection
@section('content')
    <section>
        <form class="publ__creating" action="{{ route('publs.update', ['id' => $publ->id]) }}" method="post">

            @method('PUT')
            @include('partial.errorChecking')

            <div class="authors" id="authors">
                <label for="author">Авторы</label>
                <select name="authors[]" id="author1">
                    @foreach ($employees as $empl)
                        <option @selected($authors[0]->id == $empl->id) value="{{ $empl->id }}">{{ $empl->FIO() }}</option>
                    @endforeach
                </select>
                @for ($i = 1; $i < count($authors); $i++)
                    <div class="another__author">
                        <select name="authors[]" id="{{ 'author' . $i + 1 }}">
                            @foreach ($employees as $empl)
                                <option @selected($authors[$i]->id == $empl->id) value="{{ $empl->id }}">{{ $empl->FIO() }}
                                </option>
                            @endforeach
                        </select>
                        <button class="remove__author-btn">Удалить</button>
                    </div>
                @endfor
            </div>
            <button type="button" id="addSelectButton">Добавить автора</button>

            <label for="imprint">Выходные данные статьи</label>
            <textarea id="imprint" name="imprint" cols="30" rows="10">{{ $publ->imprint }}</textarea>

            <label for="publication_year">Год издания</label>
            <input id="publication_year" type="number" name="publication_year" min="1900" max="2999"
                value="{{ $publ->publication_year }}">

            <label for="publLevels">Уровни публикации</label>
            <div class="publLevels" id="publLevels">
                @foreach ($publLevels as $level)
                    <div class="publLevel" id="publLevel">
                        <input type="checkbox" id="publ_level{{ $level->id }}" name="publ_levels[]"
                            value="{{ $level->id }}" @checked($publ->publLevels->contains($level))>
                        <label for="publ_level{{ $level->id }}">{{ $level->title }}</label>
                    </div>
                @endforeach
            </div>
            {{-- <label for="publ_level">Уровень публикации</label>
            <select name="publ_level" id="publ_level">
                @foreach ($publLevels as $level)
                    <option @selected($level->id == $publ->publ_level_id) value="{{ $level->id }}">{{ $level->title }}</option>
                @endforeach
            </select> --}}

            <label for="article_type">Тип публикации</label>
            <select name="article_type" id="article_type">
                @foreach ($publTypes as $type)
                    <option @selected($type->id == $publ->publ_type_id) value="{{ $type->id }}">{{ $type->title }}</option>
                @endforeach
            </select>

            <button type="submit">Сохранить изменения</button>
        </form>
    </section>
@section('scripts')
    <script src="{{ asset('js/Publs/publEdit.js') }}"></script>
@endsection
@endsection
