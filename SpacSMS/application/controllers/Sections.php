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

class Sections extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (!get_permission('section', 'is_view')) {
            access_denied();
        }

        $this->data['sectionlist'] = $this->app_lib->getTable('section');
        $this->data['title'] = translate('section_control');
        $this->data['sub_page'] = 'sections/index';
        $this->data['main_menu'] = 'sections';
        $this->load->view('layout/index', $this->data);
    }

    public function edit($id = '')
    {
        if (!get_permission('section', 'is_edit')) {
            access_denied();
        }
        $this->data['section'] = $this->app_lib->getTable('section', array('t.id' => $id), true);
        $this->data['title'] = translate('section_control');
        $this->data['sub_page'] = 'sections/edit';
        $this->data['main_menu'] = 'sections';
        $this->load->view('layout/index', $this->data);
    }

    public function save()
    {
        if ($_POST) {
            if (is_superadmin_loggedin()) {
                $this->form_validation->set_rules('branch_id', translate('branch'), 'required');
            }
            $this->form_validation->set_rules('name', translate('name'), 'trim|required|callback_unique_name');
            $this->form_validation->set_rules('capacity', translate('capacity'), 'trim|numeric');
            if ($this->form_validation->run() !== false) {
                $arraySection = array(
                    'name' => $this->input->post('name'),
                    'capacity' => $this->input->post('capacity'),
                    'branch_id' => $this->application_model->get_branch_id(),
                );
                $sectionID = $this->input->post('section_id');
                if (empty($sectionID)) {
                    if (get_permission('section', 'is_add')) {
                        $this->db->insert('section', $arraySection);
                    }
                    set_alert('success', translate('information_has_been_saved_successfully'));
                } else {
                    if (get_permission('section', 'is_edit')) {
                        if (!is_superadmin_loggedin()) {
                            $this->db->where('branch_id', get_loggedin_branch_id());
                        }
                        $this->db->where('id', $sectionID);
                        $this->db->update('section', $arraySection);
                    }
                    set_alert('success', translate('information_has_been_updated_successfully'));
                }
                $url = base_url('sections');
                $array = array('status' => 'success', 'url' => $url, 'error' => '');
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'url' => '', 'error' => $error);
            }
            echo json_encode($array);
        }
    }

    // validate here, if the check sectio name
    public function unique_name($name)
    {
        $branchID = $this->application_model->get_branch_id();
        $sectionID = $this->input->post('section_id');
        if (!empty($sectionID)) {
            $this->db->where_not_in('id', $sectionID);
        }
        $this->db->where(array('name' => $name, 'branch_id' => $branchID));
        $uniform_row = $this->db->get('section')->num_rows();
        if ($uniform_row == 0) {
            return true;
        } else {
            $this->form_validation->set_message("unique_name", translate('already_taken'));
            return false;
        }
    }

    public function delete($id = '')
    {
        if (get_permission('section', 'is_delete')) {
            if (!is_superadmin_loggedin()) {
                $this->db->where('branch_id', get_loggedin_branch_id());
            }
            $this->db->where('id', $id);
            $this->db->delete('section');
        }
    }
}
