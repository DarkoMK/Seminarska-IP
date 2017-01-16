@extends('main')

@section('main')
    <h1 style="margin-left: 15%"><span class="icon"><i  aria-hidden="true" class="icon-podesuvanja" title="Куќи"></i></span>Подесувања</h1>
    <hr width="85%" class="right"><br>
    <div id="divpodesuvanja">
    <ul class="collapsible" data-collapsible="accordion">
        <li>
            <div class="collapsible-header"><span class="badge">1</span><i class="material-icons">verified_user</i>Админи</div>
            <div class="collapsible-body">
            </div>
        </li>
        <li>
            <div class="collapsible-header"><span class="badge">1</span><i class="material-icons">view_module</i>Категории</div>
            <div class="collapsible-body"><p>Lorem ipsum dolor sit amet.</p></div>
        </li>
        <li>
            <div class="collapsible-header"><span class="badge">1</span><i class="material-icons">place</i>Соби</div>
            <div class="collapsible-body"><p>Lorem ipsum dolor sit amet.</p></div>
        </li>
        <li>
            <div class="collapsible-header"><span class="badge">1</span><i class="material-icons">live_help</i>Помош</div>
            <div class="collapsible-body"><p>Lorem ipsum dolor sit amet.</p></div>
        </li>
        <li>
            <div class="collapsible-header"><span class="badge">1</span><i class="material-icons">info</i>Активности</div>
            <div class="collapsible-body"><p>Lorem ipsum dolor sit amet.</p></div>
        </li>
    </ul>
    </div>
@endsection
