<?php

class Player_Model extends Model {

    public function get_songs($artist)
    {
        $id = $this->db->get_column('artist', 'artist_id', 'name', $artist);
        $result = $this->db->get('song', "artist_id='$id'");
        return shuffle($result);
    }

    public function get_playlist($sounds_like)
    {
        $artists = $this->db->get('sounds_like', "mainstream_artist='$sounds_like'");
        $songs = array();
        foreach ($artists as $artist)
        {
            foreach ($this->db->get('track', "artist_id='".$artist['artist_id']."'") as $track)
            {
                array_push($songs, $track);
            }
        }
        shuffle($songs);
        return $songs;
    }

    public function get_all_bands()
    {
        return $this->db->get('artist');
    }

}
