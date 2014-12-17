<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Department_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Adding UTF 8 
        // Allow Myanmar Font
        $this->db->cache_delete($this->router->fetch_class(), $this->router->fetch_method());
        $this->db->simple_query('SET NAMES \'utf-8\'');
    }

    function createDepartment($post, $id = 0) {
        $department = array(
            'name' => $post['name'],
            'status' => ACTIVE,
            'updated_date' => date("Y-m-d H:i:s")
        );
        if ($id > 0) {
            $this->db->where('id', $id)
                    ->update("departments", $department);
            if ($this->db->affected_rows() > 0) {
                return true;
            }
        } else {
            $department['created_date'] = date("Y-m-d H:i:s");
            $this->db->insert("departments", $department);
            if ($this->db->insert_id() > 0) {
                return true;
            }
        }
        return false;
    }

    function getDepartments() {
        $this->load->driver("cache", array('adapter', 'file'));
        $departmentList = $this->cache->file->get('department_list');
        if (!is_array($departmentList) || !count($departmentList)) {
            $sql = "SELECT `department`.`id`, `department`.`name` FROM `departments` AS `department`"
                    . "ORDER BY `department`.`name`";
            $result = $this->db->query($sql)->result_array();
            foreach ($result as $row) {
                $departmentList[$row['id']] = $row['name'];
            }
            $cacheTime = 6 * 60 * 60; // 6 hour
            $this->cache->file->save('department_list', $departmentList, $cacheTime);
        }
        return $departmentList;
    }

    function getDepartmentDetails($id) {
        $query = $this->db->where("id", $id)
                ->get("departments");
        if ($query->num_rows() == 1) {
            return $query->first_row("array");
        }
        return false;
    }

    function search($query, $limit, $offset) {
        // pagination query
        $result = $this->db->get("departments")->result_array();
        $records['total_records'] = count($result);
        $records['total_pages'] = ceil($records['total_records'] / $limit);
        $records['rows'] = array();
        // result query
        $records['rows'] = $this->db->limit($limit, $offset)
                                ->get('departments')->result_array();
        return $records;
    }

}
