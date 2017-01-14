@extends('main')

@section('main')
    <br>
    <div id="listkorisnici">
    <h1 style="margin-left: 15%"><span class="icon"><i  aria-hidden="true" class="icon-korisnici" title="Корисници"></i></span>Корисници<a class="waves-effect waves-light btn brown darken-4 right" @click.prevent="dodaj ? dodaj=false:dodaj=true"><i class="material-icons">library_add</i></a></h1>
    <hr width="85%" class="right"><br>
    <transition name="slide-fade">
        <div id="row" v-show="dodaj">
            <h4>Додај Корисник</h4>
            <hr>
            <form class="col s12 m12 l12">
                <div class="row">
                    <div class="input-field col s4">
                        <input placeholder="" id="ime" name="ime" type="text" class="validate" v-model="kime">
                        <label for="ime">Име</label>
                    </div>
                    <div class="input-field col s4">
                        <input placeholder="" id="email" name="email" type="email" class="validate" v-model="kemail">
                        <label for="email">Е-маил</label>
                    </div>
                    <div class="input-field col s4">
                        <input placeholder="" id="password" name="password" type="password" class="validate" v-model="kpw">
                        <label for="password">Лозинка</label>
                    </div>
                </div>

                <div class="row">
                    <a href="#" class="waves-effect waves-light btn brown" @click.prevent="zacuvajKorisnik()"><i class="material-icons right">note_add</i>Зачувај корисник</a>
                    <a href="#" class="waves-effect waves-light btn brown" @click.prevent="resetForm()"><i class="material-icons right">clear_all</i>Ресетирај</a>
                </div>
            </form>
            <p>----------------------</p>
        </div>
    </transition>
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
                    <tr v-for="k in korisnici">
                        <td>@{{ k.name }}</td>
                        <td>@{{ k.email }}</td>
                        <td>
                            <a class="waves-effect waves-light btn brown darken-4" @click.prevent="editUser(k.id)"><i class="material-icons">mode_edit</i></a>
                            <a class="waves-effect waves-light btn brown darken-4" @click.prevent="izbrisiUser(k.id)"><i class="material-icons">delete</i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    </div>
    <br>
    <hr>
@endsection
