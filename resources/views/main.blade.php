@include('layouts.header')
<body>
@include('layouts.menumobile')
<div class="row">
@include('layouts.menudesktop')
      <div class="col s12 m11 l11">
          <div class="container right">
            <div style="margin-top: 6em;" class="hide-on-med-and-up"></div>
              <div id="responsive" class="section scrollspy">
              <!-- Page Content goes here -->
                  <div id="headerdiv">
                  <div class="row">
                  @if (!Auth::guest())
                      <a href="{{ url('/logout') }}"
                         onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="waves-effect waves-light btn right brown lighten-2">
                          <i class="material-icons left">lock_outline</i> Одјава
                      </a>
                      <a v-if="!showPwForm" class="waves-effect waves-light btn right brown lighten-2" @click.prevent="showPwForm = true">
                          <i class="material-icons left">credit_card</i>Промени лозинка
                      </a>
                          <a v-if="showPwForm" class="waves-effect waves-light btn right brown lighten-2" @click.prevent="zacuvajLozinka()">
                              <i class="material-icons left">done</i>Зачувај нова лозинка
                          </a>
                      <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                      </form>
                  @endif
                  </div>
                  <div class="row" v-if="showPwForm">
                      <div class="input-field col s6">
                          <input id="nova_lozinka" type="password" class="validate" v-model="l1">
                          <label for="nova_lozinka">Нова лозинка</label>
                      </div>
                      <div class="input-field col s6">
                          <input id="nova_lozinka_p" type="password" class="validate" v-model="l2">
                          <label for="nova_lozinka_p">Повтори</label>
                      </div>
                  </div>
                  </div>
@yield('main')
              </div>
          </div>
      </div>
</div>
@include('layouts.footer')