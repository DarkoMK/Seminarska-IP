@extends('main')

@section('main')
    <h1 style="margin-left: 15%"><span class="icon"><i  aria-hidden="true" class="icon-podesuvanja" title="Админи"></i></span>Админи<a href="{{ url('/admin/admini/create') }}" class="waves-effect waves-light btn brown darken-4 right"><i class="material-icons">library_add</i></a></h1>
    <hr width="85%" class="right"><br>
    <div class="row">
        <div class="col s12">
            <table class="bordered responsive-table">
                <thead>
                <tr>
                    <th>ID</th><th> Име </th><th> Е-маил </th><th>Акција</th>
                </tr>
                </thead>
                <tbody>
                @foreach($admini as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td><td>{{ $item->email }}</td>
                        <td>
                            <a href="{{ url('/admin/admini/' . $item->id . '/edit') }}" class="waves-effect waves-light btn brown darken-4" alt="Измени Admini"><i class="material-icons">mode_edit</i></a>
                            {!! Form::open([
                                'method'=>'DELETE',
                                'url' => ['/admin/admini', $item->id],
                                'style' => 'display:inline'
                            ]) !!}
                            {!! Form::button('<i class="material-icons">delete</i>', array(
                                    'type' => 'submit',
                                    'class' => 'waves-effect waves-light btn brown darken-4',
                                    'title' => 'Избриши Admini',
                                    'onclick'=>'return confirm("Потврдете го бришењето")'
                            )) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="pagination"> {!! $admini->render() !!} </div>
        </div>
    </div>
@endsection
