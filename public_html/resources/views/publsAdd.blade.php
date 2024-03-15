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

            <label for="title">Название публикации</label>
            <input id="title" name="title" type="text">
            <label for="DOI">DOI адрес</label>
            <input id="DOI" name="DOI" type="text">
            <label for="imprint">Выходные данные статьи</label>
            <textarea id="imprint" name="imprint" cols="30" rows="10"></textarea>
            <label for="publ_level">Уровень публикации</label>
            <select name="publ_level" id="publ_level">
                @foreach ($publLevels as $level)
                    <option value="{{ $level->id }}">{{ $level->title }}</option>
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
