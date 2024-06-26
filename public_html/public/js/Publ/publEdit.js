var selectButton = document.getElementById('addSelectButton');
var divAuthors = document.getElementById('authors');
var authorsCount = divAuthors.querySelectorAll('div').length + 1;

selectButton.addEventListener('click', function () {
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
    deleteButton.addEventListener('click', function () {
        select.remove();
        deleteButton.remove();
    });

    var container = document.createElement('div');
    container.appendChild(select);
    container.appendChild(deleteButton);

    document.getElementById('authors').appendChild(container);
});

document.querySelectorAll('.remove__author-btn').forEach(function (button) {
    button.addEventListener('click', function () {
        var div = button.closest('.another__author');
        div.remove();
    });
});
