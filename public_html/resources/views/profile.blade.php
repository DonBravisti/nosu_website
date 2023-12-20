@extends('layout.layout')
@section('content')
<style>
    .actions {
        display: flex;
        justify-content: space-evenly;
        margin: 150px 0;
    }

    .action__link{
        background-color: rgba(30, 84, 193, 1);
        border-radius: 10px;
        padding: 5px;
    }

    .action__link p{
        color: white;
    }
</style>

<section class="actions">
    <a class="action__link" style="text-align: center;" href="/create-user">
        <p>Создать сотрудника</p>
    </a>
    <a class="action__link" style="text-align: center;" href="/contracts">
        <p>Трудовые договоры</p>
    </a>
    <a class="action__link" style="text-align: center;" href="/publs">
        <p>Публикации</p>
    </a>
    <a class="action__link" style="text-align: center;" href="/logout">
        <p>Выйти из аккаунта</p>
    </a>
</section>
@endsection