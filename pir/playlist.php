<?php

class PlaylistGenerator {

    private $intended_artist;           // Mainstream artist from which to create a playlist
    private $generated_playlist;        // Array of tracks to be played
    private $yql_base_url;
    private $yql_api_key;
    private $yql_artist_id;
    private $yql_similar_artists;

    public function __construct($artist) {
        $this->db = new Database();
        $this->intended_artist = $artist;
        $this->generated_playlist = array();
        $this->yql_similar_artists = array();
        $this->yql_base_url = "http://query.yahooapis.com/v1/public/yql";   
        $this->get_yql_artist_id();
        $this->get_yql_similar_artists();
    }

    private function yql_query($q) {
        $yql_query_url = $this->yql_base_url . "?q=" . urlencode($q);  
        $yql_query_url .= "&format=json";  
        $session = curl_init($yql_query_url);  
        curl_setopt($session, CURLOPT_RETURNTRANSFER, true);      
        $json = curl_exec($session);    
        $phpObj = json_decode($json);  
        if (!is_null($phpObj->query->results)) {  
            return $phpObj;
        }
        return false;
    }

    private function get_yql_artist_id() {
        $q = $this->yql_query('select * from music.artist.search where keyword="'.$this->intended_artist.'"');
        $this->yql_artist_id =  $q->query->results->Artist[0]->id;
    }

    private function get_yql_similar_artists($levels=1) {
        $q = $this->yql_query('select * from music.artist.similar where id="'.$this->yql_artist_id.'"');
        foreach ($q->query->results->Artist as $artist) {
            array_push($this->yql_similar_artists, $artist->name);
       }
    }

    public function create_playlist() {
        $this->get_yql_similar_artists();

        $direct = array();
        $indirect = array();
        $songs = array();

        $direct =  $this->db->get_column('sounds_like', 'artist_id', 'mainstream_artist', $this->intended_artist);

        foreach ($this->yql_similar_artists as $artist) {
            $q = $this->db->get_column('sounds_like', 'artist_id', 'mainstream_artist', $artist);
            if (is_array($q)) {
                $indirect = array_merge($indirect, $q);
            }
        }

        $artists = array_unique(array_merge($direct, $indirect));
        foreach ($artists as $a) {
            $r = $this->db->get('track', "artist_id = '$a'");
            $songs = array_merge($songs, $r);
        }

        return $songs;

    }

}
