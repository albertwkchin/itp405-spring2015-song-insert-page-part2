<?php
    require_once __DIR__ . '/vendor/autoload.php';
    use \Itp\Music\ArtistQuery;
    use \Itp\Music\GenreQuery;
    use \Itp\Music\Song;
    use \Symfony\Component\HttpFoundation\Session\Session;
    $session = new \Symfony\Component\HttpFoundation\Session\Session();
    $session->start();

    $artistQuery = new artistQuery();
    $artists = $artistQuery->getAll();

    $genreQuery = new genreQuery();
    $genres = $genreQuery->getAll();

if (isset($_POST['submit'])) {

    $song = new Song();
    $title = $_POST['title'];
    $artist_id = $_POST['artist'];
    $genre_id = $_POST['genre'];
    $price = $_POST['price'];

    $song->setTitle($title);
    $song->setArtistId($artist_id);
    $song->setGenreId($genre_id);
    $song->setPrice($price);
    $song->save();

    $successful_insert = "The song: ". $song->getTitle()." with an ID of ". $song->getId()." was inserted successfully!";

    $session->getFlashBag()->add('successful-insert', $successful_insert);
    header('Location: add-song.php');
    exit;
}

?>

<html>

    <head>
        <title>Song Insert Page</title>
    </head>

    <h1>
        Song Insert Page
    </h1>

    <body>
        <form action="add-song.php" method="POST">
            <input type="text" name="title" placeholder="Title">

            <select name="genre">
                <?php foreach($genres as $genre) : ?>
                    <option value="<?php echo $genre->id ?>">
                        <?php echo $genre->genre ?>
                    </option>
                <?php endforeach ?>
            </select>

            <select name="artist">
                <?php foreach($artists as $artist) : ?>
                    <option value="<?php echo $artist->id ?>">
                        <?php echo $artist->artist_name ?>
                    </option>
                <?php endforeach ?>
            </select>

            <input type="text" name="price" placeholder="Price">
            <input type="submit" name="submit" value="Add">
        </form>

        <div>
            <?php foreach($session->getFlashBag()->get('successful-insert') as $message) : ?>
                <p> <?= $message ?> </p>
            <?php endforeach ?>
        </div>

    </body>

</html>