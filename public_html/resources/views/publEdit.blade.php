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
        <form class="publ__creating" action="{{ route('publs.update', ['id' => $publ->id]) }}" method="post">

            @method('PUT')
            @include('partial.errorChecking')

            <div class="authors" id="authors">
                <label for="author">Авторы</label>
                <select name="authors[]" id="author1">
                    @foreach ($employees as $empl)
                        <option @selected($publ->authors[0]->id == $empl->id) value="{{ $empl->id }}">{{ $empl->FIO() }}</option>
                    @endforeach
                </select>
                @for ($i = 1; $i < count($publ->authors); $i++)
                    <div class="another__author">
                        <select name="authors[]" id="{{ 'author' . $i + 1 }}">
                            @foreach ($employees as $empl)
                                <option @selected($publ->authors[$i]->id == $empl->id) value="{{ $empl->id }}">{{ $empl->FIO() }}
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

            <label for="publ_level">Уровень публикации</label>
            <select name="publ_level" id="publ_level">
                @foreach ($publLevels as $level)
                    <option @selected($level->id == $publ->publ_level_id) value="{{ $level->id }}">{{ $level->title }}</option>
                @endforeach
            </select>

            <label for="article_type">Тип публикации</label>
            <select name="article_type" id="article_type">
                @foreach ($publTypes as $type)
                    <option @selected($type->id == $publ->publ_type_id) value="{{ $type->id }}">{{ $type->title }}</option>
                @endforeach
            </select>

            <button type="submit">Сохранить изменения</button>
        </form>
    </section>

    <script>
        var selectButton = document.getElementById('addSelectButton');
        var divAuthors = document.getElementById('authors');
        var authorsCount = divAuthors.querySelectorAll('div').length + 1;

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

        var anotherAuthors = document.querySelectorAll('.another__author');
        var removeAuthorBtns = document.querySelectorAll('.remove__author-btn');
        for (let i = 0; i < removeAuthorBtns.length; i++) {
            console.log(removeAuthorBtns[i]);
            console.log(anotherAuthors[i]);
            // removeAuthorBtns[i].addEventListener('click', function() {
            //     anotherAuthor[i].remove();
            // });
        }
    </script>
@endsection
