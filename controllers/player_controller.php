<?php

require_once "pir/playlist.php";

class Player_Controller extends Controller {

    function __construct()
    {
        //$user_model = $this->load_model('player');
        $this->player = $this->load_model('player');
    }
    
    function index()
    {
        $this->load_view("dash");
    }

    function all()
    {
        foreach ($this->player->get_all_bands() as $band)
        {
            echo "<strong>".$band['name']."</strong> - " . $band['city']. ', '.$band['state'];
            foreach ($this->player->db->get('sounds_like', "artist_id='".$band['artist_id']."'") as $artist)
            {
                echo ' / ' . $artist['mainstream_artist'];
            }
            echo "</br>";
        }
    }

    function start()
    {
        $gen = new PIR_PlaylistGenerator($_POST['artist']);     
        $data['songs'] = $gen->create_playlist();
        $this->load_view('player', $data);
    }
 
    function artist($choice) 
    {
        $this->player->get_songs($choice);
    }

    function add_music()
    {
        $this->load_view("upload");
    }

    function do_upload()
    {
        echo "TESTING";
    }

}
