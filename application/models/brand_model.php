<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Brand_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Adding UTF 8 
        // Allow Myanmar Font
        $this->db->cache_delete($this->router->fetch_class(), $this->router->fetch_method());
        $this->db->simple_query('SET NAMES \'utf-8\'');
    }

    function createBrand($brand_id = 0) {
        $brand = array(
            'name' => $this->input->post('name'),
            'brand_type' => $this->input->post('brand_type'),
            'country' => $this->input->post('country'),
            'is_designer' => $this->input->post('is_designer'),
            'status' => $this->input->post('status'),
            'updated_date' => date('Y-m-d H:i:s')
        );
        if (ADMIN == $this->session->userdata('user_type')) {
            $brand['confirm_date'] = date('Y-m-d H:i:s');
        }
        if ($brand_id > 0) {
            $this->db->where("id", $brand_id)
                    ->update("brands", $brand);
            if ($this->db->affected_rows() > 0) {
                return false;
            }
        } else {
            $brand['created_date'] = date('Y-m-d H:i:s');
            $this->db->insert('brands', $brand);
            if ($this->db->insert_id() > 0) {
                return TRUE;
            }
        }

        return FALSE;
    }

    function getBrandDetails($brand_id) {
        $sql = "SELECT `id`, `name`, `brand_type`, `is_designer`, `country`, `status`FROM `brands` WHERE `id` = '{$brand_id}'";
        return $this->db->query($sql)->first_row("array");
    }

    function getBrands() {
        $this->load->driver("cache", array('adapter', 'file'));
        $brandList = $this->cache->file->get('brands');
        if (!is_array($brandList) || !count($brandList)) {
            $sql = "SELECT brand.id, brand.name FROM brands AS brand ORDER BY brand.name";
            $result = $this->db->query($sql)->result_array();
            foreach ($result as $row) {
                $brandList[$row['id']] = $row['name'];
            }
            $cacheTime = 6 * 60 * 60; // 6 hour
            $this->cache->file->save('brands', $brandList, $cacheTime);
        }
        return $brandList;
    }

    // brand pagination
    function search($query, $limit, $offset) {
        // pagination query
        $result = $this->db->get('brands')->result_array();
        $records['total_records'] = count($result);
        $records['total_pages'] = ceil($records['total_records'] / $limit);
        $records['rows'] = array();
        // result query
        $records['rows'] = $this->db->limit($limit, $offset)
                                    ->get('brands')
                                    ->result_array();
        return $records;
    }

}
