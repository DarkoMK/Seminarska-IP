@extends('main')

@section('main')
    <h1 style="margin-left: 15%"><span class="icon"><i  aria-hidden="true" class="icon-podesuvanja" title="Соби"></i></span>Соби - Додај</h1>
    <hr width="85%" class="right"><br>
    <div class="row">
        <div class="col s12">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <p class="center card" style="color: #ffe0b2;">{{ $error }}</p>
                @endforeach
            @endif
                {!! Form::open(['url' => '/admin/soba', 'class' => 'col s12', 'files' => true]) !!}

                @include ('admin.soba.form')

                {!! Form::close() !!}
        </div>
    </div>
@endsection