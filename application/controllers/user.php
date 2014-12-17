<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
    }

    function index() {
        $this->login();
    }

    function login() {
        $data = array();
        // add google recaptcha
      //  $this->load->library('recaptcha');

        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('email', "Email", 'trim|required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            //$this->recaptcha->recaptcha_check_answer();
            if (FALSE == $this->form_validation->run()) {
                $data['alert']['text'] = $this->recaptcha->getError();
                $data['alert']['class'] = 'class';
            } else {
                $result = $this->user_model->validate();
                if ($result) {
                    $this->session->set_flashdata('alert_text', 'Welcome!.');
                    $this->session->set_flashdata('alert_class', 'success');
                    // checking user
                    // redirect to other
                    if (ADMIN == $this->session->userdata("user_type")) {
                        redirect("shop/createShop/");
                    }
                } else {
                    $data['alert']['text'] = 'Invalid Email and Password.Please try again.';
                    $data['alert']['class'] = 'error';
                }
            }
        }
      //  $data['recaptcha_html'] = $this->recaptcha->recaptcha_get_html();
        $this->load->view('login', $data);
    }

    function updateProfile() {
        $data = array();
        $data['pwd_change_request'] = 0;
        if ($this->input->post()) {
            $this->load->library("form_validation");
            $this->form_validation->set_rules("name", "User Name", "trim|required");
            $this->form_validation->set_rules("email", "Email", "trim|required|valid_email");
            $this->form_validation->set_rules("status", "User Status", "trim|required");
            $email = $this->input->post("email");
            $changeEmail = false;
            if (!empty($email)) {
                $changeEmail = $this->session->userdata('tmp_email') ? $this->session->userdata('tmp_email') != $email ? true : false : false;
            }
            if ($changeEmail) {
                $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
            } else {
                $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            }
            // Update Password
            if ($this->input->post('password') || $this->input->post('cur_password') || $this->input->post('con_password')) {
                $data['pwd_change_request'] = 1;
                $this->form_validation->set_rules('cur_password', 'Current Password', 'trim|required');
                $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]|min_length[5]');
                $this->form_validation->set_rules('con_password', 'Confirm Password', 'trim|required|matches[password]|min_length[5]');
            }
            if (FALSE === $this->form_validation->run()) {
                $data['alert']['text'] = validation_errors();
                $data["alert"]["class"] = "error";
            } else {
                // check pasword
                if (($this->input->post('password') || $this->input->post('cur_password')) && !$this->user_model->password_check($this->session->userdata('tmp_email'), $this->input->post('cur_password'))) {
                    $data['alert']['text'] = 'Current Password is not correct.';
                    $data['alert']['class'] = 'error';
                } else {
                    $result = $this->user_model->updateProfile();
                    if ($result) {
                        $this->session->unset_userdata(array('tmp_email' => '')); // remove the temporary email address to session
                        $this->session->set_flashdata("alert_text", "Profile is successfully updated.");
                        $this->session->set_flashdata('alert_class', "success");
                        redirect("user/updateProfile/");
                    } else {
                        $data['alert']['text'] = 'Error Occured!.Please try again later.';
                        $data['alert']['class'] = 'error';
                    }
                }
            }
        }
        $user = $this->user_model->getUserProfile();
        if (isset($user['email']) && !empty($user['email'])) {
            $this->session->set_userdata('tmp_email', $user['email']);
        }
        $data['user'] = $user;
        $data['main_content'] = "update_profile";
        $this->load->view("includes/backend_template", $data);
    }

    function signUp() {
        $data = array();
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'First Name', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('password', 'User Password', 'trim|required|min_length[4]');
            $this->form_validation->set_rules("con_password", "Confirm Password", "trim|required|min_length[4]|matches[password]");
            $this->form_validation->set_rules("status", "User Status", "trim|required");
            if (FALSE == $this->form_validation->run()) {
                $data['alert']['text'] = validation_errors();
                $data['alert']['class'] = 'error';
            } else {
                $result = $this->user_model->signUp();
                if ($result) {
                    $this->session->set_flashdata('alert_text', 'New user successfully created.');
                    $this->session->set_flashdata('alert_class', 'success');
                    redirect("user/signUp/");
                } else {
                    $data['alert']['text'] = 'Error occured.Please try again later';
                    $data['alert']['class'] = 'error';
                }
            }
        }
        $data['page_title'] = "Create user";
        $data['main_content'] = "signup";
        $this->load->view('includes/backend_template', $data);
    }

    function userList($query_id = 0, $offset = 0) {
        $this->input->load_query($query_id);
        $data = array(
        );
        $this->load->model("user_model");
        $data['userList'] = $this->user_model->search($data, RECORDS_PER_PAGE, $offset);
        $this->load->library('pagination');
        $config['base_url'] = base_url() . "user/userList/{$query_id}";
        $config['uri_segment'] = 4;
        $config['total_rows'] = $data['userList']['total_records'];
        $config['num_links'] = 3;
        $config['per_page'] = RECORDS_PER_PAGE;
        // Twitter bootstrap markup
        $config = array_merge($config, $this->config->item('pagination_style'));
        // bootstrap pagination style
        $this->pagination->initialize($config);
        $data['pagination_links'] = $this->pagination->create_links();
        $data['main_content'] = "dashboard/user_list";
        $this->load->view("includes/backend_template", $data);
    }

    function forgot() {
        $data = array();
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            if (FALSE == $this->form_validation->run()) {
                $data['alert']['text'] = validation_errors();
                $data['alert']['class'] = 'error';
            } else {
                $this->load->model('user_model');
                if (false == $this->user_model->hasUserByEmail($this->input->post('email'))) {
                    $data['alert']['text'] = 'There is no email address at system.';
                    $data['alert']['class'] = 'error';
                } else {
                    $resetLink = $this->user_model->generateResetPasswordLink($this->input->post('email'));
                    echo "<pre>";
                    print_r($resetLink);
                    echo '</pre>';
                    exit;
                    $this->load->library('email');
                    $this->email->set_newline("\r\n");
                    $this->email->from(EMAIL_INFO_ADDRESS, EMAIL_INFO_NAME);
                    $this->email->to($this->input->post('email'));
                    $this->email->bcc(EMAIL_CONTACT_ADDRESS);
                    $this->email->subject(EMAIL_SUBJECT_RESET_PASSWD_SENT);
                    $this->email->message($resetLink);

                    if ($this->email->send()) {
                        $data['alert']['text'] = 'Reset password link has been sent to your email address.';
                        $data['alert']['class'] = 'success';
                    } else {
                        $data['error']['text'] = "Error occured during password reset link email sending";
                        $data['alert']['class'] = 'error';
                    }
                }
            }
        }
        $this->load->view('forgot', $data);
    }

    function reset_password($email = '', $code = '') {
        if (empty($email) || empty($code)) {
            $email = $this->session->userdata('reset_email');
            $code = $this->session->userdata('reset_code');
        }

        $this->load->model('user_model');
        if ($code != $this->user_model->generateResetPasswdCode(base64_decode(urldecode($email)))) {
            show_error('Invalid link');
        }

        if (empty($reset_email) || empty($reset_code)) {
            $this->session->set_userdata(array('reset_email' => $email, 'reset_code' => $code));
        }
        $this->load->view('reset_password_form');
    }

    // Password reset flow
    function process_reset_password() {
        $this->load->library('form_validation');
        // field name, error msg, validation rules
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
        $this->form_validation->set_rules('con_password', 'Confirm Password', 'trim|required|matches[password]');

        $email = $this->session->userdata('reset_email');
        $code = $this->session->userdata('reset_code');

        if (FALSE == $this->form_validation->run()) { // validation not passed
            $this->session->set_flashdata('alert_text', validation_errors());
            $this->session->set_flashdata('alert_class', 'error');
            $this->reset_password($email, $code);
            return;
        }

        $this->load->model('user_model');
        if ($code != $this->user_model->generateResetPasswdCode(base64_decode(urldecode($email)))) {
            show_error('Invalid link');
        }

        if ($query = $this->user_model->reset_password(base64_decode(urldecode($email)))) {
            $this->session->unset_userdata('reset_email');
            $this->session->unset_userdata('reset_code');

            $this->session->set_flashdata('alert_text', 'Password has been reset successfully.');
            $this->session->set_flashdata('alert_class', 'success');
            redirect('user');
        } else {
            $data['alert']['text'] = 'Error occurred. Please try again later.';
            $data['alert']['class'] = 'error';
            $this->load->view('reset_password_form', $data);
        }
    }

    // Verify The emai and code
    function verify($email, $code) {

        $email = base64_decode(urldecode($email));

        // validate email address
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            show_error('Invalid activation link');
        }


        if ($code === $this->user_model->generateActivationCode($email)) {
            if ($this->user_model->activate_user($email)) {
                // send welcome email
                $this->load->library('email');

                $this->email->set_newline("\r\n");
                $this->email->from(EMAIL_INFO_ADDRESS, EMAIL_INFO_NAME);
                $this->email->to($email);
                $this->email->bcc(EMAIL_CONTACT_ADDRESS);
                $this->email->subject(EMAIL_SUBJECT_WELCOME);
                $this->email->message('Your account is activated. Please proceed to login.');

                if ($this->email->send()) {
                    $this->session->set_flashdata('alert_text', '<strong>Account successfully activated.</strong> Please login.');
                    $this->session->set_flashdata('alert_class', 'success');
                    redirect('auth');
                } else {
                    show_error($this->email->print_debugger());
                }
            }
        }
        show_error('Invalid activation link');
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

    function logout() {
        // clear all the session data
        $this->session->sess_destroy();
        redirect('user', 'refresh');
    }

}

?>
