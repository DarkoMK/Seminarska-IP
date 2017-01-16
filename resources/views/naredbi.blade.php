@extends('main')

@section('main')

    <br>
    <div id="listnaredbi">
    <h1 style="margin-left: 15%"><span class="icon"><i  aria-hidden="true" class="icon-saatce" title="Наредби"></i></span>Наредби<a class="waves-effect waves-light btn brown darken-4 right" @click.prevent="addClick()"><i class="material-icons">library_add</i></a></h1>
    <hr width="85%" class="right"><br>
        <transition name="slide-fade">
<div id="row" v-show="dodaj">
        <h4>Додај наредба</h4>
    <hr>
        <form class="col s12 m12 l12">
            <div class="row">
                <div class="col s12 m12 l12">
                    <label>Уред</label>
                    <select class="browser-default" v-model="naredba.ured_id">
                        <option v-for="ured in uredi" :value="ured.id">@{{ ured.iured }} - @{{ ured.isoba }}</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m6 l6">
                    <input placeholder="" type="date" class="datepicker" id="v_vklucuvanje" name="v_vklucuvanje">
                    <label for="v_vklucuvanje">Датум на вклучување</label>
                </div>

                <div class="input-field col m6 l6">
                    <input placeholder="" type="time" class="timepicker" id="t_vklucuvanje" name="t_vklucuvanje">
                    <label for="t_vklucuvanje">Час на вклучување</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m6 l6">
                    <input placeholder="" type="date" class="datepicker" id="v_isklucuvanje" name="v_isklucuvanje">
                    <label for="v_isklucuvanje">Датум на исклучување</label>
                </div>
                <div class="input-field col m6 l6">
                    <input placeholder="" type="time" class="timepicker" id="t_isklucuvanje" name="t_isklucuvanje">
                    <label for="t_isklucuvanje">Час на исклучување</label>
                </div>
            </div>
            <div class="row">
                <a href="#" class="waves-effect waves-light btn brown" @click.prevent="zacuvajNaredba()"><i class="material-icons right">query_builder</i>Зачувај наредба</a>
                <a href="#" class="waves-effect waves-light btn brown" @click.prevent="resetForm()"><i class="material-icons right">clear_all</i>Ресетирај</a>
            </div>
        </form>
    <p>----------------------</p>
</div>
        </transition>

<div id="row" class="col s12 m12 l12">
    <table class="bordered responsive-table">
        <thead>
        <tr>
            <th data-field="ured">Уред</th>
            <th data-field="soba">Соба</th>
            <th data-field="vkluci_vo">Вклучи на</th>
            <th data-field="iskluci_vo">Исклучи на</th>
            <th data-field="akcija">Акција</th>
        </tr>
        </thead>
        <tbody>

            <tr v-for="nar in naredbi">
                <td>@{{ nar.ured.ime }}</td>
                <td>@{{ nar.ured.soba.ime }}</td>
                <td v-if="nar.vreme_vklucuvanje">@{{ nar.vreme_vklucuvanje }}</td>
                <td v-else>Нема</td>
                <td v-if="nar.vreme_isklucuvanje">@{{ nar.vreme_isklucuvanje }}</td>
                <td v-else>Нема</td>
                <td>
                    <a class="waves-effect waves-light btn brown darken-4" @click.prevent="editNaredba(nar.id, nar.id_ured, nar.vreme_vklucuvanje, nar.vreme_isklucuvanje)"><i class="material-icons">mode_edit</i></a>
                    <a class="waves-effect waves-light btn brown darken-4" @click.prevent="izbrisiNaredba(nar.id, nar.id_ured)"><i class="material-icons">delete</i></a>
                </td>
            </tr>

        </tbody>
    </table>
</div>
    <br>
    </div>
    <br>
    <hr>
@endsection