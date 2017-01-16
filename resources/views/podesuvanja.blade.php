@extends('main')

@section('main')
    <h1 style="margin-left: 15%"><span class="icon"><i  aria-hidden="true" class="icon-podesuvanja" title="Активности"></i></span>Подесувања</h1>
    <hr width="85%" class="right"><br>
        <ul class="collection">
            <a href="/admin/admini" class="collection-item">
                <span class="badge">{{ $br_adm }}</span><i class="material-icons">verified_user</i> Админи
            </a>
            <a href="/admin/kategorija" class="collection-item">
                <span class="badge">{{ $br_kat }}</span><i class="material-icons">view_module</i> Видови уреди
            </a>
            <a href="/admin/soba" class="collection-item">
                <span class="badge">{{ $br_sobi }}</span><i class="material-icons">place</i> Соби
            </a>
            <a href="/admin/pomos" class="collection-item">
                <span class="badge">{{ $br_pomos }}</span><i class="material-icons">live_help</i> Помош
            </a>
            <a href="/aktivnosti" class="collection-item">
                <span class="badge">{{ $br_akt }}</span><i class="material-icons">info</i> Активности
            </a>
        </ul>
@endsection
