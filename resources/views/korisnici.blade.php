@extends('main')

@section('main')
    <br>
    <h1 style="margin-left: 15%"><span class="icon"><i  aria-hidden="true" class="icon-korisnici" title="Корисници"></i></span>Корисници</h1>
    <hr width="85%" class="right"><br>
    <div class="row">
        <div class="col s12">
            <table class="bordered responsive-table">
                <thead>
                <tr>
                    <th data-field="ime">Име</th>
                    <th data-field="email">E-mail</th>
                    <th data-field="akcija">Акција</th>
                </tr>
                </thead>
                <tbody>
                @foreach($korisnici as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a class="waves-effect waves-light btn brown darken-4"><i class="material-icons">mode_edit</i></a>
                            <a class="waves-effect waves-light btn brown darken-4"><i class="material-icons">delete</i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <br>
    <hr>
@endsection
