
<?php

class User_Model extends Model {

    private $current_user_role;
    private $current_user_name;
    private $current_user_email;
    private $current_user_phone;
    private $current_user_id;


    public function get_value($str)
    {
        echo $this->current_user_role;
        return $this->current_user_role;
    }

    public function get_active_users()
    {
        //return $this->db->query("SELECT user_id,full_name, email, phone, role FROM user ORDER BY full_name");
        return $this->db->get('user');
    }

    public function get_user($id)
    {
        $result = $this->db->get_one('user', 'user_id', $id);
        unset($result['password']);
        unset($result['user_id']);
        return $result;
    }

    public function update_user($id, $data)
    {
        $this->db->update('user', $id, $data);
        return;
    }

    public function valid_credentials($email, $pass)
    {
        $pass = $this->encryptor->hash($pass);
        $result = $this->db->get('user',"email='$email' AND password='$pass'");
        if (isset($result[0]))
        {
            /*
            $this->current_user_id = $result[0]['user_id'];
            $this->current_user_name = $result[0]['full_name']; 
            $this->current_user_email = $result[0]['email'];  
            $this->current_user_phone = $result[0]['phone'];  
            $this->current_user_role = $result[0]['role'];  
            */
            return true;
        }
        return false;
    }


}
