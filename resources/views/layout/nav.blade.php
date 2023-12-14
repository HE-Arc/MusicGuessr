<nav class="navbar" id="sideBarNav">
    <a href="javascript:void(0)" class="closeNavBtn" onclick="closeNav()">&times;</a>
    <a href="/">Jeu</a>
    <a href="/song_requests/create">Proposer une musique</a>
    @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}">Profil</a>

                <a href="#" onclick="document.getElementById('logout-form').submit()">Déconnexion</a>

                <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                    @csrf
                </form>

            @else
                <a href="{{ route('login') }}">Connexion</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Inscription</a>
                @endif
            @endauth
        @endif
</nav>

<span onclick="openNav()" id="openNavBtn">
    <div class="icon-burger">
        <div></div>
        <div></div>
        <div></div>
    </div>
</span>

<script>
    function openNav() {
        document.getElementById("sideBarNav").style.width = "250px";
        let openNavBtn = document.getElementById("openNavBtn");
        openNavBtn.style.opacity = "0";
        openNavBtn.style.cursor = "default";
    }

    function closeNav() {
        document.getElementById("sideBarNav").style.width = "0";
        let openNavBtn = document.getElementById("openNavBtn");
        openNavBtn.style.opacity = "1";
        openNavBtn.style.cursor = "pointer";
    }
</script>
