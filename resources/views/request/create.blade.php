<!doctype html>
<html lang="fr">
<head>
    <title>MusicGuessr</title>
    <meta name="description" content="Music guessing game">
    <meta name="keywords" content="music, guess, game">
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 5vh 0 0; /* Marge de 5% en haut */
            font-family: Arial, sans-serif;
        }
        .title {
            font-size: 10vw;
            margin-top: -2vh;
        }
        .subtitle {
            font-size: 1.5em;
            margin-left: auto; /* Le sous-titre est aligné à droite */
            transform: translateX(-66.67%); /* Le déplace de 2/3 vers la droite */
            margin-bottom: 5vh;
        }
        .form-container {
            width: 35%;
            text-align: center;
            /* border: 1px solid #ccc; */
            padding: 5vw;
            background-color: rgba(255, 255, 255, 0.25);
            border-radius: 2vw;
        }
        .form-container label {
            display: block;
            font-weight: bold;
            margin-bottom: 2vh;
            text-align: left; /* Alignement à gauche */
        }
        .form-container input {
            width: 100%; /* Occupera toute la largeur du conteneur */
            padding: 1vw;
            margin-bottom: 4vh;
            font-size: 1vw;
            display: inline-block; /* Met les champs sur la même ligne */
            border-radius: 2vw; /* Rend les bords oblongs */
        }
        .form-container button[type="submit"] {
            float: right;
            padding: 1vw;
            font-size: 1vw;
            border-radius: 2vw; /* Rend les bords oblongs */
            background-color: #007BFF; /* Couleur du fond du bouton */
            color: #fff; /* Couleur du texte du bouton */
            border: none; /* Supprime la bordure du bouton */
        }
    </style>
</head>
<body>
    <div class="title">MusicGuessr</div>
    <div class="subtitle">by Alessio Maëlys Simon</div>

    <div class="form-container">
        <label for="song" style="float: left;">Proposer une musique :</label>
        <form method="POST" action="/song_requests">
            @csrf
            <input type="text" name="song_name" id="song" placeholder="Titre">
            <br>
            <input type="text" name="artist_name" id="artist" placeholder="Artiste">
            <br>
            <button type="submit">Proposer</button>
        </form>
    </div>
</body>
</html>
