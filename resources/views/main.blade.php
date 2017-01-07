@include('layouts.header')
<body>
@include('layouts.menumobile')
<div class="row">
@include('layouts.menudesktop')
      <div class="col s12 m11 l11">
          <div class="container right">
            <div style="margin-top: 6em;" class="hide-on-med-and-up"></div>
              <div id="grid-container" class="section scrollspy">
              <!-- Page Content goes here -->
                  @if (!Auth::guest())
                      <a href="{{ url('/logout') }}"
                         onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="waves-effect waves-light btn right  brown lighten-2">
                          <i class="material-icons left">lock_outline</i> Одјава
                      </a>

                      <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                      </form>
                  @endif
@yield('main')
              </div>
          </div>
      </div>
</div>
@include('layouts.footer')