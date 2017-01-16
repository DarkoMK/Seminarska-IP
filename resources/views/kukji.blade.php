@extends('main')

@section('main')
    <br>
    <div id="kukjadodaj">
    <h1 style="margin-left: 15%"><span class="icon"><i  aria-hidden="true" class="icon-kukjicka" title="Куќи"></i></span>Куќи<a @click.prevent="dodaj ? dodaj=false:dodaj=true" class="right waves-effect waves-light btn brown darken-4"><i class="material-icons">add</i></a></h1>
    <hr width="85%" class="right"><br>
    <transition name="slide-fade">
        <div id="row" v-show="dodaj">
            <h4>Додај куќа</h4>
            <hr>
            <form class="col s12 m12 l12">
                <div class="row">
                    <div class="input-field col s12">
                        <input placeholder="" id="ime" name="ime" type="text" class="validate" v-model="kime">
                        <label for="ime">Име</label>
                    </div>
                </div>

                <div class="row">
                    <a href="#" class="waves-effect waves-light btn brown" @click.prevent="zacuvajKukja()"><i class="material-icons right">note_add</i>Додај</a>
                    <button type="reset" class="waves-effect waves-light btn brown"><i class="material-icons right">clear_all</i>Ресетирај</button>
                </div>
            </form>
            <p>----------------------</p>
        </div>
    </transition>
    </div>
    <table class="bordered responsive-table">
        <thead>
        <tr>
            <th data-field="ime">Име</th>
            <th data-field="br_uredi">Бр. Уреди</th>
            <th data-field="akcija">Акција</th>
        </tr>
        </thead>
        <tbody>
        @foreach($kukji as $kukja)
            <tr>
                <td>{{ $kukja->ime }}</td>
                <td>{{ $kukja->br_uredi }}</td>
                <td>
                    <a href="/kukji/izmeni/{{ $kukja->id }}" class="waves-effect waves-light btn brown darken-4"><i class="material-icons">mode_edit</i></a>
                    <a href="/kukji/izbrisi/{{ $kukja->id }}" class="waves-effect waves-light btn brown darken-4"><i class="material-icons">delete</i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <ul class="pagination">
        {{$kukji->links()}}
    </ul>
    <br>
    <hr>
@endsection