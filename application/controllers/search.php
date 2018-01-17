<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller
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

        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper('url');
        $this->load->helper('my_web_helper');
        $this->uri->segment(1);
        $this->lang->load('auth', $this->config->item('language'));
        $this->load->model('Post_model');
        $this->load->model('Category_model');
        //$this->lang->load('user', $this->config->item('language'));
        //$this->lang->load('general', $this->config->item('language'));
    }

    public function index()
    {
        $output['csrf'] = true;
        $c = 0;
        $list = array();
        $text = $this->input->get("k");
        $rs = $this->db->query("select * from post where title like '%" . $text . "%'");
        foreach ($rs->result() as $post) {
            if ($c > 6) break;
            $c++;
            array_push($list, array("name" => $post->title, "type" => "Post", "herf" => "/post/show/" . $post->id));
        }
        $c = 0;
        $rs = $this->db->query("select * from category where name like '%" . $text . "%'");
        foreach ($rs->result() as $cate) {
            if ($c > 2) break;
            $c++;
            array_push($list, array("name" => $cate->name, "type" => "Category", "herf" => "/post?category_id=" . $cate->id));
        }
        $rs = $this->db->query("select * from users where username like '%" . $text . "%'");
        foreach ($rs->result() as $user) {
            if ($c > 2) break;
            $c++;
            array_push($list, array("name" => $user->username, "type" => "Author", "herf" => "/user?user_id=" . $user->id));
        }
        json_output($list);
    }


    public function _get_csrf_nonce()
    {
        $this->load->helper('string');
        $key = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_flashdata('csrfkey', $key);
        $this->session->set_flashdata('csrfvalue', $value);

        return array($key => $value);
    }

    public function _valid_csrf_nonce()
    {
        $csrfkey = $this->input->post($this->session->flashdata('csrfkey'));
        if ($csrfkey && $csrfkey == $this->session->flashdata('csrfvalue')) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function _render_page($view, $data = null, $returnhtml = false)//I think this makes more sense
    {

        $this->viewdata = $data;

        $this->load->view('includes/header');
        $view_html = $this->load->view($view, $this->viewdata, $returnhtml);
        $this->load->view('includes/footer');

        if ($returnhtml) return $view_html;//This will return html on 3rd argument being true
    }

}
