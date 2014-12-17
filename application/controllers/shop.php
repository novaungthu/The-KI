<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Shop extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function createShop() {
        if ($this->input->post()) {
            $post = $this->input->post();
            $this->load->library("form_validation");
            // Shop details
            $this->form_validation->set_rules("name", "Shop Name", "trim|required");
            $this->form_validation->set_rules("store_type", "Store Type", "trim|rquired");
            // Is store type is concession
            if (!empty($post['store_type']) && $post['store_type'] == CONCESSION) {
                $this->form_validation->set_rules("dep_store", "Department Store", "trim|required");
            }
            $this->form_validation->set_rules("price_range", "Price Range", "trim|required");
            $this->form_validation->set_rules("is_online", "Is Online Store", "trim|required");
            $this->form_validation->set_rules("style", "Style", "trim|required");
            $this->form_validation->set_rules("email", "Shop Email", "trim|required|valid_email");
            $this->form_validation->set_rules("telephone_no", "Telephone", "trim|required");
            $this->form_validation->set_rules("group_phone", "Group Phone", "trim");
            $this->form_validation->set_rules("website", "Website", "trim|url");
            $this->form_validation->set_rules("memo", "Memo", "trim");
            $this->form_validation->set_rules("note", "Note", "trim");
            $this->form_validation->set_rules("af_programme", "Affiliate Programme", "trim");
            $this->form_validation->set_rules("mail_newsletter", "Mailling/Newsletter", "trim");
            $this->form_validation->set_rules("status", "Shop Status", "trim|rquired");

// Shop Address
            $this->form_validation->set_rules("address_1", "Address 1", "trim|required");
            $this->form_validation->set_rules("address_2", "Address 2", "trim");
            $this->form_validation->set_rules("address_3", "Address 3", "trim");
            $this->form_validation->set_rules("post_code", "Post Code", "trim|required");
            $this->form_validation->set_rules("latitude", "Latitude", "trim|required");
            $this->form_validation->set_rules("longitude", "Longitude", "trim|required");
            $this->form_validation->set_rules("region", "Region", "trim|required");
            $this->form_validation->set_rules("town", "Town", "trim|required");
            $this->form_validation->set_rules("county", "county", "trim|required");
            $this->form_validation->set_rules("country", "Country", "trim");

            if (FALSE === $this->form_validation->run()) {
                $data['alert']['text'] = validation_errors();
                $data['alert']['class'] = "error";
            } else {
                $this->load->model("shop_model");
                if (TRUE === $this->shop_model->create()) {
                    $this->session->set_flashdata("alert_text", "New shop is successfully created.");
                    $this->session->set_flashdata("alert_class", "success");
                    $new_id = $this->db->insert_id();
                    redirect("shop/editShop/{$new_id}");
                } else {
                    $data['alert']['text'] = "Error occured. Please try again.";
                    $data['alert']['class'] = "error";
                }
            }
        }
        // get departments
        $this->load->model("department_model");
        $data["departments"] = $this->department_model->getDepartments();
        $data['main_content'] = "dashboard/create_shop";
        $this->load->view("includes/backend_template", $data);
    }

    public function editShop($shop_id = 0) {
        if (!ctype_digit($shop_id) || 0 == $shop_id) {
            show_error("Invalid shop id.");
        }
        $this->load->model("shop_model");
        if ($this->input->post()) {
            $post = $this->input->post();
            $this->load->library("form_validation");
            // Shop details
            $this->form_validation->set_rules("name", "Shop Name", "trim|required");
            $this->form_validation->set_rules("store_type", "Store Type", "trim|rquired");
            
            if (!empty($post['store_type']) && $post['store_type'] == CONCESSION) {
                $this->form_validation->set_rules("dep_store", "Department Store", "trim|required");
            }
            $this->form_validation->set_rules("price_range", "Price Range", "trim|required");
            $this->form_validation->set_rules("email", "Shop Email", "trim|required|valid_email");
            $this->form_validation->set_rules("telephone_no", "Telephone", "trim|required");
            $this->form_validation->set_rules("group_phone", "Group Phone", "trim");
            $this->form_validation->set_rules("website", "Website", "trim|url");
            $this->form_validation->set_rules("memo", "Memo", "trim");
            $this->form_validation->set_rules("note", "Note", "trim");
            $this->form_validation->set_rules("af_programme", "Affiliate Programme", "trim");
            $this->form_validation->set_rules("mail_newsletter", "Mailling/Newsletter", "trim");
            $this->form_validation->set_rules("status", "Shop Status", "trim|rquired");

// Shop Address
            $this->form_validation->set_rules("address_1", "Address 1", "trim|required");
            $this->form_validation->set_rules("address_2", "Address 2", "trim");
            $this->form_validation->set_rules("address_3", "Address 3", "trim");
            $this->form_validation->set_rules("post_code", "Post Code", "trim|required");
            $this->form_validation->set_rules("latitude", "Latitude", "trim|required");
            $this->form_validation->set_rules("longitude", "Longitude", "trim|required");
            $this->form_validation->set_rules("region", "Region", "trim|required");
            $this->form_validation->set_rules("town", "Town", "trim|required");
            $this->form_validation->set_rules("county", "county", "trim|required");
            $this->form_validation->set_rules("country", "Country", "trim");
            if (FALSE == $this->form_validation->run()) {
                $data['alert'] ['text'] = validation_errors();
                $data['alert']['class'] = "error";
            } else {
                if (TRUE === $this->shop_model->create($shop_id)) {
                    $this->session->set_flashdata("alert_text", "Shop's info is successfully updated.");
                    $this->session->set_flashdata("alert_class", "success");
                    redirect("shop/editShop/{$shop_id}");
                } else {
                    $data['alert']['text'] = "Error occured!. Please try again";
                    $data['alert']['class'] = "error";
                }
            }
        }
        $data['shop'] = $this->shop_model->getShopDetails($shop_id);
        if (FALSE === $data['shop']) {
            show_error("Invalid shop id.");
        }
        // Category LIst
        $this->load->model("category_model");
        $data['categoryList'] = $this->category_model->getMainCategories();
        // remove category list
        if (isset($data['shop']['categories']) && count($data['shop']['categories'])) {
            foreach ($data['shop']['categories'] as $category) {
                unset($data['categoryList'][$category['id']]);
            }
        }

        // Image CRUD
        $this->load->library('image_CRUD');
        $this->image_crud = new image_CRUD();
        // customize the photo upload url 
        $this->image_crud->set_actionUrl('addPhoto');
        $data['photoOutput'] = getPhotoLibrary($this->image_crud);

        $this->load->model('brand_model');
        $data['brandList'] = $this->brand_model->getBrands();

        // remove already brand list
        if (isset($data['shop']['brands']) && count($data['shop']['brands'])) {
            foreach ($data['shop']['brands'] as $brand) {
                unset($data['brandList'][$brand['id']]);
            }
        }
        // get departments
        $this->load->model("department_model");
        $data["departments"] = $this->department_model->getDepartments();

        $data['main_content'] = "dashboard/shop_dashboard";
        $data['cur_page'] = "editShop";
        $this->load->view("includes/backend_template", $data);
    }

    // Add Brand To Shop
    public function addBrand($shop_id = 0) {
        $this->load->model("shop_model");
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules("brands[]", "Brand Name(s)", "trim|required");
            if (FALSE === $this->form_validation->run()) {
                $data['alert']['text'] = validation_errors();
                $data['alert']['class'] = "error";
            } else {
                if (TRUE === $this->shop_model->addBrand($shop_id)) {
                    $this->session->set_flashdata('alert_text', "New brand(s) is successfully added to these shop.");
                    $this->session->set_flashdata('alert_class', "success");
                    redirect("shop/addBrand/{$shop_id}");
                } else {
                    $data['alert']['text'] = "Error occured!.Please try again";
                    $data['alert']['class'] = "error";
                }
            }
        }
        $data['shop'] = $this->shop_model->getShopDetails($shop_id);
        if (FALSE === $data['shop']) {
            show_error("Invalid shop id.");
        }
        // Category LIst
        $this->load->model("category_model");
        $data['categoryList'] = $this->category_model->getMainCategories();
        // remove category list
        if (isset($data['shop']['categories']) && count($data['shop']['categories'])) {
            foreach ($data['shop']['categories'] as $category) {
                unset($data['categoryList'][$category['id']]);
            }
        }

        // Image CRUD
        $this->load->library('image_CRUD');
        $this->image_crud = new image_CRUD();
        // customize the photo upload url 
        $this->image_crud->set_actionUrl('addPhoto');
        $data['photoOutput'] = getPhotoLibrary($this->image_crud);

        $this->load->model('brand_model');
        $data['brandList'] = $this->brand_model->getBrands();

        // remove already brand list
        if (isset($data['shop']['brands']) && count($data['shop']['brands'])) {
            foreach ($data['shop']['brands'] as $brand) {
                unset($data['brandList'][$brand['id']]);
            }
        }
        // get departments
        $this->load->model("department_model");
        $data["departments"] = $this->department_model->getDepartments();

        $data['main_content'] = "dashboard/shop_dashboard";
        $data['cur_page'] = "addBrand";
        $this->load->view("includes/backend_template", $data);
    }

    // Add Category to Shop
    public function addCategory($shop_id = 0) {
        $this->load->model("shop_model");
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules("category[]", "Category Name(s)", "trim|required");
            if (FALSE === $this->form_validation->run()) {
                $data['alert']['text'] = validation_errors();
                $data['alert']['class'] = "error";
            } else {
                if (TRUE === $this->shop_model->addCategory($shop_id)) {
                    $this->session->set_flashdata("alert_text", "New category(s) is successfully added to these shop.");
                    $this->session->set_flashdata("alert_class", "success");
                    redirect("shop/editShop/{$shop_id}");
                } else {
                    $data['alert']['text'] = "Error Occured!.Please try again.";
                    $data['alert']['class'] = "error";
                }
            }
        }
        $data['shop'] = $this->shop_model->getShopDetails($shop_id);
        if (FALSE === $data['shop']) {
            show_error("Invalid shop id.");
        }
        // Category LIst
        $this->load->model("category_model");
        $data['categoryList'] = $this->category_model->getMainCategories();
        // remove category list
        if (isset($data['shop']['categories']) && count($data['shop']['categories'])) {
            foreach ($data['shop']['categories'] as $category) {
                unset($data['categoryList'][$category['id']]);
            }
        }

        // Image CRUD
        $this->load->library('image_CRUD');
        $this->image_crud = new image_CRUD();
        // customize the photo upload url 
        $this->image_crud->set_actionUrl('addPhoto');
        $data['photoOutput'] = getPhotoLibrary($this->image_crud);

        $this->load->model('brand_model');
        $data['brandList'] = $this->brand_model->getBrands();

        // remove already brand list
        if (isset($data['shop']['brands']) && count($data['shop']['brands'])) {
            foreach ($data['shop']['brands'] as $brand) {
                unset($data['brandList'][$brand['id']]);
            }
        }
        // get departments
        $this->load->model("department_model");
        $data["departments"] = $this->department_model->getDepartments();

        $data['main_content'] = "dashboard/shop_dashboard";
        $data['cur_page'] = "addCategory";
        $this->load->view("includes/backend_template", $data);
    }

    public function editCategory($id = 0) {
        if (IS_AJAX) {
            $this->load->model("shop_model");
            if ($this->input->post()) {
                $post = $this->input->post();
                $this->load->library("form_validation");
                $this->form_validation->set_rules("name", "Category Name", "trim|required");
                // Check Post
                if (stripos($post['name'], "jewellery") !== false) {
                    $this->form_validation->set_rules("jewellery_size[]", "Jewellery Size", "trim|required");
                } else if (stripos($post['name'], "shoe") !== false) {
                    $this->form_validation->set_rules("shoe_size_1[]", "Shoe Size", "trim|required");
                    $this->form_validation->set_rules("shoe_size_2[]", "Shoe Size", "trim");
                } else if (stripos($post['name'], "lingerie") !== false) {
                    $this->form_validation->set_rules("lingerie_size_1[]", "Lingerie Size", "trim|required");
                    $this->form_validation->set_rules("lingerie_size_2[]", "Lingerie Size", "trim");
                } else {
                    $this->form_validation->set_rules("start_size", "Start Size", "trim|required");
                    $this->form_validation->set_rules("end_size", "End Size", "trim|required");
                    $this->form_validation->set_rules("petite[]", "Petite/Tall", "trim");
                }
                $this->form_validation->set_rules("status", "Category Status", "trim|required");
                if (FALSE === $this->form_validation->run()) {
                    echo json_encode(array('alert' => false, "message" => validation_errors()));
                } else {
                    if (TRUE == $this->shop_model->editShopCategory($id, $this->input->post())) {
                        $this->session->set_flashdata("alert_text", "Category is successfully updated");
                        $this->session->set_flashdata("alert_class", "success");
                        echo json_encode(array('alert' => true));
                    } else {
                        echo json_encode(array('alert' => false, "message" => "Error occured.Please try again."));
                    }
                }
            } else {
                $data['category'] = $this->shop_model->getCategoryDetails($id);
                echo $this->load->view("dashboard/edit_category", $data);
            }
        }
    }

    // Add Photo to shop
    public function addPhoto($shop_id = 0) {
        $this->load->model("shop_model");
        $isAjaxLoaded = False;
        if (IS_AJAX) {
            $isAjaxLoaded = TRUE;
            // checking the request string
            $rsegments_array = $this->uri->rsegment_array();

            $shop_id = '';
            if (!in_array($rsegments_array[3], array('ordering', 'insert_title', 'delete_file'))) {
                if ($rsegments_array[4] == 'ajax_list') {
                    $shop_id = $rsegments_array[3];
                } else if ($rsegments_array[3] == 'upload_file') {
                    $shop_id = $rsegments_array[4];
                    $result = $this->shop_model->checkPhotoLimit($shop_id);
                    if (!$result) {
                        $this->session->set_userdata('photolimit', 'ok');
                        exit;
                    }
                } else {
                    $shop_id = $rsegments_array[3];
                }
            }
        }
        if ($isAjaxLoaded == FALSE) {
            $data['shop'] = $this->shop_model->getShopDetails($shop_id);
            if (FALSE === $data['shop']) {
                show_error("Invalid shop id.");
            }
        }

        // Image CRUD
        $this->load->library('image_CRUD');
        $this->image_crud = new image_CRUD();
        // customize the photo upload url
        $this->image_crud->set_actionUrl('addPhoto');
        $data['photoOutput'] = getPhotoLibrary($this->image_crud);

        $this->load->model('brand_model');
        $data['brandList'] = $this->brand_model->getBrands();
        $data['main_content'] = "dashboard/shop_dashboard";
        $data['cur_page'] = "addPhoto";
        $this->load->view("includes/backend_template", $data);
    }

    public function shopList($query_id = 0, $offset = 0) {
        $this->input->load_query($query_id);
        $data = array();
        $this->load->model("shop_model");
        $data['shopList'] = $this->shop_model->search($data, RECORDS_PER_PAGE, $offset);
        $this->load->library('pagination');
        $config['base_url'] = base_url() . "dashboard/shopList/{$query_id}";
        $config['uri_segment'] = 4;
        $config['total_rows'] = $data['shopList']['total_records'];
        $config['num_links'] = 3;
        $config['per_page'] = RECORDS_PER_PAGE;
// Twitter bootstrap markup
        $config = array_merge($config, $this->config->item('pagination_style'));
// bootstrap pagination style
        $this->pagination->initialize($config);
        $data['pagination_links'] = $this->pagination->create_links();
        $data['main_content'] = "dashboard/shop_list";
        $this->load->view("includes/backend_template", $data);
    }

    /** Service Review and Schedule * */
    public function createService($shop_id) {
        if (!ctype_digit($shop_id) || 0 == $shop_id) {
            show_error("Invalid shop id.");
        }
        $this->load->model("shop_model");
        if ($this->input->post()) {
            $id = 0;
            $this->load->library("form_validation");
            if (array_key_exists("editService", $this->input->post())) {
                $id = $this->input->post("editService");
                $this->form_validation->set_rules("description_{$id}", "Shop's service", "trim|required");
            } else {
                $this->form_validation->set_rules("description", "Shop's service", "trim|required");
            }
            if (FALSE === $this->form_validation->run()) {
                $data["alert"]["text"] = validation_errors();
                $data["alert"]["class"] = "error";
            } else {
                if (TRUE === $this->shop_model->createShopService($shop_id, $id)) {
                    if ($id > 0) {
                        $this->session->set_flashdata("alert_text", "Shop's service description is successfully updated.");
                    } else {
                        $this->session->set_flashdata("alert_text", "New shop's service description is successfully add to these shop.");
                    }
                    $this->session->set_flashdata("alert_class", "success");
                    redirect("shop/editShop/{$shop_id}");
                } else {
                    $data['alert']['text'] = "Error occured.Please try again.";
                    $data['alert']['class'] = "error";
                }
            }
        }
        $data['shop'] = $this->shop_model->getShopDetails($shop_id);
        if (FALSE === $data['shop']) {
            show_error("Invalid shop id.");
        }
        $data['main_content'] = "dashboard/edit_shop";
        $this->load->view("includes/backend_template", $data);
    }

    public function createReview($shop_id) {
        if (!ctype_digit($shop_id) || 0 == $shop_id) {
            show_error("Invalid shop id.");
        }
        $this->load->model("shop_model");
        if ($this->input->post()) {
            $id = 0;
            $this->load->library("form_validation");
            if (array_key_exists("editReview", $this->input->post())) {
                $id = $this->input->post("editReview");
                $this->form_validation->set_rules("description_{$id}", "Shop's review", "trim|required");
            } else {
                $this->form_validation->set_rules("description", "Shop's review", "trim|required");
            }
            if (FALSE === $this->form_validation->run()) {
                $data["alert"]["text"] = validation_errors();
                $data["alert"]["class"] = "error";
            } else {
                if (TRUE === $this->shop_model->createShopReview($shop_id, $id)) {
                    if ($id > 0) {
                        $this->session->set_flashdata("alert_text", "Shop's review is successufully updated");
                    } else {
                        $this->session->set_flashdata("alert_text", "New shop's review is successfully created.");
                    }
                    $this->session->set_flashdata("alert_class", "success");
                    redirect("shop/editShop/{$shop_id}");
                } else {
                    $data['alert']['text'] = "Error occured.Please try again.";
                    $data['alert']['class'] = "error";
                }
            }
        }
        $data['shop'] = $this->shop_model->getShopDetails($shop_id);
        if (FALSE === $data['shop']) {
            show_error("Invalid shop id.");
        }
        $data['main_content'] = "dashboard/edit_shop";
        $this->load->view("includes/backend_template", $data);
    }

    public function createSchedule($shop_id = 0) {
        $this->load->model("shop_model");
        $this->load->model("category_model");
        if ($this->input->post()) {
            $post = $this->input->post();
            $this->load->library("form_validation");
            $this->form_validation->set_rules("schedule_type", "Schedule Type", "trim|required");
            switch ($post["schedule_type"]) {
                case DATE_RANGE:
                    $this->form_validation->set_rules("start_date", "Starting Date", "trim|required");
                    $this->form_validation->set_rules("end_date", "Ending Date", "trim|required");
                    $this->form_validation->set_rules("start_time", "Starting Time", "trim|required");
                    $this->form_validation->set_rules("end_time", "Ending Time", "trim|required");
                    break;
                case ALL_DAY:
                case EACH_DAY:
                case SP_DATE:
                    $this->form_validation->set_rules("sp_start_time", "Start Time", "trim|required");
                    $this->form_validation->set_rules("sp_end_time", "End Time", "trim|required");
                    if (ALL_DAY == $post['schedule_type']) {
                        $this->form_validation->set_rules("check_date[]", "All Day", "trim|required");
                    } else if (EACH_DAY == $post['schedule_type']) {
                        $this->form_validation->set_rules("radio_date", "Each Day", "trim|required");
                    } else if (SP_DATE == $post['schedule_type']) {
                        $this->form_validation->set_rules("sp_date", "Date", "trim|required");
                    }
                    break;
            }
            $this->form_validation->set_rules("note", "Schedule Note", "trim");
            if (FALSE === $this->form_validation->run()) {
                $data['alert']['text'] = validation_errors();
                $data['alert']['class'] = "error";
            } else {
                if (TRUE === $this->shop_model->createShopSchedule($shop_id)) {
                    $this->session->set_flashdata("alert_text", "New shop's schedule is successfully added.");
                    $this->session->set_flashdata("alert_class", "success");
                    redirect("shop/editShop/{$shop_id}");
                } else {
                    $data['alert']['text'] = "Error occured.Please try again.";
                    $data['alert']['class'] = "error";
                }
            }
        }
        $data['shop'] = $this->shop_model->getShopDetails($shop_id);
        if (FALSE === $data['shop']) {
            show_error("Invalid shop id.");
        }
        // Image CRUD
        $this->load->library('image_CRUD');
        $this->image_crud = new image_CRUD();
        // customize the photo upload url
        $this->image_crud->set_actionUrl('addPhoto');
        $data['photoOutput'] = getPhotoLibrary($this->image_crud);

        $this->load->model('brand_model');
        $data['brandList'] = $this->brand_model->getBrands();
        $data['main_content'] = "dashboard/shop_dashboard";
        $data['cur_page'] = "editShop";
        $this->load->view("includes/backend_template", $data);
    }

    /** Delete * */
    public function search() {
        if ($this->input->post()) {
            $post = $this->input->post();
// hidden url for 
            $query_array = array(
                'keyword' => array_key_exists('keyword', $post) && !empty($post['keyword']) ? $post['keyword'] : ''
            );
            $query_id = $this->input->save_query($query_array);
            redirect($post['url'] . $query_id);
        }
    }

}
