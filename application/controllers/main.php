<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class main extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */


    function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('email');
        $this->load->helper('url');
    }

    public function index()
    {
        $this->load->view('includes/header');
        // $this->load->view('main/index');
        $this->load->view('post/list_side');
        $this->load->view('post/index');
        $this->load->view('post/footer');
        $this->load->view('includes/footer');
    }

    public function welcome()
    {
        $this->load->view('includes/header');
         $this->load->view('main/index');
        $this->load->view('includes/footer');
    }

    public function login()
    {
        $this->load->view('main/login');
    }

    public function register()
    {
        $this->load->view('main/register');
    }
}
