<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @package : Ramom Diagnostic Management System
 * @version : 2.0
 * @developed by : RamomCoder
 * @support : ramomcoder@yahoo.com
 * @author url : http://codecanyon.net/user/RamomCoder
 * @filename : Role.php
 */

class Role extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('role_model');
        if (!is_superadmin_loggedin()) {
            access_denied();
        }
    }

    // new role add
    public function index()
    {
        if (isset($_POST['save'])) {
            $rules = array(
                array(
                    'field' => 'role',
                    'label' => 'Role Name',
                    'rules' => 'required|callback_unique_name',
                ),
            );
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run() == false) {
                $this->data['validation_error'] = true;
            } else {
                // update information in the database
                $data = $this->input->post();
                $this->role_model->save_roles($data);
                set_alert('success', translate('information_has_been_saved_successfully'));
                redirect(base_url('role'));
            }
        }
        $this->data['roles'] = $this->role_model->getRoleList();
        $this->data['title'] = translate('roles');
        $this->data['sub_page'] = 'role/index';
        $this->data['main_menu'] = 'settings';
        $this->load->view('layout/index', $this->data);
    }

    // role edit
    public function edit($id)
    {
        if (isset($_POST['save'])) {
            $rules = array(
                array(
                    'field' => 'role',
                    'label' => 'Role Name',
                    'rules' => 'required|callback_unique_name',
                ),
            );
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run() == false) {
                $this->data['validation_error'] = true;
            } else {
                // SAVE ROLE INFORMATION IN THE DATABASE
                $data = $this->input->post();
                $this->role_model->save_roles($data);
                set_alert('success', translate('information_has_been_updated_successfully'));
                redirect(base_url('role'));
            }
        }
        $this->data['roles'] = $this->role_model->get('roles', array('id' => $id), true);
        $this->data['title'] = translate('roles');
        $this->data['sub_page'] = 'role/edit';
        $this->data['main_menu'] = 'test';
        $this->load->view('layout/index', $this->data);
    }

    // check unique name
    public function unique_name($name)
    {
        $id = $this->input->post('id');
        if (isset($id)) {
            $where = array('name' => $name, 'id != ' => $id);
        } else {
            $where = array('name' => $name);
        }
        $q = $this->db->get_where('roles', $where);
        if ($q->num_rows() > 0) {
            $this->form_validation->set_message("unique_name", translate('already_taken'));
            return false;
        } else {
            return true;
        }
    }

    // role delete in DB
    public function delete($role_id)
    {
        $systemRole = array(1, 2, 3, 4, 5, 6, 7);
        if (!in_array($role_id, $systemRole)) {
            $this->db->where('id', $role_id);
            $this->db->delete('roles');
        }
    }

    public function permission($role_id)
    {
        $roleList = $this->role_model->getRoleList();
        $allowRole = array_column($roleList, 'id');
        if (!in_array($role_id, $allowRole)) {
            access_denied();
        }
        if (isset($_POST['save'])) {
            $role_id = $this->input->post('role_id');
            $privileges = $this->input->post('privileges');
            foreach ($privileges as $key => $value) {
                $is_add = (isset($value['add']) ? 1 : 0);
                $is_edit = (isset($value['edit']) ? 1 : 0);
                $is_view = (isset($value['view']) ? 1 : 0);
                $is_delete = (isset($value['delete']) ? 1 : 0);
                $arrayData = array(
                    'role_id' => $role_id,
                    'permission_id' => $key,
                    'is_add' => $is_add,
                    'is_edit' => $is_edit,
                    'is_view' => $is_view,
                    'is_delete' => $is_delete,
                );
                $exist_privileges = $this->db->select('id')->limit(1)->where(array('role_id' => $role_id, 'permission_id' => $key))->get('staff_privileges')->num_rows();
                if ($exist_privileges > 0) {
                    $this->db->update('staff_privileges', $arrayData, array('role_id' => $role_id, 'permission_id' => $key));
                } else {
                    $this->db->insert('staff_privileges', $arrayData);
                }
            }
            set_alert('success', translate('information_has_been_updated_successfully'));
            redirect(base_url('role/permission/' . $role_id));
        }
        $this->data['role_id'] = $role_id;
        $this->data['modules'] = $this->role_model->getModulesList();
        $this->data['title'] = translate('roles');
        $this->data['sub_page'] = 'role/permission';
        $this->data['main_menu'] = 'settings';
        $this->load->view('layout/index', $this->data);
    }
}
