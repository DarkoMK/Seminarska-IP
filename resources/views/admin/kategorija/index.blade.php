@extends('main')

@section('main')
    <h1 style="margin-left: 15%"><span class="icon"><i  aria-hidden="true" class="icon-podesuvanja" title="Категорија"></i></span>Видови на уреди<a href="{{ url('/admin/kategorija/create') }}" class="waves-effect waves-light btn brown darken-4 right"><i class="material-icons">library_add</i></a></h1>
    <hr width="85%" class="right"><br>
    <div class="row">
        <div class="col s12">
            <table class="bordered responsive-table">
                <thead>
                <tr>
                    <th>ID</th><th> Вид</th><th> Моќност </th><th>Акција</th>
                </tr>
                </thead>
                <tbody>
                @foreach($kategorija as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->vid_na_ured }}</td><td>{{ $item->mokjnost_vati }}</td>
                        <td>
                            <a href="{{ url('/admin/kategorija/' . $item->id . '/edit') }}" class="waves-effect waves-light btn brown darken-4" alt="Измени Kategorija"><i class="material-icons">mode_edit</i></a>
                            {!! Form::open([
                                'method'=>'DELETE',
                                'url' => ['/admin/kategorija', $item->id],
                                'style' => 'display:inline'
                            ]) !!}
                            {!! Form::button('<i class="material-icons">delete</i>', array(
                                    'type' => 'submit',
                                    'class' => 'waves-effect waves-light btn brown darken-4',
                                    'title' => 'Избриши Категорија',
                                    'onclick'=>'return confirm("Потврдете го бришењето")'
                            )) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="pagination"> {!! $kategorija->render() !!} </div>
        </div>
    </div>
@endsection
