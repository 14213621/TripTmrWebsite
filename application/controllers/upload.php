<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
    }

    public function index()
    {
        $this->load->view('upload_form', array('error' => ' '));
    }

    public function do_upload()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '1000000000';
        $config['max_width'] = '1024000000';
        $config['max_height'] = '768000000';

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload()) {
            $response = 'Oversize File! Please re-upload.';
        } else {
            $data = $this->upload->data();
            $response = '<img src="' . base_url() . 'uploads/' . $data['file_name'] . '" style="width: 300px;" class="fr-fic fr-dib fr-draggable fr-fil">';
        }
        echo ($response);
    }

}
