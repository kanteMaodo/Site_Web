<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">ISI BURGER</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="">Menu</a>
                </li>
                @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('client.index') }}">Client</a>
                    <a href="{{ route('produit.index') }}" class="nav-link">Produits</a>
                </li>
                @if(auth()->user()->role == 'gestionnaire')
                <li class="nav-item">
                    <a class="nav-link" href="#">Dashboard</a>
                </li>
                @endif
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="nav-link btn btn-link">Déconnexion</button>
                    </form>
                </li>

                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Connexion</a>
                    <a class="nav-link" href=" {{route('register')}}">Inscription</a>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>