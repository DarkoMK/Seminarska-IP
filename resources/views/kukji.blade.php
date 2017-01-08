@extends('main')

@section('main')
    <br>
    <h1 style="margin-left: 15%"><span class="icon"><i  aria-hidden="true" class="icon-kukjicka" title="Куќи"></i></span>Куќи</h1>
    <hr width="85%" class="right"><br>
    <table class="bordered responsive-table">
        <thead>
        <tr>
            <th data-field="ime"><p>Име</p></th>
            <th data-field="email"><p>Бр. Уреди</p></th>
            <th data-field="akcija"><p>Акција</p></th>
        </tr>
        </thead>
        <tbody>
        @foreach($kukji as $kukja)
            <tr>
                <td>{{ $kukja->ime }}</td>
                <td>{{ $kukja->br_uredi }}</td>
                <td>
                    <a class="waves-effect waves-light btn brown darken-4"><i class="material-icons">mode_edit</i></a>
                    <a class="waves-effect waves-light btn brown darken-4"><i class="material-icons">delete</i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <br>
    <hr>
@endsection