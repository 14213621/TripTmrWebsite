<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends CI_Model
{
    /*
     var $title   = '';
     var $content = '';
     var $date    = '';
    */

    public $table_name = 'category';

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function insert($data)
    {
        //  $data['update_at'] = date("Y-m-d H:i:s");
        //  $data['create_at'] = date("Y-m-d H:i:s");
        $this->db->insert($this->table_name, $data);
        return $this->db->insert_id();
    }

    public function select($id)
    {
        $query = $this->db->get_where($this->table_name, array('id' => $id));
        return $query->row();
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update($this->table_name, $data);
    }

    public function get_all($limit = 999)
    {
        if ($limit != 999)
            $this->db->order_by('count', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get($this->table_name);
        return $query->result();
    }


    public function base_insert($table, $data)
    {
        $data['update_at'] = date("Y-m-d H:i:s");
        $data['create_at'] = date("Y-m-d H:i:s");
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function base_select($table, $id)
    {
        $query = $this->db->get_where($table, array('id' => $id));
        return $query->row();
    }

    public function base_update($table, $id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update($table, $data);
    }

}