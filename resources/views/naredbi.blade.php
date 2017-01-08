@extends('main')

@section('main')
    <br>
    <h1 style="margin-left: 15%"><span class="icon"><i  aria-hidden="true" class="icon-saatce" title="Наредби"></i></span>Наредби</h1>
    <hr width="85%" class="right"><br>
    <div class="row">
        <form class="col s12 m12 l12">
            <div class="row">
            <div class="input-field col s12 m12 l12">
                <select multiple>
                    <option value="" disabled selected>Избери уред</option>
                    <option value="1">Уред 1 - дневна</option>
                    <option value="2">Уред 2 - спална</option>
                    <option value="3">Уред 3 - кујна</option>
                </select>
                <label>Уред</label>
            </div>
            </div>
            <div class="row">
            <div class="input-field col m6 l6">
                <input type="date" class="datepicker" id="v_vklucuvanje">
                <label for="v_vklucuvanje">Датум на вклучување</label>
            </div>

            <div class="input-field col m6 l6">
                <input type="time" class="timepicker" id="t_vklucuvanje">
                <label for="t_vklucuvanje">Час на вклучување</label>
            </div>
            </div>
            <div class="row">
            <div class="input-field col m6 l6">
                <input type="date" class="datepicker" id="v_isklucuvanje">
                <label for="v_isklucuvanje">Датум на исклучување</label>
            </div>
            <div class="input-field col m6 l6">
                <input type="time" class="timepicker" id="t_isklucuvanje">
                <label for="t_isklucuvanje">Час на исклучување</label>
            </div>
            </div>
            <div class="row">
            <a class="waves-effect waves-light btn brown"><i class="material-icons right">query_builder</i>Зачувај наредба</a>
            </div>
        </form>
    </div>
    <br>
    <hr>
@endsection