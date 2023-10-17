
<!doctype html>
<html lang="fr">
<head>
    <title>Song requests</title>
    <meta name="description" content="Our first page">
    <meta name="keywords" content="html tutorial template">
</head>
<body>
<form method="POST" action="/song_requests">
    @csrf
    <label for="song">Song</label>
    <input type="text" name="song_name" id="song">
    <label for="artist">Artist</label>
    <input type="text" name="artist_name" id="artist">
    <input type="submit">
</form>
</body>
</html>
