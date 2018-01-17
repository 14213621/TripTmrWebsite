<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $login_check_function = array(
            "create",
            "createPost",
            "commentPost"
        );
        $this->load->helper('form');
        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper('url');
        $this->load->helper('my_web_helper');
        $this->uri->segment(1);
        $this->lang->load('auth', $this->config->item('language'));
        $this->load->model('Post_model');
        $this->load->model('Category_model');

        // $this->login_check($login_check_function);
    }

    public function search()
    {
        $output['csrf'] = true;
        $c = 0;
        $list = array();
        $text = $this->input->post("k");
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
            array_push($list, array("name" => $user->username, "type" => "Author", "herf" => "/post?user_id=" . $user->id));
        }
        echo 123;
        json_output($list);
    }

    public function index()
    {
        $category_id = $this->input->get('category_id', TRUE);
        $data = array(
            'title' => 'Home',
            'category_id' => $category_id
        );
        $this->_render_page('post/index', $data);
    }


    public function list($post_id)
    {
        $this->load->helper('form');
        $post = $this->Post_model->select($post_id);
        $post->read += 1;
        $update = array(
            'read' => $post->read
        );
        $this->Post_model->update($post->id, $update);

        $post->category = $this->Category_model->select($post->category_id);
        $post->user = $this->ion_auth->user($post->user_id)->row();
        $data = array(
            'title' => $post->title,
            'post' => $post);
        $this->_render_page('post/show', $data);
    }

    public function show($post_id)
    {
        $this->load->helper('form');
        $post = $this->Post_model->select($post_id);
        $post->read += 1;
        $update = array(
            'read' => $post->read
        );
        $this->Post_model->update($post->id, $update);

        $post->category = $this->Category_model->select($post->category_id);
        $post->user = $this->ion_auth->user($post->user_id)->row();
        if ($this->ion_auth->logged_in()) {
            $user = $this->ion_auth->user()->row();
            $post->bookmarked = $this->Post_model->getBookmark($user->user_id, $post->id);
            $post->liked = $this->Post_model->getLike($user->user_id, $post->id);
        } else {
            $post->liked = -1;
            $post->bookmarked = -1;
        }

        $post->commentsNum = $this->db->query("Select * from comment where post_id = " . $post->id)->num_rows();;
        $post->likeNum = $this->db->query("Select * from likes where pid = " . $post->id)->num_rows();
        $post->bookmarkNum = $this->db->query("Select * from bookmark where pid = " . $post->id)->num_rows();

        $data = array(
            'title' => $post->title,
            'post' => $post);
        $this->_render_page('post/show', $data);
    }

    public function category()
    {
        $this->load->model('Category_model');
        $categories = $this->Category_model->get_all(5);
        $data = array(
            'categories' => $categories);
        $categories_list = $this->load->view('post/category', $data, TRUE);

        $output = array(
            'state' => true,
            'categories_list' => $categories_list
        );
        json_output($output);

    }

    public function comment()
    {
        $this->load->model('Comment_model');
        $post_id = $this->input->get('post_id', TRUE);
        $comments = $this->Comment_model->getByPost($post_id);
        if ($comments) {
            foreach ($comments as $comment) {
                $comment->user = $this->ion_auth->user($comment->user_id)->row();
            }
        }
        $data = array(
            'comments' => $comments);
        $comments_list = $this->load->view('post/comment', $data, TRUE);

        $output = array(
            'state' => true,
            'comments_list' => $comments_list
        );
        json_output($output);

    }

    public function thread()
    {
        $limit = $this->input->get('limit')??10;
        $page = $this->input->get('page', TRUE);
        if ($page) {
            $offest = ($page - 1) * $limit;
        } else {
            $offest = 0;
            $page = 1;
        }
        $user_id = $this->input->get('user_id', TRUE);
        $category_id = $this->input->get('category_id', TRUE);
        $userpost = $this->input->get('userpost', TRUE);
        $mypost = $this->input->get('mypost', TRUE);
        $maxprice = $this->input->get('maxprice', TRUE);
        $minprice = $this->input->get('minprice', TRUE);
        $maxday = $this->input->get('maxday', TRUE);
        $minday = $this->input->get('minday', TRUE);
        $orderby = $this->input->get('orderby', TRUE);
        $options = null;

        $this->load->model('Post_model');
        $this->load->model('Category_model');

        $query = array();
        if ($user_id) {
            $query['user_id'] = $user_id;
        }
        if ($category_id) {
            $query['category_id'] = $category_id;
        }

        $categories = $this->Category_model->get_all();
        if ($userpost)
            $posts = $this->Post_model->query($query, $limit, $offest, $userpost);
        else if ($mypost)
            $posts = $this->Post_model->query($query, $limit, $offest, null, $mypost);
        else {
            if ($orderby) {
                switch ($orderby) {
                    case "default":
                    case "latest":
                        $this->db->order_by('update_at', 'DESC');
                        break;
                    case "oldest":
                        $this->db->order_by('update_at', 'ASC');
                        break;
                    case "highcost":
                        $this->db->order_by('price', 'DESC');
                        break;
                    case "lowcost":
                        $this->db->order_by('price', 'ASC');
                        break;
                }
            } else
                $this->db->order_by('update_at', 'DESC');

            if ($maxprice == 20000) {
                $this->db->where('price >= ', $minprice);
            } else {
                $this->db->where('price >= ', $minprice);
                $this->db->where('price <= ', $maxprice);
            }
            if ($maxday == 7) {
                $this->db->where('day >= ', $minday);
            } else {
                $this->db->where('day >= ', $minday);
                $this->db->where('day <= ', $maxday);
            }

            if ($user_id) $this->db->where("user_id", $user_id);
            if ($category_id) $this->db->where("category_id", $category_id);
            $this->db->limit($limit, $offest);
            //$this->db->get("post");
            // echo $this->db->last_query();
            //exit;
            $posts = $this->db->get("post")->result();
            //$query = $this->db->get_where($this->table_name, $query, $limit, $offset);
        }
        // $posts = $this->Post_model->query($query, $limit, $offest, null, null, $options);

        foreach ($categories as $key => $value) {
            $_categories[$value->id] = $value;
        }
        foreach ($posts as $post) {
            $post->category = $_categories[$post->category_id];
            $post->user = $this->ion_auth->user($post->user_id)->row();
            if ($this->ion_auth->logged_in()) {
                $user = $this->ion_auth->user()->row();
                $post->bookmarked = $this->Post_model->getBookmark($user->user_id, $post->id);
                $post->liked = $this->Post_model->getLike($user->user_id, $post->id);
                // echo "Select count(*) from comment where user_id = " . $user->user_id . " and post_id = "  . $post->id; exit;
            } else {
                $post->liked = -1;
                $post->bookmarked = -1;
            }
            $post->commentsNum = $this->db->query("Select * from comment where post_id = " . $post->id)->num_rows();;
            $post->bookmarkNum = $this->db->query("Select * from likes where pid = " . $post->id)->num_rows();;
            $post->likeNum = $this->db->query("Select * from bookmark where pid = " . $post->id)->num_rows();;

        }


        $data = array(
            'posts' => $posts,
            'page' => $page,
            'user_id' => $user_id,
            'category_id' => $category_id
        );
        $posts_list = $this->load->view('post/thread', $data, TRUE);


        $output = array(
            'state' => true,
            'posts_list' => $posts_list
        );
        json_output($output);
    }

    public function getBookmark($uid, $pid)
    {
        $query = $this->db->get_where("bookmark", array('uid' => $uid, 'pid' => $pid));
        if ($query->row()) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function bookmark($uid, $pid)
    {
        //$this->db->where("id");
        echo $this->Post_model->bookmark($uid, $pid);
    }

    public function like($uid, $pid)
    {
        //$this->db->where("id");
        echo $this->Post_model->like($uid, $pid);
    }

    public function create()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        }
        $this->load->helper('form');
        $post_id = $this->input->get('post_id', TRUE);
        $this->load->model('Post_model');
        $this->load->model('Category_model');

        $error = false;
        $post = null;
        if ($post_id) {
            $post = $this->Post_model->select($post_id);
            if ($post == null) {
                $error = true;
            } else
                $post->category = $this->Category_model->select($post->category_id);
        }
        $categories = $this->Category_model->get_all();

        $data = array(
            'title' => 'Create',
            'post' => $post,
            'categories' => $categories,
            'error' => $error
        );
        $this->_render_page('post/create', $data);
    }

    public function editPost()
    {

    }

    public function commentPost()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('content', 'Content', 'required');

        $output = array(
            'state' => false
        );
        if ($this->form_validation->run() == FALSE) {
            $output['error'] = form_error_array();
            $output['csrf'] = true;
        } else {

            $output['state'] = true;

            $post_id = $this->input->post('post_id', TRUE);
            $content = $this->input->post('content', TRUE);

            $this->load->model('Comment_model');
            $this->load->model('Post_model');
            $comment = array(
                'post_id' => $post_id,
                'content' => $content,
                'user_id' => $this->ion_auth->user()->row()->id
            );


            $id = $this->Comment_model->insert($comment);


            $post = $this->Post_model->select($post_id);
            $update = array(
                'comment' => $post->comment + 1,
                'update_at' => date("Y-m-d H:i:s")
            );

            $this->Post_model->update($post_id, $update);

            $url = base_url('/post/show/' . $post_id);
            $output['redirect'] = $url;
        }

        redirect($output['redirect'], 'refresh');
        //json_output($output);
    }

    public function remove($postid = null)
    {
        if ($this->ion_auth->logged_in() && $postid != null) {
            $this->Post_model->delete($postid);
            echo 1;
            return;
        }

        echo 0;
    }

    public function createPost()
    {

        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules(
            'title',
            'Title',
            'required|max_length[100]',
            array(
                'required' => 'You have not provided %s.'
            )
        );
        $this->form_validation->set_rules('category_id', 'Category', 'required');

        $output = array(
            'state' => false
        );
        if ($this->form_validation->run() == FALSE) {
            $output['error'] = form_error_array();
            $output['csrf'] = true;
        } else {

            $output['state'] = true;

            $post_id = $this->input->post('post_id', TRUE);
            $title = $this->input->post('title', TRUE);
            $category_id = $this->input->post('category_id', TRUE);
            $price = $this->input->post('price', TRUE);
            $coverphoto = $this->input->post('coverphoto', TRUE);
            $day = $this->input->post('day', TRUE);
            //$markdown = $this->input->post('markdown', TRUE);

            $this->load->model('Post_model');
            $this->load->model('Category_model');
            $this->load->library('Markdown');

            //$content = $this->markdown->markdown_to_html($markdown);
            $content = $this->input->post('content');
            $post = array(
                'title' => $title,
                'content' => $content,
                'category_id' => $category_id,
                'price' => $price,
                'day' => $day,
                'coverphoto' => $coverphoto,
                'user_id' => $this->ion_auth->user()->row()->id
            );
            if ($post_id != -1) {
                $_post = $this->Post_model->select($post_id);
                if ($this->ion_auth->user()->row()->id == $_post->user_id) {
                    $post['update_at'] = date("Y-m-d H:i:s");
                    $this->Post_model->update($post_id, $post);
                }
                $id = $post_id;
            } else {
                $id = $this->Post_model->insert($post);
            }


            $category = $this->Category_model->select($category_id);
            $update = array(
                'count' => $category->count + 1,
                'update_at' => date("Y-m-d H:i:s")
            );

            $this->Category_model->update($category_id, $update);

            $url = base_url('/post/show/');
            $output['redirect'] = $url;

        }

        echo $output['redirect'] . $id;
        //  redirect($output['redirect'], 'refresh');
        // json_output($output);

    }

    public function get_day_template($day = "")
    {
        $this->data['day'] = $day;
        $this->load->view("template/day_template", $this->data);
    }

    public function get_article_template()
    {
        $this->load->view("template/article_template");
    }


    public function _render_page($view, $data = null, $returnhtml = false)//I think this makes more sense
    {

        $this->viewdata = (empty($data)) ? $this->data : $data;
        $this->load->view('includes/header');
        $this->load->view('post/list_side', $this->viewdata, $returnhtml);
        $view_html = $this->load->view($view, $this->viewdata, $returnhtml);
        $this->load->view('post/footer', $this->viewdata, $returnhtml);
        $this->load->view('includes/footer');

        if ($returnhtml) return $view_html;//This will return html on 3rd argument being true
    }
}