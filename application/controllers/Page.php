<?php
/**
 * Created by PhpStorm.
 * User: ducto
 * Date: 9/29/2018
 * Time: 12:38 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Page extends Public_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = [];
        $data['main_content'] = $this->load->view($this->template_path . 'home/index', $data, TRUE);
        $this->load->view($this->template_main, $data);
    }
    public function _404(){
        $this->output->set_status_header('404');
        $data['main_content'] = $this->load->view($this->template_path . 'page/_404', [], TRUE);
        $this->load->view($this->template_main, $data);
    }
}
