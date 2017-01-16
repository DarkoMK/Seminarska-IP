@extends('main')

@section('main')
    <h1 style="margin-left: 15%"><span class="icon"><i  aria-hidden="true" class="icon-podesuvanja" title="Активности"></i></span>Активности</h1>
    <hr width="85%" class="right"><br>
    <table class="bordered responsive-table">
        <thead>
        <tr>
            <th data-field="id">ID</th>
            <th data-field="opis">Опис</th>
            <th data-field="vreme">Време</th>
        </tr>
        </thead>
        <tbody>
        @foreach($aktivnosti as $akt)
            <tr>
                <td>{{ $akt->id }}</td>
                <td>{{ $akt->description }}</td>
                <td>{{ $akt->vreme }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <ul class="pagination">
        {!! $aktivnosti->render() !!}
    </ul>
@endsection
