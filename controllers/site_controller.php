<?php

class Site_Controller extends Controller {

    function __construct() {
        $this->session = Session::get_instance();
    }
    
    function index($v="") {
        $data = array();
        switch ($v) {
            case 'success':
                $data['value'] = 'Successful submission';
                break;
            case "":
                $data['value'] = '';
                break;
        };
        $this->load_view('home', $data);
    }

    function about() {
        $this->load_view('about');
    }

    function add_email() {
        $db = new Database();
        $db->insert('email', $_POST);
        $emailer = new Emailer('Thank you for signing up for the PlayIf Radio mailing list!');
        $emailer->set_message_file('email.php');
        $emailer->send($_POST['email']);
        $emailer->send(OWNER_EMAIL);
        redirect('site/index/success#form');
    }

    function page404() {
        $this->load_view('404');
    }
}
