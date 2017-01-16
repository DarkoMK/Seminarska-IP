@extends('main')

@section('main')
    <br>
    <div id="listdev">
                <h1 style="margin-left: 15%"><span class="icon"><i  aria-hidden="true" class="icon-sijalica" title="Моите уреди"></i></span>Моите уреди</h1>

                @php ($p = false)
                @foreach($uredi as $ured)
                    @if($p)
                        <hr>
                        <div class="row">
                    @else
                        <hr width="85%" class="right"><br>
                        <div class="row" style="margin-left: 15%;">
                    @endif

                    <div class="col l4">
                        <div style="text-align: right" class="left">
                        <h4>{{ $ured->vid_na_ured }}</h4>
                            <p style="font-size: 1em;">{{ $ured->ime }}</p>
                            <p style="font-size: 1em;">{{ $ured->mokjnost_vati }}W<br>Извод: {{ $ured->br_izvod }}</p>
                        </div>
                    </div>
                            <infoblock :devid="{{ $ured->id }}"></infoblock>
                </div>
                @if($p) @php ($p = false)
                @else @php ($p = true)
                @endif
                @endforeach
                <hr>
    </div>
                                <template id="devinfoblock-template">
                                    <div>
                                        <div class="col l3">
                                            <a v-if="u_status" href="#" @click.prevent="changeStatus()"><img src="/images/p_on.png" alt="Вклучен"></a>
                                            <a v-if="!u_status" href="#" @click.prevent="changeStatus()"><img src="/images/p_off.png" alt="Исклучен"></a>
                                        </div>
                                        <div class="col l5">
                                            <div style="text-align: left">
                                                <p v-if="u_status && v_vreme_vklucuvanje" style="font-size: 1em;">Вклучено од @{{ v_ime }} <br>на @{{ v_vreme_vklucuvanje }}</p>
                                                <p v-if="!u_status && i_vreme_isklucuvanje" style="font-size: 1em;">Исклучено од @{{ i_ime }} <br>на @{{ i_vreme_isklucuvanje }}</p>
                                                <p v-if="!u_status && v_idno" style="font-size: 1em;">Ќе се вклучи на<br> @{{ v_vreme_vklucuvanje }}, од @{{ v_ime }}</p>
                                                <p v-if="u_status && i_idno" style="font-size: 1em;">Ќе се исклучи на<br> @{{ i_vreme_isklucuvanje }}, од @{{ i_ime }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </template>
@endsection
