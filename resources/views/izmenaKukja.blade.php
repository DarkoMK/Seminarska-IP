@extends('main')

@section('main')
    <br>
    <h1 style="margin-left: 15%"><span class="icon"><i  aria-hidden="true" class="icon-kukjicka" title="Куќи"></i></span>Куќи</h1>
    <hr width="85%" class="right"><br>
    <h4>Измени куќа</h4>
    <hr>
    <form class="col s12 m12 l12" action="/kukji/zacuvaj" method="POST">
        <input name="_method" type="hidden" value="PATCH">
        <input name="id_kukja" type="hidden" value="{{ $kukja[0]->id }}">
        {{ csrf_field() }}
        <div class="row">
            <div class="input-field col s12">
                <input placeholder="{{ $kukja[0]->ime }}" value="{{ $kukja[0]->ime }}" id="ime" name="ime" type="text" class="validate">
                <label for="ime">Име</label>
            </div>
        </div>

        <div class="row">
            <button type="submit" class="waves-effect waves-light btn brown"><i class="material-icons right">note_add</i>Зачувај куќа</button>
            <button type="reset" class="waves-effect waves-light btn brown"><i class="material-icons right">clear_all</i>Ресетирај</button>
        </div>
    </form>
    <h4>Доделени корисници <a href="/kukji/korisnik/dodaj/{{ $kukja[0]->id }}" class="waves-effect waves-light btn brown darken-4"><i class="material-icons">add</i></a></h4>
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
        @foreach($kukja[0]->kukjakorisnik as $kukjakorisnik)
            <tr>
                <td>{{ $kukjakorisnik->korisnik->name }}</td>
                <td>{{ $kukjakorisnik->korisnik->email }}</td>
                <td>
                    <form action="/kukji/korisnik/izbrisi" method="POST">
                        <input name="_method" type="hidden" value="DELETE">
                        <input name="id_kukja" type="hidden" value="{{ $kukja[0]->id }}">
                        <input name="id_korisnik" type="hidden" value="{{ $kukjakorisnik->korisnik->id  }}">
                        {{ csrf_field() }}
                    <button type="submit" class="waves-effect waves-light btn brown darken-4"><i class="material-icons">delete</i></button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <br>
    <h4>Доделени уреди <a href="/kukji/ured/dodaj/{{ $kukja[0]->id }}" class="waves-effect waves-light btn brown darken-4"><i class="material-icons">add</i></a></h4>
    <hr>
    <table class="bordered responsive-table">
        <thead>
        <tr>
            <th data-field="ime">Име</th>
            <th data-field="vid">Вид</th>
            <th data-field="soba">Соба</th>
            <th data-field="izvod">Извод</th>
            <th data-field="sostojba">Состојба</th>
            <th data-field="akcija">Акција</th>
        </tr>
        </thead>
        <tbody>
        @foreach($kukja[0]->uredi as $ured)
            <tr>
                <td>{{ $ured->ime }}</td>
                <td>{{ $ured->kategorija->vid_na_ured }}</td>
                <td>{{ $ured->soba->ime }}</td>
                <td>{{ $ured->br_izvod }}</td>
                @if ($ured->vklucena_sostojba === 1)
                    <td>Вклучен</td>
                @else
                    <td>Исклучен</td>
                @endif
                <td>
                    <form action="/kukji/ured/izbrisi" method="POST">
                        <input name="_method" type="hidden" value="DELETE">
                        <input name="id_ured" type="hidden" value="{{ $ured->id  }}">
                        {{ csrf_field() }}
                        <button type="submit" class="waves-effect waves-light btn brown darken-4"><i class="material-icons">delete</i></button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <br>
    <hr>
@endsection