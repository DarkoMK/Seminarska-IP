@extends('main')

@section('main')
    <h1 style="margin-left: 15%"><span class="icon"><i  aria-hidden="true" class="icon-podesuvanja" title="Помош"></i></span>Помош<a href="{{ url('/admin/pomos/create') }}" class="waves-effect waves-light btn brown darken-4 right"><i class="material-icons">library_add</i></a></h1>
    <hr width="85%" class="right"><br>
    <div class="row">
        <div class="col s12">
            <table class="bordered responsive-table">
                <thead>
                <tr>
                    <th data-field="id">ID</th>
                    <th data-field="naslov">Наслов</th>
                    <th data-field="objasnuvanje">Објаснување</th>
                    <th data-field="akcija">Акција</th>
                </tr>
                </thead>
                <tbody>
                @foreach($pomos as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->naslov }}</td><td>{{ $item->objasnuvanje }}</td>
                        <td>
                            <a href="{{ url('/admin/pomos/' . $item->id . '/edit') }}" class="waves-effect waves-light btn brown darken-4"><i class="material-icons">mode_edit</i></a>
                            {!! Form::open([
                                'method'=>'DELETE',
                                'url' => ['/admin/pomos', $item->id],
                                'style' => 'display:inline'
                            ]) !!}
                            {!! Form::button('<i class="material-icons">delete</i>', array(
                                    'type' => 'submit',
                                    'class' => 'waves-effect waves-light btn brown darken-4',
                                    'title' => 'Избриши помош',
                                    'onclick'=>'return confirm("Потврдете го бришењето")'
                            )) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="pagination"> {!! $pomos->render() !!} </div>
        </div>
    </div>
@endsection