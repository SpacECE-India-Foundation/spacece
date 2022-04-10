<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @package : Ramom school management system
 * @version : 2.0
 * @developed by : RamomCoder
 * @support : ramomcoder@yahoo.com
 * @author url : http://codecanyon.net/user/RamomCoder
 * @filename : Homework.php
 * @copyright : Reserved RamomCoders Team
 */

class Homework extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('homework_model');
        $this->load->model('sms_model');
    }

    public function index()
    {
        // check access permission
        if (!get_permission('homework', 'is_view')) {
            access_denied();
        }

        $branchID = $this->application_model->get_branch_id();
        if ($_POST) {
            $classID = $this->input->post('class_id');
            $sectionID = $this->input->post('section_id');
            $subjectID = $this->input->post('subject_id');
            $this->data['homeworklist'] = $this->homework_model->getList($classID, $sectionID, $subjectID, $branchID);
        }
        
        $this->data['branch_id'] = $branchID;
        $this->data['title'] = translate('homework');
        $this->data['sub_page'] = 'homework/index';
        $this->data['main_menu'] = 'homework';
        $this->load->view('layout/index', $this->data);
    }

    public function add()
    {
        if (!get_permission('homework', 'is_add')) {
            access_denied();
        }

        if ($_POST) {
            $this->homework_validation();
            if ($this->form_validation->run() !== false) {
                $post = $this->input->post();
                $response = $this->homework_model->save($post);
                set_alert('success', translate('information_has_been_saved_successfully'));
                $url = base_url('homework');
                $array = array('status' => 'success', 'url' => $url);
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail','error' => $error);
            }
            echo json_encode($array);
            exit();
        }
        
        $this->data['branch_id'] = $this->application_model->get_branch_id();;
        $this->data['title'] = translate('homework');
        $this->data['sub_page'] = 'homework/add';
        $this->data['main_menu'] = 'homework';
        $this->data['headerelements'] = array(
            'css' => array(
                'vendor/summernote/summernote.css',
                'vendor/bootstrap-fileupload/bootstrap-fileupload.min.css',
            ),
            'js' => array(
                'vendor/summernote/summernote.js',
                'vendor/bootstrap-fileupload/bootstrap-fileupload.min.js',
            ),
        );
        $this->load->view('layout/index', $this->data);
    }

    public function edit($id='')
    {
        if (!get_permission('homework', 'is_edit')) {
            access_denied();
        }
        
        if ($_POST) {
            $this->homework_validation();
            if ($this->form_validation->run() !== false) {
                $post = $this->input->post();
                $response = $this->homework_model->save($post);
                set_alert('success', translate('information_has_been_updated_successfully'));
                $url = base_url('homework');
                $array = array('status' => 'success', 'url' => $url);
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail','error' => $error);
            }
            echo json_encode($array);
            exit();
        }
        
        $this->data['homework'] = $this->app_lib->getTable('homework', array('t.id' => $id), true);
        $this->data['branch_id'] = $this->application_model->get_branch_id();;
        $this->data['title'] = translate('homework');
        $this->data['sub_page'] = 'homework/edit';
        $this->data['main_menu'] = 'homework';
        $this->data['headerelements'] = array(
            'css' => array(
                'vendor/summernote/summernote.css',
                'vendor/bootstrap-fileupload/bootstrap-fileupload.min.css',
            ),
            'js' => array(
                'vendor/summernote/summernote.js',
                'vendor/bootstrap-fileupload/bootstrap-fileupload.min.js',
            ),
        );
        $this->load->view('layout/index', $this->data);
    }

    public function evaluate($id='')
    {
        // check access permission
        if (!get_permission('homework_evaluate', 'is_view')) {
            access_denied();
        }

        $branchID = $this->application_model->get_branch_id();
        $this->data['homeworklist'] = $this->homework_model->getEvaluate($id);
        $this->data['branch_id'] = $branchID;
        $this->data['title'] = translate('homework');
        $this->data['sub_page'] = 'homework/evaluate_list';
        $this->data['main_menu'] = 'homework';
        $this->load->view('layout/index', $this->data);
    }

    function evaluate_save()
    {
        // check access permission
        if (!get_permission('homework_evaluate', 'is_add')) {
            ajax_access_denied();
        }
        if ($_POST) {
            $this->form_validation->set_rules('date', translate('date'), 'trim|required');
            if ($this->form_validation->run() !== false) {
                $evaluate = $this->input->post('evaluate');
                $homeworkID = $this->input->post('homework_id');
                $date = date("Y-m-d", strtotime($this->input->post('date')));
                foreach ($evaluate as $key => $value) {
                    $attStatus = (isset($value['status']) ? $value['status'] : "");
                    $arrayAttendance = array(
                        'homework_id' => $homeworkID,
                        'student_id' => $value['student_id'],
                        'status' => $attStatus,
                        'rank' => $value['rank'],
                        'remark' => $value['remark'],
                        'date' => $date,
                    );
                    if (empty($value['evaluation_id'])) {
                        $this->db->insert('homework_evaluation', $arrayAttendance);
                    } else {
                        $this->db->where('id', $value['evaluation_id']);
                        $this->db->update('homework_evaluation', array('rank' => $value['rank'], 'status' => $attStatus, 'remark' => $value['remark'], 'date' => $date));
                    }
                }
                $this->db->where('id', $homeworkID);
                $this->db->update('homework', array('evaluation_date' => $date, 'evaluated_by' => get_loggedin_user_id()));
                
                set_alert('success', translate('information_has_been_saved_successfully'));
                $url = base_url('homework');
                $array  = array('status' => 'success', 'url' => $url);
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'error' => $error);
            }
            echo json_encode($array);
            exit();
        }  
    }

    public function evaluateModal()
    {
        $this->data['homeworkID'] = $this->input->post('homework_id');
        echo $this->load->view('homework/evaluateModal', $this->data, true);
    }

    public function report()
    {
        // check access permission
        if (!get_permission('evaluation_report', 'is_view')) {
            access_denied();
        }

        $branchID = $this->application_model->get_branch_id();
        if ($_POST) {
            $classID = $this->input->post('class_id');
            $sectionID = $this->input->post('section_id');
            $subjectID = $this->input->post('subject_id');
            $this->data['homeworklist'] = $this->homework_model->getList($classID, $sectionID, $subjectID, $branchID);
        }
        
        $this->data['branch_id'] = $branchID;
        $this->data['title'] = translate('homework');
        $this->data['sub_page'] = 'homework/report';
        $this->data['main_menu'] = 'homework';
        $this->load->view('layout/index', $this->data);
    }

    public function evaluateDetails()
    {
        $id = $this->input->post('homework_id');
        $this->data['homeworklist'] = $this->homework_model->getEvaluate($id);
        echo $this->load->view('homework/evaluateDetails', $this->data, true);
    }


    public function download($id)
    {
        $this->load->helper('download');
        $name     = get_type_name_by_id('homework', $id, 'document');
        $ext      = explode(".", $name);
        $filepath = "./uploads/attachments/homework/" . $id . "." . $ext[1];
        $data     = file_get_contents($filepath);
        force_download($name, $data);
    } 

    public function delete($id = '')
    {
        if (get_permission('homework', 'is_delete') && !empty($id)) {
            if (!is_superadmin_loggedin()) {
                $this->db->where('branch_id', get_loggedin_branch_id());
            }
            $name = get_type_name_by_id('homework', $id, 'document');
            $ext = explode(".", $name);
            $this->db->where('id', $id);
            $this->db->delete('homework');
            $filepath = "./uploads/attachments/homework/" . $id . "." . $ext[1];
            if (file_exists($filepath)) {
                unlink($filepath);
            }
        }
    }

    /* homework form validation rules */
    protected function homework_validation()
    {
        if (is_superadmin_loggedin()) {
            $this->form_validation->set_rules('branch_id', translate('branch'), 'required');
        }
        $this->form_validation->set_rules('class_id', translate('class'), 'trim|required');
        $this->form_validation->set_rules('section_id', translate('section'), 'trim|required');
        $this->form_validation->set_rules('subject_id', translate('subject'), 'trim|required');
        $this->form_validation->set_rules('date_of_homework', translate('date_of_homework'), 'trim|required');
        $this->form_validation->set_rules('date_of_submission', translate('date_of_submission'), 'trim|required');
        if (isset($_POST['published_later'])) {
            $this->form_validation->set_rules('schedule_date', translate('schedule_date'), 'trim|required');
        }
        $this->form_validation->set_rules('homework', translate('homework'), 'trim|required');
        $this->form_validation->set_rules('attachment_file', translate('attachment'), 'callback_handle_upload');
    }

    // upload file form validation
    public function handle_upload()
    {
        if (isset($_FILES["attachment_file"]) && !empty($_FILES['attachment_file']['name'])) {
            $file_type = $_FILES["attachment_file"]['type'];
            $file_size = $_FILES["attachment_file"]["size"];
            $file_name = $_FILES["attachment_file"]["name"];
            $allowedExts = array('txt', 'pdf', 'doc', 'xls', 'docx', 'xlsx', 'jpg', 'jpeg', 'png', 'gif', 'bmp');
            $upload_size = 2097152;
            $extension = pathinfo($file_name, PATHINFO_EXTENSION);
            if ($files = filesize($_FILES['attachment_file']['tmp_name'])) {
                if (!in_array(strtolower($extension), $allowedExts)) {
                    $this->form_validation->set_message('handle_upload', translate('this_file_type_is_not_allowed'));
                    return false;
                }
                if ($file_size > $upload_size) {
                    $this->form_validation->set_message('handle_upload', translate('file_size_shoud_be_less_than') . " " . ($upload_size / 1024) . " KB");
                    return false;
                }
            } else {
                $this->form_validation->set_message('handle_upload', translate('error_reading_the_file'));
                return false;
            }
            return true;
        } else {
            if (isset($_POST['homework_id'])) {
                return true;
            }
            $this->form_validation->set_message('handle_upload', "The Attachment field is required.");
            return false;
        }
    }
}
