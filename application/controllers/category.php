<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Category extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }
    
    public function create($id = 0) {
        if (IS_AJAX) {
            if ($this->input->post()) {
                $this->load->library("form_validation");
                $this->form_validation->set_rules("name", "Main Category Name", "trim|required|is_unique[main_categories.name]");
                if (FALSE === $this->form_validation->run()) {
                    echo json_encode(array('alert' => false, 'message' => validation_errors()));
                } else {
                    $this->load->model("category_model");
                    if (TRUE === $this->category_model->createMainCategory($this->input->post(), $id)) {
                        if ($id > 0) {
                            $this->session->set_flashdata("alert_text", "Main category is successfully updated.");
                            $this->session->set_flashdata("alert_class", "success");
                        } else {
                            $this->session->set_flashdata("alert_text", "Main category is successfully created.");
                            $this->session->set_flashdata("alert_class", "success");
                        }
                        echo json_encode(array('alert' => true));
                    } else {
                        echo json_encode(array('alert' => true, 'message' => "Error occured!.Please try again"));
                    }
                }
            } else {
                $data = array();
                $data['category'] = array();
                if ($id > 0) {
                    $data["category"] = $this->db->where("id", $id)
                            ->get("main_categories")
                            ->first_row("array");
                }
                $data['url'] = "category/create/{$id}";
                echo $this->load->view("dashboard/create_main_category", $data);
            }
        }
    }

    public function mainCategoryList($query_id = 0, $offset = 0) {
        $this->input->load_query($query_id);
        $data = array();
        $this->load->model("category_model");
        $data['mainCategoryList'] = $this->category_model->mainCategorySearch($data, RECORDS_PER_PAGE, $offset);
        $this->load->library('pagination');
        $config['base_url'] = base_url() . "category/mainCategoryList/{$query_id}";
        $config['uri_segment'] = 4;
        $config['total_rows'] = $data['mainCategoryList']['total_records'];
        $config['num_links'] = 3;
        $config['per_page'] = RECORDS_PER_PAGE;
// Twitter bootstrap markup
        $config = array_merge($config, $this->config->item('pagination_style'));
// bootstrap pagination style
        $this->pagination->initialize($config);
        $data['pagination_links'] = $this->pagination->create_links();
        $data['main_content'] = "dashboard/main_category_list";
        $this->load->view("includes/backend_template", $data);
    }

    /*     * ***         Category CRUD      **** */

    public function createCategory($shop_id = 0) {
        if (!ctype_digit($shop_id) || 0 == $shop_id) {
            show_error("Invalid shop id.");
        }
        $this->load->model("category_model");
        if ($this->input->post()) {
            $this->load->library("form_validation");
            $this->form_validation->set_rules("name", "Category Name", "trim|required");
            $this->form_validation->set_rules("main_category", "Main Category", "trim|required");
            $this->form_validation->set_rules("brand", "Brand", "trim");
            $this->form_validation->set_rules("status", "Status", "trim|required");
            if (FALSE === $this->form_validation->run()) {
                $data['alert']['text'] = validation_errors();
                $data['alert']['class'] = "error";
            } else {
                $this->load->model("category_model");
                if (TRUE === $this->category_model->createCategory($shop_id)) {
                    $this->session->set_flashdata("alert_text", "New category is successfully created.");
                    $this->session->set_flashdata("alert_class", "success");
                    redirect("category/editCategory/{$shop_id}/{$this->db->insert_id()}");
                } else {
                    $data['alert']['text'] = "Error Occured!.Please try again.";
                    $data["alert"]['class'] = "error";
                }
            }
        }
        $data['mainCategories'] = $this->category_model->getMainCategories();
        $data['mainCategories'] = array('' => "Select Main Category") + $data['mainCategories'];
        // $data['mainCategories'] = array_merge(array("Select Main Category"), $data['mainCategories']);
        $this->load->model("brand_model");
        $data['brands'] = $this->brand_model->getBrands();
        $data['brands'] = array('' => "Select Brand") + $data['brands'];
        $data['shop_id'] = $shop_id;
        $data['main_content'] = "dashboard/create_category";
        $this->load->view("includes/backend_template", $data);
    }

    public function editCategory($shop_id, $category_id = 0) {
        if (!ctype_digit($category_id) || 0 == $category_id) {
            show_error("Invalid shop id.");
        }
        if ($this->input->post()) {
            $this->load->library("form_validation");
            $this->form_validation->set_rules("name", "Category Name", "trim|required");
            $this->form_validation->set_rules("main_category", "Main Category", "trim|required");
            $this->form_validation->set_rules("brand", "Brand", "trim");
            $this->form_validation->set_rules("status", "Status", "trim|required");
            if (FALSE === $this->form_validation->run()) {
                $data['alert']['text'] = validation_errors();
                $data['alert']['class'] = "error";
            } else {
                $this->load->model("category_model");
                if (TRUE === $this->category_model->createCategory($shop_id, $category_id)) {
                    $this->session->set_flashdata("alert_text", "Category is successfully updated.");
                    $this->session->set_flashdata("alert_class", "success");
                    redirect("category/editCategory/{$shop_id}/{$category_id}");
                } else {
                    $data['alert']['text'] = "Error Occured!.Please try again.";
                    $data["alert"]['class'] = "error";
                }
            }
        }
        $this->load->model("category_model");
        $data['category'] = $this->category_model->getCategoryDetails($category_id);
        if (FALSE == $data['category']) {
            show_error("Invalid category id");
        }
        $data['mainCategories'] = $this->category_model->getMainCategories();
        $data['mainCategories'] = array('' => "Select Main Category") + $data['mainCategories'];
        $this->load->model("brand_model");
        $data['brands'] = $this->brand_model->getBrands();
        $data['brands'] = array('' => "Select Brand") + $data['brands'];
        $data['main_content'] = "dashboard/edit_category";
        $this->load->view("includes/backend_template", $data);
    }

    public function categoryList($shop_id = 0, $query_id = 0, $offset = 0) {
        $this->input->load_query($query_id);
        $data = array();
        $this->load->model("category_model");
        $data['categoryList'] = $this->category_model->categorySearch($data, RECORDS_PER_PAGE, $offset);
        $this->load->library('pagination');
        $config['base_url'] = base_url() . "dashboard/categoryList/$shop_id/{$query_id}";
        $config['uri_segment'] = 4;
        $config['total_rows'] = $data['categoryList']['total_records'];
        $config['num_links'] = 3;
        $config['per_page'] = RECORDS_PER_PAGE;
// Twitter bootstrap markup
        $config = array_merge($config, $this->config->item('pagination_style'));
// bootstrap pagination style
        $this->pagination->initialize($config);
        $data['pagination_links'] = $this->pagination->create_links();
        $data['mainCategories'] = $this->category_model->getMainCategories();
        $this->load->model("brand_model");
        $data['brands'] = $this->brand_model->getBrands();
        $data['shop_id'] = $shop_id;
        $data['main_content'] = "dashboard/category_list";
        $this->load->view("includes/backend_template", $data);
    }

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
