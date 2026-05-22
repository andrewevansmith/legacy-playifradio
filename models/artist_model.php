<?php

class Artist_Model extends Model {

    public function add_track($id, $input) {
        $input['artist_id'] = $id;
        $input['album_id'] = '1';
        $this->db->insert('track', $input);
        return true;
    }

    public function valid_credentials($email, $password) {
        return $this->db->get('artist', "email='$email' AND password='$password'");
    }
        
    public function add_artist($input) {
        $input['user_id'] = 1;
        $this->db->insert('artist', $input);
        $artist_id = mysql_insert_id();
        $s1 = array();
        $s2 = array();
        $s3 = array();
        $s1['mainstream_artist'] = $input['artist1'];
        $s2['mainstream_artist'] = $input['artist2'];
        $s3['mainstream_artist'] = $input['artist3'];
        $s1['artist_id'] = $artist_id; 
        $s2['artist_id'] = $artist_id; 
        $s3['artist_id'] = $artist_id; 
        $this->db->insert('sounds_like', $s1);
        $this->db->insert('sounds_like', $s2);
        $this->db->insert('sounds_like', $s3);
        return $artist_id;
    }

}
