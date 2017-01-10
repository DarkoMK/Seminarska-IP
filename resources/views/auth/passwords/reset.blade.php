@extends('auth.passwords.main')
@section('content')
              <!-- Page Content goes here -->
                <div class="row">
                  <div class="col s12 m12 l12">
                    <div class="center">
                      <i class="large material-icons" style="color:#ffab00">power_settings_new</i>
                      <p class="promo-caption">Ресетирај лозинка</p>
                      <div class="divider"></div>
                        <div class="row">
                    @if (session('status'))
                        <div class="card-panel green" style="color: white;">
                            {{ session('status') }}
                        </div>
                    @endif
                          <form class="col s12" action="{{ url('/password/reset') }}" role="form" method="POST">
                          {{ csrf_field() }}
                          <input type="hidden" name="token" value="{{ $token }}">
                            <div class="row">

                              <div class="input-field col s12">
                              <i class="large material-icons prefix">account_circle</i>
                                <input id="email" type="email" name="email" class="validate" value="{{ old('email') }}">
                                <label for="email" data-error="Погрешно" data-success="Точно">E-адреса</label>
                              </div>

                              <div class="input-field col s12">
                                <i class="material-icons prefix">vpn_key</i>
                                <input id="password" type="password" name="password" class="validate">
                                <label for="password" data-error="Погрешно" data-success="Точно">Лозинка</label>
                              </div>
                            <div class="input-field col s12">
                                <i class="material-icons prefix">vpn_key</i>
                                <input id="password-confirm" type="password" name="password_confirmation" class="validate">
                                <label for="password-confirm" data-error="Погрешно" data-success="Точно">Потврди лозинка</label>
                              </div>
                            </div>

                            <div class="row">
                            @if (count($errors) > 0)
                              <div class="col s12">
                                @foreach($errors->all() as $error)
                                <p style="color: #ffe0b2" class="center card">{{ $error }}</p>
                                @endforeach
                              </div>
                            @endif
                            </div>

                            <div class="row">
                              <button class="btn waves-effect waves-light" type="submit" name="action" style="background-color:#795548">Ресетирај лозинка
                                <i class="material-icons right">input</i>
                              </button>
                            </div>
         
                          </form>
                        </div>
                      <p class="light">Vkluci.mk - Сите права се задржани.</p>
                      <div class="divider"></div>
                    </div>
                  </div>
                </div>
@endsection