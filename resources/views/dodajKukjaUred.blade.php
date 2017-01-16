@extends('main')

@section('main')
    <br>
    <h1 style="margin-left: 15%"><span class="icon"><i  aria-hidden="true" class="icon-kukjicka" title="Куќи"></i></span>Уреди</h1>
    <hr width="85%" class="right"><br>
    <form class="col s12 m12 l12" action="/kukji/ured/dodaj" method="POST">
        <input name="id_kukja" type="hidden" value="{{ $id_kukja }}">
        <input name="_method" type="hidden" value="PUT">
        {{ csrf_field() }}
        <div class="row">
            <div class="input-field col s6">
                <input placeholder="" value="" id="ime" name="ime" type="text" class="validate">
                <label for="ime">Име</label>
            </div>
            <div class="input-field col s6">
                <input placeholder="" value="" id="izvod" name="izvod" type="number" class="validate">
                <label for="ime">Извод</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <select name="kategorija" id="kategorija">
                    @foreach($kat as $k)
                    <option value="{{ $k->id }}">{{ $k->vid_na_ured }}</option>
                    @endforeach
                </select>
                <label>Вид</label>
            </div>
            <div class="input-field col s6">
                <select name="soba" id="soba">
                    @foreach($sobi as $s)
                        <option value="{{ $s->id }}">{{ $s->ime }}</option>
                    @endforeach
                </select>
                <label>Соба</label>
            </div>
        </div>

        <div class="row">
            <button type="submit" class="waves-effect waves-light btn brown"><i class="material-icons right">note_add</i>Зачувај уред</button>
            <button type="reset" class="waves-effect waves-light btn brown"><i class="material-icons right">clear_all</i>Ресетирај</button>
        </div>
    </form>
    <br>
    <hr>
@endsection