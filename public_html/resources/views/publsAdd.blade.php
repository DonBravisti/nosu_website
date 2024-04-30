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

        .authors {
            display: flex;
            flex-direction: column;
        }

        textarea {
            resize: vertical;
        }
    </style>

    <section>
        <form class="publ__creating" action="{{ route('publs.add.send') }}" method="post">

            @include('partial.errorChecking')

            <div class="authors" id="authors">
                <label for="author">Авторы</label>
                <select name="authors[]" id="author1">
                    @foreach ($employees as $empl)
                        <option value="{{ $empl->id }}">{{ $empl->FIO() }}</option>
                    @endforeach
                </select>
            </div>
            <button type="button" id="addSelectButton">Добавить автора</button>

            <label for="imprint">Выходные данные статьи</label>
            <textarea id="imprint" name="imprint" cols="30" rows="10"></textarea>

            <label for="publication_year">Год издания</label>
            <input id="publication_year" type="number" name="publication_year" min="1900" max="2999">

            <label for="publLevels">Уровни публикации</label>
            <div class="publLevels" id="publLevels">
                @foreach ($publLevels as $level)
                    <div class="publLevel" id="publLevel">
                        <input type="checkbox" id="publ_level{{ $level->id }}" name="publ_levels[]"
                            value="{{ $level->id }}">
                        <label for="publ_level{{ $level->id }}">{{ $level->title }}</label>
                    </div>
                @endforeach
            </div>

            <label for="article_type">Тип публикации</label>
            <select name="article_type" id="article_type">
                @foreach ($publTypes as $type)
                    <option value="{{ $type->id }}">{{ $type->title }}</option>
                @endforeach
            </select>

            <button type="submit">Добавить публикацию</button>
        </form>
    </section>

    <script>
        var selectButton = document.getElementById('addSelectButton');
        var authorsCount = 1;

        selectButton.addEventListener('click', function() {
            authorsCount++;
            var select = document.createElement('select');
            select.name = 'authors[]';
            select.id = 'author' + authorsCount;
            select.innerHTML = `
                @foreach ($employees as $empl)
                    <option value="{{ $empl->id }}">{{ $empl->FIO() }}</option>
                @endforeach
            `;

            var deleteButton = document.createElement('button');
            deleteButton.textContent = 'Удалить';
            deleteButton.addEventListener('click', function() {
                select.remove();
                deleteButton.remove();
            });

            var container = document.createElement('div');
            container.appendChild(select);
            container.appendChild(deleteButton);

            document.getElementById('authors').appendChild(container);
        });
    </script>
@endsection
