<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Post_model extends CI_Model
{
    /*
     var $title   = '';
     var $content = '';
     var $date    = '';
    */

    public $table_name = 'post';

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function insert($data)
    {
        $data['update_at'] = date("Y-m-d H:i:s");
        $data['create_at'] = date("Y-m-d H:i:s");
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

    public function delete($id)
    {
        $this->db->delete($this->table_name, array("id" => $id));
        return 1;
    }

    public function get_all()
    {
        $query = $this->db->get($this->table_name);
        return $query->result();
    }

    public function query($query, $limit, $offset, $direct = null, $uid = null, $where = null)
    {
        if ($uid != null) {
            $query = $this->db->query("SELECT * FROM `post` where `post`.`user_id` = " . $uid);
        } else if ($direct != null) { // for bookmarked post
            $query = $this->db->query("SELECT * FROM `post`, `bookmark`  where `post`.`id` = `bookmark`.`pid` and `bookmark`.`uid` = " . $direct);
            //    $this->db->get_where($this->table_name, array("p."), $limit, $offset);
        } else {
            $this->db->order_by('update_at', 'DESC');
            if ($where != null) {
                foreach ($where as $option) {
                    $this->db->where($option);
                }
            }
            $query = $this->db->get_where($this->table_name, $query, $limit, $offset);
        }
        return $query->result();
    }

    public function getBookmark($uid, $pid)
    {
        $query = $this->db->get_where("bookmark", array('uid' => $uid, 'pid' => $pid));
        if ($query->row()) {
            return 1;
        } else {
            return -1;
        }
    }

    public function getLike($uid, $pid)
    {
        $query = $this->db->get_where("likes", array('uid' => $uid, 'pid' => $pid));
        if ($query->row()) {
            return 1;
        } else {
            return -1;
        }
    }

    public function like($uid, $pid)
    {
        $query = $this->db->get_where("likes", array('uid' => $uid, 'pid' => $pid));
        if ($query->row()) {
            $this->db->delete("likes", array('uid' => $uid, 'pid' => $pid));
            return 0;
        } else {
            $this->db->insert("likes", array('uid' => $uid, 'pid' => $pid));
            return 1;
        }
    }

    public function bookmark($uid, $pid)
    {
        $query = $this->db->get_where("bookmark", array('uid' => $uid, 'pid' => $pid));
        if ($query->row()) {
            $this->db->delete("bookmark", array('uid' => $uid, 'pid' => $pid));
            return 0;
        } else {
            $this->db->insert("bookmark", array('uid' => $uid, 'pid' => $pid));
            return 1;
        }
    }


    public function base_insert($table, $data)
    {
        //$data['update_at'] = date("Y-m-d H:i:s");
        // $data['create_at'] = date("Y-m-d H:i:s");
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