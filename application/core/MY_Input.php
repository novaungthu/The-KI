<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Input extends CI_Input {
    function save_query ($query_array) {
        $CI =& get_instance();
        $query_string = http_build_query($query_array);
        $hash_string = md5($query_string);
        
        // check if exists
        $rows = $CI->db->get_where('query', array('hash' => $hash_string))->result();
        if (isset($rows[0])) {
            return $rows[0]->id;
        }
        
        // save if not exists
        $CI->db->insert('query', array('query_string' => $query_string, 'hash' => $hash_string));
        return $CI->db->insert_id();
    }

    function load_query ($query_id) {
        $CI =& get_instance();
        $rows = $CI->db->get_where('query', array('id' => $query_id))->result();
        if (isset($rows[0])) {
            parse_str($rows[0]->query_string, $_GET);		
        }
    }
}
