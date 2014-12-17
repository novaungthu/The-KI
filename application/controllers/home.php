<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
       
    }
    function index() {
       $data['page']='pages/online';
       $data['title']='The Ki';
       $this->load->view('includes/template',$data);
    }
    
    public function online() {
       $data['page']='pages/online';
       $data['title']='The Ki';
       $this->load->view('includes/template',$data);
    }
    public function instore() {
       $data['page']='pages/instore';
       $data['title']='The Ki';
       $this->load->view('includes/template',$data);
    }
    public function branchshop() {
       $data['page']='pages/branchshop';
       $data['title']='The Ki';
       $this->load->view('includes/template',$data);
    }
    
}
