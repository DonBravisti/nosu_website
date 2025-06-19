@extends('layout.layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/EduPlan/specialities.css') }}">
@endsection

@section('content')
    <section>
        <h2 class="title">Список специальностей</h2>
        <table class="specialities__table">
            <thead>
                <tr>
                    <th>Код</th>
                    <th>Название</th>
                    <th>Профиль</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($specialities as $speciality)
                    <tr>
                        <td>{{ $speciality->cod }}</td>
                        <td>{{ $speciality->title }}</td>
                        <td>{{ $speciality->profile }}</td>
                        <td>
                            <a href="{{ route('edu-plan.titles', $speciality->id) }}">Перейти к титульным листам</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
@endsection
