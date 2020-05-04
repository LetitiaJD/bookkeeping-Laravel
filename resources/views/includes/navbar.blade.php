<!-- Navigation -->
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container">
        <!-- Brand -->
        <a class="navbar-brand" href="#">Haushaltsbuch</a>

        <!-- Links -->
        <ul class="navbar-nav">

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Transaktionen
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('entry.create') }}">Transaktion hinzufügen</a>
                    <a class="dropdown-item" href="{{ route('entry.index') }}">Transaktionsübersicht</a>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Kategorienverwaltung
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('category.create') }}">Kategorie hinzufügen</a>
                    <a class="dropdown-item" href="{{ route('category.index') }}">Kategorienübersicht</a>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Kontenverwaltung
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('account.create') }}">Konto hinzufügen</a>
                    <a class="dropdown-item" href="{{ route('account.index') }}">Kontenübersicht</a>
                </div>
            </li>
        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </div>
</nav>
