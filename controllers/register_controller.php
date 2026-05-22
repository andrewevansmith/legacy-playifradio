<?php

class Register_Controller extends Controller {

    function __construct() {
        $this->db = new Database();
        $this->artist = $this->load_model('artist');
        $this->session = Session::get_instance();
    }
    
    function index() {
        $this->load_view("registration");
    }

    function process() {
        $id = $this->artist->add_artist($_POST);
        $email = $_POST['email'];
        $name  = $_POST['contact_name'];
        $artist = $_POST['name'];
        $password = $_POST['password'];
        $emailer = new Emailer('Thank you for signing up for PlayIf Radio!');
        $emailer->set_message_file('artist_submission.php');
        $emailer->send($email);
        $emailer->send(OWNER_EMAIL);
        redirect("register/add_music/");
    }
    
    function login($error="") {
        $data = array();
        if ($error != "") {
            $data['error'] = "Invalid email/pass combination!";
        }
        $this->load_view("login", $data);
    }

    function validate() {
        $q = $this->artist->valid_credentials($_POST['email'], $_POST['password']);
        if (count($q) == 1) {
            $this->session->logged_in = "yes";
            $this->session->artist = $q[0];
            redirect("register/add_music/");
        } else {
            redirect("register/login/e");
        }
    }

    function add_music() {
        if (!isset($this->session->logged_in)) {
           redirect('register/login/'); 
        }
        $id = $this->session->artist['artist_id'];
        $data['tracks'] = $this->db->get('track', "artist_id='$id'");
        $data['artist'] = $this->session->artist;
        $data['id'] = $id;
        $this->load_view("artist_area", $data);
    }

    function process_music($id) {
        $this->artist->add_track($id, $_POST);
        $this->session->file = "success";
        redirect('register/add_music');
    }

    function logout() {
        $this->session->destroy();
        redirect('register/login');
    }

}
