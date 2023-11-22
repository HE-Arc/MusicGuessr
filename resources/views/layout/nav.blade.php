<nav class="navbar" id="sideBarNav">
    <a href="javascript:void(0)" class="closeNavBtn" onclick="closeNav()">&times;</a>
    <a href="/">Jeu</a>
    <a href="/song_requests/create">Proposer une musique</a>
    <a href="/">Connexion</a>
    <a href="/">Inscription</a>
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
        document.getElementById("bg-bricks").style.right = "250px";
        let openNavBtn = document.getElementById("openNavBtn");
        openNavBtn.style.opacity = "0";
        openNavBtn.style.cursor = "default";
    }

    function closeNav() {
        document.getElementById("sideBarNav").style.width = "0";
        document.getElementById("bg-bricks").style.right = "0";
        let openNavBtn = document.getElementById("openNavBtn");
        openNavBtn.style.opacity = "1";
        openNavBtn.style.cursor = "pointer";
    }
</script>
