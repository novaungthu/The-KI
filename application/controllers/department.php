<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Department extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function create($id = 0) {
        if (IS_AJAX) {
            if ($this->input->post()) {
                $this->load->library("form_validation");
                $this->form_validation->set_rules("name", "Department Name", "trim|required|is_unique[main_categories.name]");
                if (FALSE === $this->form_validation->run()) {
                    echo json_encode(array('alert' => false, 'message' => validation_errors()));
                } else {
                    $this->load->model("department_model");
                    if (TRUE === $this->department_model->createDepartment($this->input->post(), $id)) {
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
                $data['department'] = array();
                if ($id > 0) {
                    $data["department"] = $this->db->where("id", $id)
                            ->get("departments")
                            ->first_row("array");
                }
                $data['url'] = "department/create/{$id}";
                echo $this->load->view("dashboard/create_department", $data);
            }
        }
    }

    public function departmentList($query_id = 0, $offset = 0) {
        $this->input->load_query($query_id);
        $data = array();
        $this->load->model("department_model");
        $data['departmentList'] = $this->department_model->search($data, RECORDS_PER_PAGE, $offset);
        $this->load->library('pagination');
        $config['base_url'] = base_url() . "department/departmentList/{$query_id}";
        $config['uri_segment'] = 4;
        $config['total_rows'] = $data['departmentList']['total_records'];
        $config['num_links'] = 3;
        $config['per_page'] = RECORDS_PER_PAGE;
// Twitter bootstrap markup
        $config = array_merge($config, $this->config->item('pagination_style'));
// bootstrap pagination style
        $this->pagination->initialize($config);
        $data['pagination_links'] = $this->pagination->create_links();
        $data['main_content'] = "dashboard/department_list";
        $this->load->view("includes/backend_template", $data);
    }

}

?>