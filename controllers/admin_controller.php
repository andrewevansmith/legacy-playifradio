<?php

    class Admin_Controller extends Controller {

        function __construct() {
            $this->artists = $this->load_model('artist');
            $this->db = new Database();
            session_start();
        }

        function index() {
            if (isset($_SESSION['logged_in'])) {
                $this->dashboard();
            } else {
                redirect('admin/dash_login');
            }
        }

        function dash_login() {
            $this->load_view('admin_login');
        }

        private function dashboard() {
            $data = array(
                'artists' => $this->db->query("SELECT * FROM artist ORDER BY artist_id DESC")
            );
            foreach ($data['artists'] as &$artist) {
                $id = $artist['artist_id'];
                $artist['tracks'] = $this->db->query("
                    SELECT name, filename, track_id FROM track WHERE artist_id='$id' AND 
                    status='inactive' ORDER BY track_id DESC  
                ");
            }
            $this->load_view('admin_dash', $data); 
        }

        function validate() {
            if ( ($_POST['email'] == ADMIN_EMAIL) && ($_POST['password'] == ADMIN_PASSWORD) ) {
                $_SESSION['logged_in'] = 'Admin'; 
                redirect('admin/index');
            } else {
                redirect('admin/dash_login');
            }
        }

        function listen($id) {
            if (!isset($_SESSION['logged_in'])) {
                redirect('admin/dash_login');
            }
            $filename = $this->db->get_column('track', 'filename', 'track_id', $id);
            $filename = $filename[0];
            echo '<audio src="'.BASE_URL.'uploads/audio/'.$filename.'" controls="controls" type="audio/mp3">';
        }

        function approve($id) {
            if (!isset($_SESSION['logged_in'])) {
                redirect('admin/dash_login');
            }
            $data = array('status'=>'active');
            $this->db->update('track', $id, $data);
            echo "<span style='color:green'>Successful!</span>";
        }

        function disapprove($id) {
            if (!isset($_SESSION['logged_in'])) {
                redirect('admin/dash_login');
            }
            $data = array('status'=>'disapproved');
            $this->db->update('track', $id, $data);
            echo "<span style='color:green'>Successful!</span>";
        }



        function logout() {
            session_destroy();
            redirect('admin/dash_login');
        }

    }
