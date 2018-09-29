<div class="navbar">
        <nav class="transparent">
            <div class="container">
                <div class="nav-wrapper">
                    <a href="/" class="brand-logo center"><span class="red-text darken-2">Phar</span><span class="black-text">macia</span></a>
                    <a href="#" class="button-collapse" data-activates="mobile-nav">
                        <i class="material-icons">menu</i>
                    </a>

                    <ul class="right">
                            @guest
                           
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

{{-- <ul class="side-nav" id="mobile-nav">
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
</ul> --}}