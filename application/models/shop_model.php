<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Shop_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Adding UTF 8 
        // Allow Myanmar Font
        $this->db->cache_delete($this->router->fetch_class(), $this->router->fetch_method());
        $this->db->simple_query('SET NAMES \'utf-8\'');
    }

    function create($id = 0) {
        $shop = array(
            'name' => $this->input->post("name"),
            'store_type' => $this->input->post("store_type"),
            'price_range' => $this->input->post("price_range"),
            "is_online" => $this->input->post("is_online"),
            'style' => $this->input->post("style"),
            'email' => $this->input->post('email'),
            'telephone_no' => $this->input->post("telephone_no"),
            'group_phone' => $this->input->post('group_phone'),
            'website' => $this->input->post("website"),
            "memo" => $this->input->post("memo"),
            "note" => $this->input->post("note"),
            "affiliate_programme" => $this->input->post("af_programme"),
            "newsletter" => $this->input->post("mail_newsletter"),
            "status" => $this->input->post("status"),
            "address_1" => $this->input->post("address_1"),
            "address_2" => $this->input->post("address_2"),
            "address_3" => $this->input->post("address_3"),
            "post_code" => $this->input->post("post_code"),
            "latitude" => $this->input->post("latitude"),
            "longitude" => $this->input->post("longitude"),
            "region" => $this->input->post("region"),
            "town" => $this->input->post("town"),
            "county" => $this->input->post("county"),
            "country" => $this->input->post("country")
        );
        // if the store type is concession , show 
        if ($this->input->post("store_type") == CONCESSION) {
            $shop['department_id'] = $this->input->post('dep_store');
        }
        if ($id > 0) {
            $shop['updated_date'] = date("Y-m-d H:i:s");
            $this->db->where("id", $id)
                    ->update("shops", $shop);
            if ($this->db->affected_rows() > 0) {
                return true;
            }
        } else {
            $shop['created_date'] = date("Y-m-d H:i:s");
            $this->db->insert("shops", $shop);
            if ($this->db->insert_id()) {
                return TRUE;
            }
        }
        return FALSE;
    }

    // Add new brand to shop
    function addBrand($shop_id = 0) {
        if (!count($this->input->post("brands"))) {
            return false;
        }

        $data = array();
        foreach ($this->input->post("brands") as $brand) {
            $data[] = array(
                'shop_id' => $shop_id,
                "brand_id" => $brand
            );
        }

        $this->db->insert_batch("shop_brands", $data);
        if ($this->db->insert_id() > 0) {
            return true;    
        }
        return false;
    }

    // Add new category to shop
    function addCategory($shop_id = 0) {
        if (!count($this->input->post("category"))) {
            return false;
        }
        $data = array();
        foreach ($this->input->post("category") as $category) {
            $data[] = array(
                'shop_id' => $shop_id,
                'main_category_id' => $category,
                'status' => ACTIVE,
                'created_date' => date('Y-m-d H:i:s'),
                'updated_date' => date('Y-m-d H:i:s')
            );
        }
        $this->db->insert_batch("shop_categories", $data);
        if ($this->db->insert_id() > 0) {
            return true;
        }
        // multiple insert with one query
        return false;
    }

    function editShopCategory($id, $post) {
        if (!ctype_digit($id) || $id < 1) {
            return false;
        }
        $category = array(
            'status' => $post['status'],
            'updated_date' => date("Y-m-d H:i:s")
        );
        // check post type
        if (stripos($post['name'], "jewellery") !== false) {
            $category['start_size'] = implode(",", $post['jewellery_size']);
        } else if (stripos($post['name'], "shoe") !== false) {
            $category['start_size'] = implode(",", $post['shoe_size_1']);
            $category['other_size'] = implode(",", $post['shoe_size_2']);
        }else if (stripos($post['name'], "lingerie") !== false) {
            $category['start_size'] = implode(",", $post['lingerie_size_1']);
            $category['other_size'] = implode(",",$post['lingerie_size_2']);
        } else {
            $category['start_size'] = $post['start_size'];
            $category['end_size'] = $post['end_size'];
            $category['petite'] = implode(",", $post["petite"]);
        }
        $this->db->where("id", $id)
                ->update("shop_categories", $category);
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    function getCategoryDetails($id) {
        $sql = "SELECT `category`.`id`, `main`.`name`, `category`.`start_size`, `category`.`end_size`, `category`.`other_size`,`category`.`petite`,`category`.`status` FROM `shop_categories` as `category` "
                . " LEFT JOIN `main_categories` AS `main` ON `category`.`main_category_id` = `main`.`id`"
                . "WHERE `category`.`id` = '{$id}'";
        $query = $this->db->query($sql);
        if ($query->num_rows == 1) {
            $category = $query->row_array('array');
            return $category;
        }
        return false;
    }

    function getShopDetails($shop_id) {
        $shopList = array();
        // shop details
        $sql = "SELECT `shop`.`id`, `shop`.`name`,`shop`.`store_type`, `shop`.`email`, `shop`.`telephone_no`, `shop`.`group_phone`, `shop`.`website`, `shop`.`memo`, `shop`.`note`, `shop`.`affiliate_programme`, `shop`.`newsletter`, `shop`.`is_online`,`shop`.`price_range`,`shop`.`department_id`,"
                . "`shop`.`post_code`, `shop`.`latitude`, `shop`.`longitude`, `shop`.`address_1`, `shop`.`address_2`,`shop`.`address_3`, `shop`.`region` , `shop`.`town`, `shop`.`county`, `shop`.`country`, `shop`.`status`  "
                . "FROM `shops` AS `shop` "
                . "WHERE `shop`.`id` = '{$shop_id}' LIMIT 1";
        $query = $this->db->query($sql);
        if ($query->num_rows == 1) {
            $shopList = $query->row_array('array');
            // get service , review
            $sql = "SELECT  `review`.`id`, `review`.`refer_id`, `review`.`user_id`, `review`.`review_type`, `review`.`review_description` "
                    . "FROM `reviews` AS `review` "
                    . "WHERE `refer_id` = '" . $shop_id . "' AND `review_type` IN (" . SHOP_REVIEW . "," . SHOP_SERVICE . ")";

            $result = $this->db->query($sql)->result_array();
            if (count($result)) {
                $shopList['shopServices'] = array();
                $shopList["shopReviews"] = array();
                foreach ($result as $row) {
                    if (SHOP_REVIEW == $row['review_type']) {
                        $shopList['shopReviews'][] = $row;
                    } else if (SHOP_SERVICE == $row['review_type']) {
                        $shopList['shopServices'][] = $row;
                    }
                }
            }
            // get shop schedule
            $sql = "SELECT `schedule`.`id`, `schedule`.`day_arrange`, `schedule`.`schedule_type`, `schedule`.`start_time`, `schedule`.`end_time` FROM `shop_schedules` AS `schedule` WHERE `schedule`.`shop_id` = '{$shop_id}'";
            $shopList["shopSchedules"] = $this->db->query($sql)->result_array();

            // get brand List
            $sql = "SELECT `brand`.`id`, `brand`.`name` FROM `shop_brands` "
                    . " JOIN `brands` AS `brand` ON `shop_brands`.`brand_id` = `brand`.`id`"
                    . " WHERE `shop_brands`.`shop_id` = '{$shop_id}'";

            $result = $this->db->query($sql)->result_array();
            if (count($result)) {
                $shopList['brands'] = $result;
            }
            // get category List
            $sql = "SELECT `main`.`name` AS `name` , `category`.`id`, `category`.`start_size`, `category`.`other_size`, `category`.`end_size`, `category`.`petite`,`category`.`status`,`category`.`created_date` "
                    . " FROM `shop_categories` AS `category` "
                    . " LEFT JOIN `main_categories` AS `main` ON `category`.`main_category_id` = `main`.`id`"
                    . "WHERE `shop_id` = '{$shop_id}'";
            $result = $this->db->query($sql)->result_array();
            if (count($result)) {
                $shopList['categories'] = $result;
            }
            return $shopList;
        }
        return false;
    }

    // Service and shop
    function createShopService($shop_id, $id = 0) {
        $service = array(
            "refer_id" => $shop_id,
            "user_id" => $this->session->userdata("userId"),
            "review_type" => SHOP_SERVICE,
            "review_description" => $id > 0 ? $this->input->post("description_{$id}") : $this->input->post("description"),
            "updated_date" => date("Y-m-d H:i:s")
        );
        if ($id > 0) {
            $this->db->where("id", $id)
                    ->update("reviews", $service);
            if ($this->db->affected_rows() > 0) {
                return true;
            }
        } else {
            $service["created_date"] = date("Y-m-d H:i:s");
            $this->db->insert("reviews", $service);
            if ($this->db->insert_id()) {
                return true;
            }
        }
        return false;
    }

    function createShopReview($shop_id, $id = 0) {
        $review = array(
            "refer_id" => $shop_id,
            "user_id" => $this->session->userdata("userId"),
            "review_type" => SHOP_REVIEW,
            "review_description" => $id > 0 ? $this->input->post("description_{$id}") : $this->input->post("description"),
            "updated_date" => date("Y-m-d H:i:s")
        );
        if ($id > 0) {
            $this->db->where("id", $id)
                    ->update("reviews", $review);
            if ($this->db->affected_rows() > 0) {
                return true;
            }
        } else {
            $review["created_date"] = date("Y-m-d H:i:s");
            $this->db->insert("reviews", $review);
            if ($this->db->insert_id()) {
                return true;
            }
        }
    }

    function createShopSchedule($shop_id, $id = 0) {
        $schedule = array(
            'shop_id' => $shop_id,
            'schedule_type' => $this->input->post("schedule_type")
        );
        switch ($this->input->post("schedule_type")) {
            case DATE_RANGE:
                $schedule['start_date'] = date('Y-m-d', strtotime($this->input->post("start_date")));
                $schedule['end_date'] = date("Y-m-d", strtotime($this->input->post("end_date")));
                $schedule["start_time"] = date("H:i:s", strtotime($this->input->post("start_time")));
                $schedule["end_time"] = date("H:i:s", strtotime($this->input->post("end_time")));
                break;
            case ALL_DAY:
            case EACH_DAY:
            case SP_DATE:
                $schedule['start_time'] = date("H:i:s", strtotime($this->input->post("sp_start_time")));
                $schedule["end_time"] = date("H:i:s", strtotime($this->input->post("sp_end_time")));
                if (ALL_DAY == $this->input->post("schedule_type")) {
                    $schedule['day_arrange'] = implode(",", $this->input->post("check_date"));
                } else if (EACH_DAY == $this->input->post("schedule_type")) {
                    $schedule['day_arrange'] = $this->input->post('radio_date');
                } else if (SP_DATE == $this->input->post("schedule_type")) {
                    $schedule["start_date"] = date("Y-m-d", strtotime($this->input->post("sp_start_date")));
                }
                break;
        }
        $schedule['note'] = $this->input->post('note');
        $this->db->insert("shop_schedules", $schedule);
        if ($this->db->insert_id()) {
            return true;
        }
        return false;
    }

    // Photo Limit of shop
    function checkPhotoLimit($shop_id = '') {
        $sql = "SELECT count(*) as count FROM `shop_photos` WHERE `shop_id`= '{$shop_id}'";
        $result = $this->db->query($sql)->result_array();
        if (count($result)) {
            if ($result[0]['count'] < MAX_PHOTO) {
                return true;
            } else {
                return false;
            }
        }
        return true;
    }

    // brand pagination
    function search($query, $limit, $offset) {
        // pagination query
        $result = $this->db->get('shops')->result_array();
        $records['total_records'] = count($result);
        $records['total_pages'] = ceil($records['total_records'] / $limit);
        $records['rows'] = array();
        // result query
        $records['rows'] = $this->db->get('shops')->result_array();
        return $records;
    }

}
