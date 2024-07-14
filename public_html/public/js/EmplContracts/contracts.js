document.getElementById('filters__btn').addEventListener('click', function () {
    document.getElementById('sidebar').classList.toggle('show-sidebar');
});

document.getElementById('close-sidebar').addEventListener('click', function () {
    document.getElementById('sidebar').classList.toggle('show-sidebar');
});

function ConfirmDelete() {
    return confirm('Вы уверены? Договор будет удалён безвозвратно.');
}
