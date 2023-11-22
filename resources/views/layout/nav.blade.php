<nav class="navbar" id="sideBarNav">
    <a href="javascript:void(0)" class="closeNavBtn" onclick="closeNav()">&times;</a>
    <a href="/">Jeu</a>
    <a href="/song_requests/create">Proposer une musique</a>
    <a href="/">Connexion</a>
    <a href="/">Inscription</a>
</nav>

<span onclick="openNav()" class="openNavBtn">
    <div class="icon-burger">
        <div></div>
        <div></div>
        <div></div>
    </div>
</span>

<script>
    function openNav() {
        document.getElementById("sideBarNav").style.width = "250px";
        document.getElementById("body").style.marginRight = "250px";
    }

    function closeNav() {
        document.getElementById("sideBarNav").style.width = "0";
        document.getElementById("body").style.marginRight = "0";
    }
</script>
