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
            margin-bottom: 2vh; /* Réduit l'espacement sous le titre */
            margin-top: -2vh; /* Remonte de 20% */
        }
        .subtitle {
            font-size: 1.5em;
            margin-left: auto; /* Le sous-titre est aligné à droite */
            transform: translateX(-66.67%); /* Le déplace de 2/3 vers la droite */
            margin-bottom: 5vh;
        }
        button {
            padding: 1.5em 3em; /* Ajustez les valeurs selon votre préférence */
            font-size: 1.5em; /* Ajustez la taille de la police selon votre préférence */
        }

    </style>
</head>
<body>
    <div class="title">MusicGuessr</div>
    <div class="subtitle">by Alessio Maëlys Simon</div>

    <h1>Votre proposition a été enregistrée avec succès !</h1>
    <a href="{{ route('song_requests.create') }}"><button>Super</button></a>

</body>
</html>
