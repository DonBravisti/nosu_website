@extends('layout.layout')
@section('content')
    <style>
        .title {
            margin: 0 auto;
            width: fit-content;
        }
    </style>

    <section>
        <h2 class="title">Новый учебный план</h2>
        <form action="">
            <div class="blocks">
                <label for="block"></label>
                <input list="blocks" name="block" id="block">
                <datalist id="blocks">
                    @foreach ($blocks as $block)
                        <option value="{{ $block->block_title }}"></option>
                    @endforeach
                </datalist>
            </div>
        </form>
    </section>
@endsection
