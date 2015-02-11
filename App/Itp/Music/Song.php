<?php
    namespace Itp\Music;
    use \Itp\Base\Database;

class Song extends Database {

    private $title;
    private $artist_id;
    private $genre_id;
    private $price;
    private $song_id;

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setArtistId($id) {
        $this->artist_id = $id;
    }

    public function setGenreId($genre_id) {
        $this->genre_id = $genre_id;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function save() {
        // performs the insert
        $sql = "
			INSERT INTO songs (title, artist_id, genre_id, price)
			VALUES (:title, :artist_id, :genre_id, :price)
		";

        $statement = static::$pdo->prepare($sql);
        $statement->bindParam(":title", $this->title);
        $statement->bindParam(":artist_id", $this->artist_id);
        $statement->bindParam(":genre_id", $this->genre_id);
        $statement->bindParam(":price", $this->price);

        $statement->execute();
        $this->song_id = static::$pdo->lastInsertId();
    }

    public function getTitle() {
        return $this->title;
    }

    public function getId() {
        return $this->song_id;
    }

}