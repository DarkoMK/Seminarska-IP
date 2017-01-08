@extends('main')

@section('main')
    <br>
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
                    <div class="col l3">
                        @if($ured->vklucena_sostojba)
                            <img src="/images/p_on.png" alt="Вклучен">
                        @else
                            <img src="/images/p_off.png" alt="Исклучен">
                        @endif
                    </div>
                    <div class="col l5">
                        <div style="text-align: left">
                            <p style="font-size: 1em;">Вклучено од Дарко<br>на 08.01.2017 во 18:30</p>
                            <p style="font-size: 1em;">Ќе се исклучи на<br>08.02.2017 во 18:30, од Дарко</p>
                        </div>
                    </div>
                </div>
                @if($p) @php ($p = false)
                @else @php ($p = true)
                @endif
                @endforeach
                <hr>
@endsection
