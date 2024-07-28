<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Library_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function book_save($data)
    {
        $arraybook = array(
            'branch_id' => $this->application_model->get_branch_id(),
            'title' => $data['book_title'],
            'isbn_no' => $data['isbn_no'],
            'author' => $data['author'],
            'edition' => $data['edition'],
            'purchase_date' => date('Y-m-d', strtotime($data['purchase_date'])),
            'category_id' => $data['category_id'],
            'publisher' => $data['publisher'],
            'description' => $data['description'],
            'price' => $data['price'],
            'total_stock' => $data['total_stock'],
        );
        if ($_FILES['cover_image']['name'] != "") {
            $config['upload_path'] = 'uploads/book_cover/';
            $config['allowed_types'] = 'jpg|png';
            $config['overwrite'] = false;
            $config['file_name'] = 'cover_image_' . app_generate_hash();
            $this->upload->initialize($config);
            if ($this->upload->do_upload("cover_image")) {
                $arraybook['cover'] = $this->upload->data('file_name');
            }
        }
        if (!isset($data['book_id'])) {
            $this->db->insert('book', $arraybook);
        } else {
            if ($_FILES['cover_image']['name'] != "") {
                if (!empty($data['old_file'])) {
                    $file = 'uploads/book_cover/' . $data['old_file'];
                    if (file_exists($file)) {
                        @unlink($file);
                    }
                }
            }
            $this->db->where('id', $data['book_id']);
            $this->db->update('book', $arraybook);
        }
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function category_save($data)
    {
        $arrayData = array(
            'name' => $data['name'],
            'branch_id' => $this->application_model->get_branch_id(),
        );
        if (!isset($arrayData['category_id'])) {
            $this->db->insert('book_category', $arrayData);
        } else {
            $this->db->where('id', $arrayData['category_id']);
            $this->db->update('book_category', $arrayData);
        }
    }

    // book issue information storage
    public function issued_save($data)
    {
        $arrayIssue = array(
            'branch_id' => $this->application_model->get_branch_id(),
            'book_id' => $data['book_id'],
            'user_id' => $data['user_id'],
            'role_id' => $data['role_id'],
            'date_of_issue' => date("Y-m-d"),
            'date_of_expiry' => date("Y-m-d", strtotime($data['date_of_expiry'])),
            'issued_by' => get_loggedin_user_id(),
            'status' => 1,
            'session_id' => get_session_id(),
        );
        $this->db->insert('book_issues', $arrayIssue);
        // update book issued copies value
        $this->db->set('issued_copies', 'issued_copies+1', FALSE);
        $this->db->where('id', $arrayIssue['book_id']);
        $this->db->update('book');

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // get book issue list
    public function getBookIssueList($id = '')
    {
        $this->db->select('bi.*,b.title,b.cover,b.isbn_no,b.edition,b.author,br.name as branch_name,c.name as category_name,roles.name as role_name');
        $this->db->from('book_issues as bi');
        $this->db->join('book as b', 'b.id = bi.book_id', 'left');
        $this->db->join('branch as br', 'br.id = bi.branch_id', 'left');
        $this->db->join('roles', 'roles.id = bi.role_id', 'left');
        $this->db->join('book_category as c', 'c.id = b.category_id', 'left');
        if (!is_superadmin_loggedin()) {
            $this->db->where('bi.branch_id', get_loggedin_branch_id());
        }
        $this->db->where('bi.session_id', get_session_id());
        if ($id != '') {
            $this->db->where('bi.id', $id);
            return $this->db->get()->row_array();
        } else {
            $this->db->order_by('bi.id', 'desc');
            return $this->db->get()->result_array();
        }
    }

    // get book issue list
    public function get_book_issue_list()
    {
        $this->db->select('bi.*,b.title,b.cover,b.isbn_no,b.edition,c.name as category_name');
        $this->db->from('book_issues as bi');
        $this->db->join('book as b', 'b.id = bi.book_id', 'left');
        $this->db->join('book_category as c', 'c.id = b.category_id', 'left');
        if (is_parent_loggedin()) {
            $this->db->where('bi.user_role', 'student');
            $this->db->where('bi.user_id', get_activeChildren_id());
        } else {
            $this->db->where('bi.user_role', get_loggedin_user_type());
            $this->db->where('bi.user_id', get_loggedin_user_id());
        }
        $this->db->where('bi.session_id', get_session_id());
        $this->db->order_by('bi.id', 'desc');
        return $this->db->get();
    }


}
