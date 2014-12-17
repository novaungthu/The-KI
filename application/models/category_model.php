<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Category_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Adding UTF 8 
        // Allow Myanmar Font
        $this->db->cache_delete($this->router->fetch_class(), $this->router->fetch_method());
        $this->db->simple_query('SET NAMES \'utf-8\'');
    }

    function createCategory($shop_id, $category_id = 0) {
        $category = array(
            "name" => $this->input->post("name"),
            'shop_id' => $shop_id,
            "main_id" => $this->input->post("main_category"),
            "brand_id" => $this->input->post("brand"),
            "status" => $this->input->post("status"),
            "updated_date" => date("Y-m-d H:i:s")
        );
        if ($category_id > 0) {
            $this->db->where("id", $category_id)
                    ->update("categories", $category);
            if ($this->db->affected_rows() > 0) {
                return true;
            }
        } else {
            $category['created_date'] = date('Y-m-d H:i:s');
            $this->db->insert("categories", $category);
            $this->db->insert("categories", $category);
            if ($this->db->insert_id()) {
                return true;
            }
        }
       
        return false;
    }

    function getCategoryDetails($id) {
        $sql = "SELECT `category`.`id`,`category`.`shop_id`,`category`.`main_id`, `category`.`brand_id`, `category`.`name`, `category`.`status`, `brand`.`name` AS `brand_name`, `main_category`.`name` AS `main_category_name` FROM `categories` AS `category` "
                . " LEFT JOIN `brands` AS `brand` ON `category`.`brand_id` = `brand`.`id`"
                . " LEFT JOIN `main_categories` AS `main_category` ON `category`.`main_id` = `main_category`.`id`"
                . "WHERE `category`.`id` = '$id' LIMIT 1";
        $query = $this->db->query($sql);
        if ($query->num_rows == 1) {
            return $query->row_array('array');
        }
        return false;
    }

    function createMainCategory($post, $id = 0) {
        $result = FALSE;
        if ($id > 0) {
            $this->db->where("id", $id)
                    ->update("main_categories", array("name" => $post['name']));
            if ($this->db->affected_rows() > 0) {
                $result = TRUE;
            }
        } else {
            $this->db->insert("main_categories", array("name" => $post["name"]));
            if ($this->db->insert_id()) {
                $result = TRUE;
            }
        }
        if (TRUE == $result) {
            // delete main category cache
            $this->load->driver("cache", array('adapter', 'file'));
            $this->cache->delete("main_categories");
            return true;
        }
        return $result;
    }

    function getMainCategories() {
        $this->load->driver("cache", array('adapter', 'file'));
        $mainCategoryList = $this->cache->file->get('main_categories');
        if (!is_array($mainCategoryList) || !count($mainCategoryList)) {
            $sql = "SELECT main_category.id, main_category.name FROM main_categories AS main_category ORDER BY main_category.name";
            $result = $this->db->query($sql)->result_array();
            foreach ($result as $row) {
                $mainCategoryList[$row['id']] = $row['name'];
            }
            $cacheTime = 6 * 60 * 60; // 6 hour
            $this->cache->file->save('main_categories', $mainCategoryList, $cacheTime);
        }
        return $mainCategoryList;
    }

    function mainCategorySearch($query, $limit, $offset) {
        // pagination query
        $result = $this->db->get('main_categories')->result_array();
        $records['total_records'] = count($result);
        $records['total_pages'] = ceil($records['total_records'] / $limit);
        $records['rows'] = array();
        // result query
        $records['rows'] = $this->db->limit($limit, $offset)
                                    ->get('main_categories')
                                    ->result_array();
        return $records;
    }

    function categorySearch($query, $limit, $offset) {
        // pagination query
        $result = $this->db->get('categories')->result_array();
        $records['total_records'] = count($result);
        $records['total_pages'] = ceil($records['total_records'] / $limit);
        $records['rows'] = array();
        // result query
        $records['rows'] = $this->db->get('categories')->result_array();
        return $records;
    }

}
