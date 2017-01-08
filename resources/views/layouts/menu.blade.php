      <ul>
          @if(Auth::user()->IsAdmin())
              <li>
                  <a  href="/korisnici" title=""><span class="icon"><i aria-hidden="true" class="icon-korisnici" title="Корисници"></i></span></a>
              </li>
              <li>
                  <a href="/kukji" title=""><span class="icon"><i  aria-hidden="true" class="icon-kukjicka" title="Куќи"></i></span></a>
              </li>
              <li>
                  <a href="/podesuvanja" title=""><span class="icon"><i  aria-hidden="true" class="icon-podesuvanja" title="Помош"></i></span></a>
              </li>
          @else
              <li>
                  <a  href="/pocetna" title=""><span class="icon"><i aria-hidden="true" class="icon-kukjicka" title="Почетна"></i></span></a>
              </li>
              <li>
                  <a href="/naredbi" title=""><span class="icon"><i  aria-hidden="true" class="icon-saatce" title="Наредби"></i></span></a>
              </li>
              <li>
                  <a href="/pomos" title=""><span class="icon"><i  aria-hidden="true" class="icon-pomos" title="Помош"></i></span></a>
              </li>
          @endif
      </ul>