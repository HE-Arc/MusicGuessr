<!doctype html>
<html lang="fr">

<head>
    <title>Song requests</title>
    <meta name="description" content="Our first page">
    <meta name="keywords" content="html tutorial template">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <p>click the button to get comparison between song whose id is given </p>
    <input type="number" id="song_id_input" />
    <button id="search_button" onclick="getComparisonWithAnswerSong()">Search</button>
    <div id="comparison_list"></div>
    <p>click the button tu use ajax to display all song beginning with the text entered in the text input</p>
    <input type="text" id="search_string_input" />
    <button id="search_button" onclick="displaySongsBeginningWith()">Search</button>
    <div id="songs_list"></div>
</body>

</html>
<script type="text/javascript" src="{{ URL::asset('js/ajax_function.js') }}"></script>
