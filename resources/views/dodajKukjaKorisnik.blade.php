@extends('main')

@section('main')
    <br>
    <h1 style="margin-left: 15%"><span class="icon"><i  aria-hidden="true" class="icon-kukjicka" title="Куќи"></i></span>Куќи</h1>
    <hr width="85%" class="right"><br>
    <h4>Додај корисник на куќа</h4>
    <hr>
    <table class="bordered responsive-table">
        <thead>
        <tr>
            <th data-field="ime">Име</th>
            <th data-field="email">Е-маил</th>
            <th data-field="akcija">Акција</th>
        </tr>
        </thead>
        <tbody>
        @foreach($korisnici as $k)
            <tr>
                <td>{{ $k->name }}</td>
                <td>{{ $k->email }}</td>
                <td>
                    <form action="/kukji/korisnik/dodaj" method="POST">
                        <input name="_method" type="hidden" value="PUT">
                        <input name="id_kukja" type="hidden" value="{{ $id_kukja }}">
                        <input name="id_korisnik" type="hidden" value="{{ $k->id  }}">
                        {{ csrf_field() }}
                    <button type="submit" class="waves-effect waves-light btn brown darken-4"><i class="material-icons">add</i></button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <br>
    <ul class="pagination">
    {{$korisnici->links()}}
    </ul>
    <hr>
@endsection