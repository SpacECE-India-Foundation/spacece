<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @package : Ramom school management system
 * @version : 2.0
 * @developed by : RamomCoder
 * @support : ramomcoder@yahoo.com
 * @author url : http://codecanyon.net/user/RamomCoder
 * @filename : Accounting.php
 * @copyright : Reserved RamomCoders Team
 */

class Library extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('library_model');
    }

    public function index()
    {
        if (is_loggedin()) {
            redirect(base_url('dashboard'));
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    /* book form validation rules */
    protected function book_validation()
    {
        if (is_superadmin_loggedin()) {
            $this->form_validation->set_rules('branch_id', translate('branch'), 'required');
        }
        $this->form_validation->set_rules('book_title', translate('book_title'), 'trim|required');
        $this->form_validation->set_rules('purchase_date', translate('purchase_date'), 'trim|required');
        $this->form_validation->set_rules('category_id', translate('book_category'), 'trim|required');
        $this->form_validation->set_rules('publisher', translate('publisher'), 'trim|required');
        $this->form_validation->set_rules('price', translate('price'), 'trim|required|numeric');
        $this->form_validation->set_rules('total_stock', translate('total_stock'), 'trim|required');
    }

    /* category form validation rules */
    protected function category_validation()
    {
        if (is_superadmin_loggedin()) {
            $this->form_validation->set_rules('branch_id', translate('branch'), 'required');
        }
        $this->form_validation->set_rules('name', translate('category'), 'trim|required|callback_unique_category');
    }

    // book page
    public function book()
    {
        if (!get_permission('book', 'is_view')) {
            access_denied();
        }

        if ($_POST) {
            if (!get_permission('book', 'is_add')) {
                ajax_access_denied();
            }
            $this->book_validation();
            if ($this->form_validation->run() !== false) {
                $post = $this->input->post();
                //save all route information in the database file
                $this->library_model->book_save($post);
                set_alert('success', translate('information_has_been_saved_successfully'));
                $url = base_url('library/book');
                $array = array('status' => 'success', 'url' => $url);
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'error' => $error);
            }
            echo json_encode($array);
            exit();
        }
        $branchID = $this->application_model->get_branch_id();
        $this->data['branch_id'] = $branchID;
        $this->data['booklist'] = $this->app_lib->getTable('book');
        $this->data['title'] = translate('books');
        $this->data['sub_page'] = 'library/book';
        $this->data['main_menu'] = 'library';
        $this->data['headerelements'] = array(
            'css' => array(
                'vendor/dropify/css/dropify.min.css',
            ),
            'js' => array(
                'vendor/dropify/js/dropify.min.js',
            ),
        );
        $this->load->view('layout/index', $this->data);
    }

    /* the book information is updated here */
    public function book_edit($id = '')
    {
        if (!get_permission('book', 'is_edit')) {
            access_denied();
        }

        if ($_POST) {
            $this->book_validation();
            if ($this->form_validation->run() !== false) {
                $post = $this->input->post();
                //save all route information in the database file
                $this->library_model->book_save($post);
                set_alert('success', translate('information_has_been_saved_successfully'));
                $url = base_url('library/book');
                $array = array('status' => 'success', 'url' => $url, 'error' => '');
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'url' => '', 'error' => $error);
            }
            echo json_encode($array);
            exit();
        }
        $this->data['book'] = $this->app_lib->getTable('book', array('t.id' => $id), true);
        $this->data['branch_id'] = $this->application_model->get_branch_id();
        $this->data['booklist'] = $this->app_lib->getTable('book');
        $this->data['title'] = translate('books_entry');
        $this->data['sub_page'] = 'library/book_edit';
        $this->data['main_menu'] = 'library_book';
        $this->data['headerelements'] = array(
            'css' => array(
                'vendor/dropify/css/dropify.min.css',
            ),
            'js' => array(
                'vendor/dropify/js/dropify.min.js',
            ),
        );
        $this->load->view('layout/index', $this->data);
    }

    public function book_delete($id = '')
    {
        if (get_permission('book', 'is_delete')) {
            $file = 'uploads/book_cover/' . get_type_name_by_id('book', $id, 'cover');
            if (file_exists($file)) {
                @unlink($file);
            }
            if (!is_superadmin_loggedin()) {
                $this->db->where('branch_id', get_loggedin_branch_id());
            }
            $this->db->where('id', $id);
            $this->db->delete('book');
        }
    }

    // category information are prepared and stored in the database here
    public function category()
    {
        if (isset($_POST['save'])) {
            if (!get_permission('book_category', 'is_add')) {
                access_denied();
            }
            $this->category_validation();
            if ($this->form_validation->run() !== false) {
                //save hostel type information in the database file
                $this->library_model->category_save($this->input->post());
                set_alert('success', translate('information_has_been_saved_successfully'));
                redirect(base_url('library/category'));
            }
        }
        $this->data['categorylist'] = $this->app_lib->getTable('book_category');
        $this->data['title'] = translate('category');
        $this->data['sub_page'] = 'library/category';
        $this->data['main_menu'] = 'library';
        $this->load->view('layout/index', $this->data);
    }

    public function category_edit()
    {
        if ($_POST) {
            if (!get_permission('book_category', 'is_edit')) {
                ajax_access_denied();
            }
            $this->category_validation();
            if ($this->form_validation->run() !== false) {
                //update book category information in the database file
                $this->library_model->category_save($this->input->post());
                set_alert('success', translate('information_has_been_updated_successfully'));
                $url = base_url('library/category');
                $array = array('status' => 'success', 'url' => $url, 'error' => '');
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'url' => '', 'error' => $error);
            }
            echo json_encode($array);
        }
    }

    public function category_delete($id)
    {
        if (get_permission('book_category', 'is_delete')) {
            if (!is_superadmin_loggedin()) {
                $this->db->where('branch_id', get_loggedin_branch_id());
            }
            $this->db->where('id', $id);
            $this->db->delete('book_category');
        }
    }

    /* book issue information are prepared and stored in the database here */
    public function book_manage($action = '', $id = '')
    {
        if (!get_permission('book_manage', 'is_view')) {
            access_denied();
        }

        if (isset($_POST['update'])) {
            if (!get_permission('book_manage', 'is_add')) {
                access_denied();
            }
            $arrayLeave = array(
                'issued_by' => get_loggedin_user_id(),
                'status' => $this->input->post('status'),
            );
            $id = $this->input->post('id');
            if (!is_superadmin_loggedin()) {
                $this->db->where('branch_id', get_loggedin_branch_id());
            }
            $this->db->where('id', $id);
            $this->db->update('book_issues', $arrayLeave);
            set_alert('success', translate('information_has_been_updated_successfully'));
            redirect(current_url());
        }
        if ($action == "delete") {
            $this->db->where('id', $id);
            $this->db->delete('book_issues');
        }
        $this->data['branch_id'] = $this->application_model->get_branch_id();
        $this->data['booklist'] = $this->library_model->getBookIssueList();
        $this->data['title'] = translate('book_manage');
        $this->data['sub_page'] = 'library/book_manage';
        $this->data['main_menu'] = 'library';
        $this->load->view('layout/index', $this->data);
    }

    public function bookIssued()
    {
        if ($_POST) {
            if (!get_permission('book_manage', 'is_add')) {
                ajax_access_denied();
            }

            if (is_superadmin_loggedin()) {
                $this->form_validation->set_rules('branch_id', translate('branch'), 'required');
            }
            $this->form_validation->set_rules('category_id', translate('book_category'), 'required');
            $this->form_validation->set_rules('book_id', translate('book_title'), 'trim|required|callback_validation_stock');
            $this->form_validation->set_rules('role_id', translate('role'), 'required');
            $roleID = $this->input->post('role_id');
            if ($roleID == 7) {
                $this->form_validation->set_rules('class_id', translate('class'), 'trim|required');
            }
            $this->form_validation->set_rules('user_id', translate('user_name'), 'required');
            $this->form_validation->set_rules('date_of_expiry', 'Date Of Expiry', 'trim|required|callback_validation_date');
            if ($this->form_validation->run() !== false) {
                $data = $this->input->post();
                //save book issued information in the database file
                $this->library_model->issued_save($data);
                set_alert('success', translate('information_has_been_saved_successfully'));
                $url = base_url('library/book_manage');
                $array = array('status' => 'success', 'url' => $url, 'error' => '');
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'url' => '', 'error' => $error);
            }
            echo json_encode($array);
        }
    }

    public function issued_book_delete($id)
    {
        if (get_permission('book_manage', 'is_delete')) {
            $status = get_type_name_by_id('book_issues', $id, 'status');
            if ($status == 2 || $status == 3) {
                if (!is_superadmin_loggedin()) {
                    $this->db->where('branch_id', get_loggedin_branch_id());
                }
                $this->db->where('id', $id);
                $this->db->delete('book_issues');
            }
        }
    }

    public function request()
    {
        // check access permission
        if (!get_permission('book_request', 'is_view')) {
            access_denied();
        }
        if ($_POST) {
            if (!get_permission('book_request', 'is_add')) {
                access_denied();
            }
            $this->form_validation->set_rules('book_id', translate('book_title'), 'required|callback_validation_stock');
            $this->form_validation->set_rules('date_of_issue', translate('date_of_issue'), 'trim|required');
            $this->form_validation->set_rules('date_of_expiry', translate('date_of_expiry'), 'trim|required|callback_validation_date');
            if ($this->form_validation->run() !== false) {
                $arrayIssue = array(
                    'branch_id' => get_loggedin_branch_id(),
                    'book_id' => $this->input->post('book_id'),
                    'user_id' => get_loggedin_user_id(),
                    'role_id' => loggedin_role_id(),
                    'date_of_issue' => date("Y-m-d", strtotime($this->input->post('date_of_issue'))),
                    'date_of_expiry' => date("Y-m-d", strtotime($this->input->post('date_of_expiry'))),
                    'issued_by' => get_loggedin_user_id(),
                    'status' => 0,
                    'session_id' => get_session_id(),
                );
                $this->db->insert('book_issues', $arrayIssue);
                set_alert('success', translate('information_has_been_saved_successfully'));
                $url = base_url('library/request');
                $array = array('status' => 'success', 'url' => $url, 'error' => '');
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'url' => '', 'error' => $error);
            }
            echo json_encode($array);
            exit();
        }
        $branchID = $this->application_model->get_branch_id();
        $this->data['branch_id'] = $branchID;
        $this->data['title'] = translate('library');
        $this->data['sub_page'] = 'library/request';
        $this->data['main_menu'] = 'library';
        $this->load->view('layout/index', $this->data);
    }

    public function request_delete($id)
    {
        if (get_permission('book_request', 'is_delete')) {
            $status = get_type_name_by_id('book_issues', $id, 'status');
            if ($status == 0) {
                $this->db->where('id', $id);
                $this->db->where('user_id', get_loggedin_user_id());
                $this->db->where('role_id', loggedin_role_id());
                $this->db->delete('book_issues');
            }
        }
    }

    // validation book stock
    public function validation_stock($book_id)
    {
        $query = $this->db->select('total_stock,issued_copies')->where('id', $book_id)->get('book')->row_array();
        $stock = $query['total_stock'];
        $issued = $query['issued_copies'];
        if ($stock == 0 || $issued >= $stock) {
            $this->form_validation->set_message("validation_stock", translate('the_book_is_not_available_in_stock'));
            return false;
        } else {
            return true;
        }
    }

    public function getBookApprovelDetails()
    {
        if (get_permission('book_manage', 'is_add')) {
            $this->data['book_id'] = $this->input->post('id');
            $this->load->view('library/bookDetailsModal', $this->data);
        }
    }

    public function bookReturn()
    {
        if ($_POST) {
            if (!get_permission('book_manage', 'is_add')) {
                ajax_access_denied();
            }
            $this->form_validation->set_rules('date', translate('date'), 'trim|required|callback_return_validation');
            $this->form_validation->set_rules('fine_amount', translate('role'), 'trim|numeric');
            if ($this->form_validation->run() !== false) {
                $id = $this->input->post('issue_id');
                $getData = $this->db->get_where('book_issues', array('id' => $id))->row_array();
                $type = $this->input->post('type');
                $date = strtotime($this->input->post('date'));
                if ($type == '1') {
                    // update book issued copies value
                    $this->db->set('issued_copies', 'issued_copies-1', false);
                    $this->db->where('id', $getData['book_id']);
                    $this->db->update('book');

                    $arrayReturn = array(
                        'return_by' => get_loggedin_user_id(),
                        'status' => 3,
                        'fine_amount' => $this->input->post('fine_amount'),
                        'return_date' => date("Y-m-d", $date),
                    );
                } elseif ($type == '2') {
                    $arrayReturn = array(
                        'fine_amount' => $this->input->post('fine_amount'),
                        'date_of_expiry' => date("Y-m-d", $date),
                    );
                }
                if (!is_superadmin_loggedin()) {
                    $this->db->where('branch_id', get_loggedin_branch_id());
                }
                $this->db->where('id', $id);
                $this->db->update('book_issues', $arrayReturn);

                set_alert('success', translate('information_has_been_saved_successfully'));
                $url = base_url('library/book_manage');
                $array = array('status' => 'success', 'url' => $url, 'error' => '');
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'url' => '', 'error' => $error);
            }
            echo json_encode($array);
        }
    }

    // validation date
    public function validation_date($date)
    {
        if ($date) {
            $date = strtotime($date);
            $today = strtotime(date('Y-m-d'));
            if ($today >= $date) {
                $this->form_validation->set_message("validation_date", translate('today_or_the_previous_day_can_not_be_issued'));
                return false;
            } else {
                return true;
            }
        }
    }

    public function return_validation($date)
    {
        $date = strtotime($date);
        $id = $this->input->post('issue_id');
        $get = $this->db->select('date_of_issue,date_of_expiry')->get_where('book_issues', array('id' => $id))->row_array();
        if (strtotime($get['date_of_issue']) >= $date || strtotime($get['date_of_expiry']) > $date) {
            $this->form_validation->set_message("return_validation", translate('invalid_return_date_entered'));
            return false;
        } else {
            return true;
        }
    }

    /* book category exists validation */
    public function unique_category($name)
    {
        $category_id = $this->input->post('category_id');
        $branch_id = $this->application_model->get_branch_id();
        if (!empty($category_id)) {
            $this->db->where_not_in('id', $category_id);
        }
        $this->db->where('name', $name);
        $this->db->where('branch_id', $branch_id);
        $query = $this->db->get('book_category');
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message("unique_category", translate('already_taken'));
            return false;
        } else {
            return true;
        }
    }

    /* get book list based on the category */
    public function getBooksByCategory()
    {
        $categoryID = $this->input->post('category_id');
        $html = "";
        if (!empty($categoryID)) {
            $books = $this->db->select('id,title')->get_where('book', array('category_id' => $categoryID))->result_array();
            if (count($books)) {
                $html .= '<option value = "">' . translate('select') . '</option>';
                foreach ($books as $row) {
                    $html .= '<option value="' . $row['id'] . '">' . $row['title'] . '</option>';
                }
            } else {
                $html .= '<option value="">' . translate('no_information_available') . '</option>';
            }
        } else {
            $html .= '<option value="">' . translate('select_category_first') . '</option>';
        }
        echo $html;
    }
}
