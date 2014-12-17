<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Adding UTF 8 
        // Allow Myanmar Font
        $this->db->cache_delete($this->router->fetch_class(), $this->router->fetch_method());
        $this->db->simple_query('SET NAMES \'utf-8\'');
    }

    function validate() {
        $query = $this->db->where('email', $this->input->post('email'))
                ->where('status', ACTIVE)
                ->get('users');
        if ($query->num_rows == 1) {
            $row = $query->row();
            if (crypt($this->input->post('password'), $row->password) == $row->password) {
                // setting the user data to session
                $data = array(
                    'email' => $row->email,
                    'user_name' => base64_encode($row->user_name),
                    'user_type' => $row->user_type,
                    'userId' => $row->id
                );
                // update last login
                $this->db->where('id', $row->id);
                $this->db->update("users", array("last_login" => date("Y-m-d H:i:s")));
                
                $this->session->set_userdata($data);
                return true;
            }
        }
        return false;
    }
    
    function signUp() {
        $user = array(
           'user_name' => $this->input->post("name"),
            'email' => $this->input->post('email'),
            'password' => crypt($this->input->post("password"), SALT),
            'user_type' => SHOP_OWNER,
            'status' => $this->input->post("status"),
            'created_date' => date('Y-m-d H:i:s'),
            'updated_date' => date('Y-m-d H:i:s')
        );
        $this->db->insert("users", $user);
        if($this->db->insert_id()) {
            return true;
        }
        return false;
    }
    function getUserProfile() {
        $sql = "SELECT * FROM users AS user WHERE user.id = " . $this->session->userdata("userId");
        return $this->db->query($sql)->first_row('array');
    }
    function search($query, $limit, $offset) {
        // pagination query
        $result = $this->db->get('users')->result_array();
        $records['total_records'] = count($result);
        $records['total_pages'] = ceil($records['total_records'] / $limit);
        $records['rows'] = array();
        // result query
        $records['rows'] = $this->db->get('users')->result_array();
        return $records;
    }
    function updateProfile() {
        $post = $this->input->post();
        $update = array(
            'user_name' => $post['name'],
            'email' => $post['email'],
            'status' => $post['status'],
            'updated_date' => date("Y-m-d H:i:s")
        );
        if (array_key_exists('password', $post) && !empty($post['password'])) {
             $update['password'] = crypt($this->input->post('password'), SALT);
        } 
        // Update with session id
        $this->db->where('id', $this->session->userdata('userId'))
                ->update('users', $update);

        if ($this->db->affected_rows() > 0) {
            $this->session->set_userdata('user_name', base64_encode($post['name']));
            return true;
        }
        return false;
    }

    function password_check($email, $password) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        $this->db->select('password');
        $this->db->where('email', $email);
        $query = $this->db->get('users');
      
        if ($query->num_rows == 1) {
            $row = $query->row();
            if (crypt($password, $row->password) == $row->password) {
                return true;
            }
        }

        return false;
    }

    // check if user already exists
    function hasUserByEmail($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        $this->db->where('email', $email);
        $query = $this->db->get('users');

        if ($query->num_rows == 1) {
            return true;
        }
        return false;
    }

    /**
     * generate unique hash code for a user
     * 
     * @param string $email
     * @return boolean
     */
    function generateCode($email) {
        $this->db->select('email, last_login');
        $this->db->where('email', $email);
        $query = $this->db->get('users');

        if ($query->num_rows == 1) {
            $row = $query->row();
            return sha1(md5($row->email . $row->last_login));
        }
        return false;
    }

    function generateActivationCode($email) {
        return $this->generateCode($email);
    }

    function generateActivationLink($email) {
        return site_url('user/verify/' . urlencode(base64_encode($email)) . '/' . $this->generateActivationCode($email));
    }

    function generateResetPasswordLink($email) {
        return site_url('user/reset_password/' . urlencode(base64_encode($email)) . '/' . $this->generateCode($email));
    }

    function generateResetPasswdCode($email) {
        return $this->generateCode($email);
    }

    /**
     * change user status to enabled (active)
     * 
     * @param string $email
     * @return boolean
     */
    function activate_user($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        $this->db->select('status');
        $this->db->where('email', $email);
        $query = $this->db->get('users');

        if ($query->num_rows == 1) {
            $row = $query->row();
            if (DEACTIVE == $row->status) {
                $this->db->where('email', $email);
                $this->db->update('users', array('status' => ACTIVE,
                    'updated_date' => date('Y-m-d H:i:s')));

                return true;
            }
        }
        return false;
    }

    /**
     * reset password
     * 
     * @param string $email
     * @return boolean
     */
    function reset_password($email) {
        $this->db->where('email', $email);
        $update = $this->db->update('users', array('password' => crypt($this->input->post('password'), SALT),
            'updated_date' => date('Y-m-d H:i:s')));

        return $update;
    }

}
