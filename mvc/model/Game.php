<?php
/**
 * Created by PhpStorm.
 * User: CEH4TOP
 * Date: 16.02.2018
 * Time: 20:19
 */

class GameModel extends Model
{

    protected function getQuery()
    {
        return "";
    }

    public function getItems() {
        $id = $_GET["id"];
        $login = $_COOKIE["user"];

        $data = (object) array();
        $this->DB->from("games")->select("*")->where("id = $id");
        $data->game = $this->DB->getObject();

        if (empty($data->game)) {
            $this->DB->insert("games")
                ->columns("id")->values("'$id'");
            $this->DB->execute();

            $this->DB->from("game")->select("*")->where("id = $id");
            $data->game = $this->DB->getObject();
        }

        $this->DB
            ->from("user_game_map as m")
            ->join("LEFT", "user as u ON u.id = m.user_id")
            ->select("u.*")
            ->where("m.game_id = $id");

        $data->users = $this->DB->getObjectList();
        $this->DB
            ->from("game_movie_map as m")
            ->join("LEFT", "movies as v ON m.movie_id = v.id")
            ->select("v.*")
            ->where("m.game_id = $id");
        $data->movies = $this->DB->getObjectList();
        $this->DB->from("movies")->select("*");
        $data->allMovies = $this->DB->getObjectList();
        return $data;
    }
}