console.log('aga');

document.getElementById('filters__btn').addEventListener('click', function () {
    document.getElementById('sidebar').classList.toggle('show-sidebar');
});

document.getElementById('close-sidebar').addEventListener('click', function () {
    document.getElementById('sidebar').classList.toggle('show-sidebar');
});

function ConfirmDelete() {
    return confirm('Вы уверены? Публикация будет удалена безвозвратно.');
}

document.querySelectorAll('.sort__link').forEach(function (header) {
    header.addEventListener('click', function () {
        const sortBy = header.getAttribute('data-sort-by');
        const sortOrder = header.classList.contains('sort__link--asc') ? 'desc' : 'asc';

        fetch(`{{ route('publs.filter') }}?sort_by=${sortBy}&sort_order=${sortOrder}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then(response => response.json())
            .then(data => {
                const tableBody = document.getElementById('publications-table');
                tableBody.innerHTML = '';

                data.publs.forEach(publ => {
                    const authors = publ.authors.map(author =>
                        `${author.surname} ${author.name} ${author.patronimyc}`)
                        .join('<br>');
                    const levels = publ.publLevels.map(level =>
                        `<p>${level.title};</p>`).join('');

                    const row = `
                            <tr>
                                <td class="publ__table-cell">${authors}</td>
                                <td class="publ__table-cell">${publ.imprint}</td>
                                <td class="publ__table-cell">${publ.publication_year}</td>
                                <td class="publ__table-cell">${levels}</td>
                                <td class="plan__controls publ__table-cell">
                                    <form method="GET" action="{{ route('publs.update-form', ['id' => ${publ.id}]) }}">
                                        <button type="submit">Редактировать</button>
                                    </form>
                                    /
                                    <form method="POST" action="{{ route('publs.remove', ['id' => ${publ.id}]) }}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" onclick="return ConfirmDelete()">
                                            Удалить
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        `;

                    tableBody.insertAdjacentHTML('beforeend', row);
                });

                document.querySelectorAll('.sort__link').forEach(link => link.classList.remove(
                    'sort__link--asc', 'sort__link--desc'));
                header.classList.add(`sort__link--${sortOrder}`);
            });
    });
});