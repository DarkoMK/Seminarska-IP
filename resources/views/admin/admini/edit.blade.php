@extends('main')

@section('main')
    <h1 style="margin-left: 15%"><span class="icon"><i  aria-hidden="true" class="icon-podesuvanja"></i></span>Админ - {{ $admini->id }}</h1>
    <hr width="85%" class="right"><br>
    <div class="row">
        <div class="col s12">
            @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <p class="center card" style="color: #ffe0b2;">{{ $error }}</p>
                    @endforeach
            @endif
                {!! Form::model($admini, [
                    'method' => 'PATCH',
                    'url' => ['/admin/admini', $admini->id],
                    'class' => 'col s12',
                    'files' => true
                ]) !!}

                @include ('admin.admini.form', ['submitButtonText' => 'Ажурирај'])

                {!! Form::close() !!}
        </div>
    </div>
@endsection