@extends('main')

@section('main')
            <h1 style="margin-left: 15%"><span class="icon"><i  aria-hidden="true" class="icon-pomos" title="Помош"></i></span>Помош</h1>
            <hr width="85%" class="right"><br>
            @foreach($pomos as $p)
            <h1><u>{{ $p->naslov }}</u></h1>
            <p>{{ $p->objasnuvanje }}</p>
            <hr><br>
            @endforeach
@endsection