<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
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
        // $this->load->library('session');
        // $this->load->library('form_validation');
        // $this->load->database();
        $this->load->helper('url');
        $this->uri->segment(1);
        //load lang
        //$this->lang->load('user', $this->config->item('language'));
        //$this->lang->load('general', $this->config->item('language'));
        $this->lang->load('auth', $this->config->item('language'));
    }

    public function eee($userid = NULL)
    {
        $data['userid'] = $userid;
        $this->_render_page('user/view_profile', $data);
    }

    public function login()
    {
        $this->_render_page('auth/login', $this->data);
    }

    public function register()
    {
        $this->load->view('main/register');
    }

    public function favourite($userid = NULL)
    {
        $this->_render_page('user/favourite');
    }

    public function mypost()
    {
        $this->_render_page('user/mypost');
    }

    // edit a user
    public function index($userid = NULL)
    {
        $this->data['title'] = $this->lang->line('edit_user_heading');
        //    if (!$this->ion_auth->logged_in()) {
        //      redirect('auth', 'refresh');
        //  }

        $user = $this->ion_auth->user($userid)->row();
        $this->data['user'] = $user;
        // display the edit user form
        $this->data['csrf'] = $this->_get_csrf_nonce();

        $this->_render_page('user/view_profile', $this->data);
    }

    public function edit($userid = NULL)
    {
        $this->data['title'] = $this->lang->line('edit_user_heading');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        }

        $user = $this->ion_auth->user()->row();
        $id = $user->id;
        $groups = $this->ion_auth->groups()->result_array();
        $currentGroups = $this->ion_auth->get_users_groups()->result();

        // validate form input
        $this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'required');
        $this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'required');
        // $this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'required');
        $this->form_validation->set_rules('email', 'email', 'required');
        // $this->form_validation->set_rules('company', $this->lang->line('edit_user_validation_company_label'), 'required');

        if (isset($_POST) && !empty($_POST)) {
            // do we have a valid request?
           /* if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id')) {
                show_error($this->lang->line('error_csrf'));
            }*/

            // update the password if it was posted
            if ($this->input->post('password')) {
                $this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
                $this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
            }

            if ($this->form_validation->run() === TRUE) {
                $data = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    //'company' => $this->input->post('company'),
                    //'phone' => $this->input->post('phone'),
                    'email' => $this->input->post('email')
                );

                // update the password if it was posted
                if ($this->input->post('password')) {
                    $data['password'] = $this->input->post('password');
                }

                // check to see if we are updating the user
                if ($this->ion_auth->update($user->id, $data)) {
                    // redirect them back to the admin page if admin, or to the base url if non admin
                    $this->session->set_flashdata('message', $this->ion_auth->messages());
                    //redirect('/', 'refresh');
                } else {
                    // redirect them back to the admin page if admin, or to the base url if non admin
                    $this->session->set_flashdata('message', $this->ion_auth->errors());
                    // redirect('/', 'refresh');
                }

            }
        }

        // display the edit user form
       // $this->data['csrf'] = $this->_get_csrf_nonce();

        // set the flash data error message if there is one
        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

        // pass the user to the view
        $this->data['user'] = $user;
        $this->data['groups'] = $groups;
        $this->data['currentGroups'] = $currentGroups;

        // current user
        $this->data['userid'] = $userid;

        $this->data['first_name'] = array(
            'name' => 'first_name',
            'id' => 'first_name',
            'type' => 'text',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('first_name', $user->first_name),
        );
        $this->data['last_name'] = array(
            'name' => 'last_name',
            'id' => 'last_name',
            'type' => 'text',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('last_name', $user->last_name),
        );
        $this->data['phone'] = array(
            'name' => 'phone',
            'id' => 'phone',
            'type' => 'text',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('phone', $user->phone),
        );
        $this->data['email'] = array(
            'name' => 'email',
            'id' => 'email',
            'type' => 'email',
            'required' => '',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('email', $user->email),
        );
        $this->data['password'] = array(
            'name' => 'password',
            'id' => 'password',
            'class' => 'form-control',
            'type' => 'password'
        );
        $this->data['password_confirm'] = array(
            'name' => 'password_confirm',
            'id' => 'password_confirm',
            'class' => 'form-control',
            'type' => 'password'
        );

        $this->_render_page('user/edit_profile', $this->data);
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
