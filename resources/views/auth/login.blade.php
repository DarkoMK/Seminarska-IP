  <!DOCTYPE html>
  <html>
    <head>
      <title>Vkluci.MK - Најава</title>
      <link rel="icon" href="images/favicon-32x32.png" sizes="32x32">
      <!--Import Google Icon Font-->
      <link href="/css/icon.css" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="/css/app.css"  media="screen,projection"/>
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body>
      <div class="container">
        <div class="row">
          <div class="col s12 m12 l12">
            <div>
              <div id="grid-container" class="section scrollspy">
              <!-- Page Content goes here -->
                <div class="row">
                  <div class="col s12 m12 l12">
                    <div class="center">
                      <i class="large material-icons" style="color:#ffab00">power_settings_new</i>
                      <p class="promo-caption">Најави се</p>
                      <div class="divider"></div>
                        <div class="row">
                          <form class="col s12" action="{{ url('/login') }}" role="form" method="POST">
                          {{ csrf_field() }}
                            <div class="row">

                              <div class="input-field col s6">
                              <i class="large material-icons prefix">account_circle</i>
                                <input id="email" type="email" name="email" class="validate" value="{{ old('email') }}">
                                <label for="email" data-error="Погрешно" data-success="Точно">E-адреса</label>
                              </div>

                              <div class="input-field col s6">
                                <i class="material-icons prefix">vpn_key</i>
                                <input id="password" type="password" name="password" class="validate">
                                <label for="password" data-error="Погрешно" data-success="Точно">Лозинка</label>
                              </div>
                              <div class="input-field col s12">
                                    <p class="center">
                                      <input type="checkbox" id="remember" name="remember"/>
                                      <label for="remember">Задржи ме најавен</label>
                                    </p>
                              </div>
                            </div>

                            <div class="row">
                            @if (count($errors) > 0)
                              <div class="col s12">
                                @foreach($errors->all() as $error)
                                <p class="center card" style="color: #ffe0b2;">{{ $error }}</p>
                                @endforeach
                              </div>
                            @endif
                            </div>

                            <div class="row">
                              <button class="btn waves-effect waves-light" type="submit" name="action" style="background-color:#795548;">Најава
                                <i class="material-icons right">input</i>
                              </button>
                            </div>
                            <div class="row">
                              <div class="input-field col s12">
                                    <p class="center">
                                      <a href="{{ url('/password/reset') }}" style="color: #ffcc80;">Заборавена лозинка?</a>
                                    </p>
                              </div>
                            </div>
                          </form>
                        </div>
                      <p class="light">Vkluci.mk - Сите права се задржани.</p>
                      <div class="divider"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>
  </html>