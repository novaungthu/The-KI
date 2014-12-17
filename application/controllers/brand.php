<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Brand extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function createBrand() {
        if ($this->input->post()) {
            $this->load->library("form_validation");
            $this->form_validation->set_rules("name", "Brand Name", "trim|required");
            $this->form_validation->set_rules("brand_type", "Brand Type", "trim|required");
            $this->form_validation->set_rules("country", "Country", "trim");
            $this->form_validation->set_rules("is_designer", "Is Designer's Brand", "trim|required");
            $this->form_validation->set_rules("status", "Status", "trim|required");
            if (FALSE === $this->form_validation->run()) {
                $data['alert']['text'] = validation_errors();
                $data['alert']['class'] = "error";
            } else {
                $this->load->model("brand_model");
                if (TRUE === $this->brand_model->createBrand()) {
                    $this->session->set_flashdata("alert_text", "New brand is successfully created.");
                    $this->session->set_flashdata("alert_class", "success");
                    redirect("brand/createBrand/");
                } else {
                    $data['alert']['text'] = "Error occured!. Please try again.";
                    $data['alert']['class'] = "error";
                }
            }
        }
        $data['main_content'] = "dashboard/create_brand";
        $this->load->view("includes/backend_template", $data);
    }

    public function editBrand($brand_id = 0) {
         if ($this->input->post()) {
            $this->load->library("form_validation");
            $this->form_validation->set_rules("name", "Brand Name", "trim|required");
            $this->form_validation->set_rules("brand_type", "Brand Type", "trim|required");
            $this->form_validation->set_rules("country", "Country", "trim");
            $this->form_validation->set_rules("is_designer", "Is Designer's Brand", "trim|required");
            $this->form_validation->set_rules("status", "Status", "trim|required");
            if (FALSE === $this->form_validation->run()) {
                $data['alert']['text'] = validation_errors();
                $data['alert']['class'] = "error";
            } else {
                $this->load->model("brand_model");
                if (TRUE === $this->brand_model->createBrand($brand_id)) {
                    $this->session->set_flashdata("alert_text", "New brand is successfully created.");
                    $this->session->set_flashdata("alert_class", "success");
                    redirect("brand/createBrand/");
                } else {
                    $data['alert']['text'] = "Error occured!. Please try again.";
                    $data['alert']['class'] = "error";
                }
            }
        }
        $this->load->model("brand_model");
        $data['brand'] = $this->brand_model->getBrandDetails($brand_id);
        $data['main_content'] = "dashboard/edit_brand";
        $this->load->view("includes/backend_template", $data);
    }

    public function brandList($query_id = 0, $offset = 0) {
        $this->input->load_query($query_id);
        $data = array();
        $this->load->model("brand_model");
        $data['brandList'] = $this->brand_model->search($data, RECORDS_PER_PAGE, $offset);
        $this->load->library('pagination');
        $config['base_url'] = base_url() . "brand/brandList/{$query_id}";
        $config['uri_segment'] = 4;
        $config['total_rows'] = $data['brandList']['total_records'];
        $config['num_links'] = 3;
        $config['per_page'] = RECORDS_PER_PAGE;
// Twitter bootstrap markup
        $config = array_merge($config, $this->config->item('pagination_style'));
// bootstrap pagination style
        $this->pagination->initialize($config);
        $data['pagination_links'] = $this->pagination->create_links();
        $data['main_content'] = "dashboard/brand_list";
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
