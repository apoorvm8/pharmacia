<header class="main-header">
  <div class="primary-overlay">
    <div class="navbar-fixed">
        <nav class="transparent">
          <div class="container">
            <div class="nav-wrapper">
              <a href="#home" class="brand-logo"><span class="red-text darken-2">Phar</span><span class="black-text">macia</span></a>
              <a href="#" class="button-collapse" data-activates="mobile-nav">
                <i class="material-icons">menu</i>
              </a>
              <ul class="right hide-on-med-and-down banner-links">
                <li>
                  <a href="#home" class="black-text">Home</a>
                </li>
                <li>
                  <a href="#about" class="black-text">About</a>
                </li>
                <li>
                  <a href="#article" class="black-text">Articles</a>
                </li>
                <li>
                  <a href="#contact" class="black-text">Contact</a>
                </li>

                @guest
                  <li>
                    <a href="{{route('login')}}" class="black-text">Log In</a>
                  </li>
                @else
                <li>
                  <a class="black-text dropdown-item" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
                </li>
              @endguest
                
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </div>

    {{-- Search Bar --}}
    <div class="search container black-text">
      <div class="row">
        <div class="col s12 banner-text">
          <h4>Search Medicines</h4>
          <div class="input-field">
              <input class="white grey-text autocomplete" placeholder="Crocin, Vicks, etc..." type="text" id="autocomplete-input">
          </div>
        </div>
      </div>
    </div>
</header>

  <ul class="side-nav" id="mobile-nav">
    <li>
      <a href="#home">Home</a>
    </li>
    <li>
      <a href="#search">Search</a>
    </li>
    <li>
      <a href="#popular">About</a>
    </li>
    <li>
      <a href="#gallery">Articles</a>
    </li>
    <li>
      <a href="#contact">Contact</a>
    </li>
  </ul>