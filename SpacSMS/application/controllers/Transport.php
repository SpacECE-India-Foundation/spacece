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

class Transport extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('transport_model');
    }

    public function index()
    {
        redirect(base_url(), 'refresh');
    }

    // route user interface 
    public function route()
    {
        if (!get_permission('transport_route', 'is_view')) {
            access_denied();
        }
        if ($_POST) {
            if (!get_permission('transport_route', 'is_add')) {
                ajax_access_denied();
            }
            $this->route_validation();
            if ($this->form_validation->run() !== false) {
                $post = $this->input->post();
                //save all route information in the database file
                $this->transport_model->route_save($post);
                set_alert('success', translate('information_has_been_saved_successfully'));
                $url = base_url('transport/route');
                $array = array('status' => 'success', 'url' => $url, 'error' => '');
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'url' => '', 'error' => $error);
            }
            echo json_encode($array);
            exit();
        }
        $this->data['transportlist'] = $this->app_lib->getTable('transport_route');
        $this->data['title'] = translate('route_master');
        $this->data['sub_page'] = 'transport/route';
        $this->data['main_menu'] = 'transport';
        $this->load->view('layout/index', $this->data);
    }

    // route all information are prepared and user interface
    public function route_edit($id = '')
    {
        if (!get_permission('transport_route', 'is_edit')) {
            access_denied();
        }
        if ($_POST) {
            $this->route_validation();
            if ($this->form_validation->run() !== false) {
                $post = $this->input->post();
                //save all route information in the database file
                $this->transport_model->route_save($post);
                set_alert('success', translate('information_has_been_updated_successfully'));
                $url = base_url('transport/route');
                $array = array('status' => 'success', 'url' => $url, 'error' => '');
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'url' => '', 'error' => $error);
            }
            echo json_encode($array);
            exit();
        }
        $this->data['route'] = $this->app_lib->getTable('transport_route', array('t.id' => $id), true);
        $this->data['title'] = translate('route_master');
        $this->data['sub_page'] = 'transport/route_edit';
        $this->data['main_menu'] = 'transport';
        $this->load->view('layout/index', $this->data);
    }

    public function route_delete($id = '')
    {
        if (get_permission('transport_route', 'is_delete')) {
            if (!is_superadmin_loggedin()) {
                $this->db->where('branch_id', get_loggedin_branch_id());
            }
            $this->db->where('id', $id);
            $this->db->delete('transport_route');
        }
    }

    // vehicle information add and delete
    public function vehicle()
    {
        if (!get_permission('transport_vehicle', 'is_view')) {
            access_denied();
        }
        if ($_POST) {
            if (!get_permission('transport_vehicle', 'is_add')) {
                ajax_access_denied();
            }
            $this->vehicle_validation();
            if ($this->form_validation->run() !== false) {
                $post = $this->input->post();
                //save all vehicle information in the database file
                $this->transport_model->vehicle_save($post);
                set_alert('success', translate('information_has_been_saved_successfully'));
                $url = base_url('transport/vehicle');
                $array = array('status' => 'success', 'url' => $url, 'error' => '');
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'url' => '', 'error' => $error);
            }
            echo json_encode($array);
            exit();
        }
        $this->data['transportlist'] = $this->app_lib->getTable('transport_vehicle');
        $this->data['title'] = translate('vehicle_master');
        $this->data['sub_page'] = 'transport/vehicle';
        $this->data['main_menu'] = 'transport';
        $this->load->view('layout/index', $this->data);
    }

    // vehicle information edit 
    public function vehicle_edit($id = '')
    {
        if (!get_permission('transport_vehicle', 'is_edit')) {
            access_denied();
        }
        if ($_POST) {
            $this->vehicle_validation();
            if ($this->form_validation->run() !== false) {
                $post = $this->input->post();
                //save all vehicle information in the database file
                $this->transport_model->vehicle_save($post);
                set_alert('success', translate('information_has_been_updated_successfully'));
                $url = base_url('transport/vehicle');
                $array = array('status' => 'success', 'url' => $url, 'error' => '');
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'url' => '', 'error' => $error);
            }
            echo json_encode($array);
            exit();
        }
        $this->data['vehicle'] = $this->app_lib->getTable('transport_vehicle', array('t.id' => $id), true);
        $this->data['title'] = translate('vehicle_master');
        $this->data['sub_page'] = 'transport/vehicle_edit';
        $this->data['main_menu'] = 'transport';
        $this->load->view('layout/index', $this->data);
    }

    public function vehicle_delete($id = '')
    {
        if (get_permission('transport_route', 'is_delete')) {
            if (!is_superadmin_loggedin()) {
                $this->db->where('branch_id', get_loggedin_branch_id());
            }
            $this->db->where('id', $id);
            $this->db->delete('transport_vehicle');
        }
    }

    // stoppage information add and delete
    public function stoppage()
    {
        if (!get_permission('transport_stoppage', 'is_view')) {
            access_denied();
        }

        if ($_POST) {
            if (!get_permission('transport_stoppage', 'is_add')) {
                ajax_access_denied();
            }
            $this->stoppage_validation();
            if ($this->form_validation->run() !== false) {
                $post = $this->input->post();
                //save all stoppage information in the database file
                $this->transport_model->stoppage_save($post);
                set_alert('success', translate('information_has_been_saved_successfully'));
                $url = base_url('transport/stoppage');
                $array = array('status' => 'success', 'url' => $url, 'error' => '');
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'url' => '', 'error' => $error);
            }
            echo json_encode($array);
            exit();
        }
        $this->data['stoppagelist'] = $this->app_lib->getTable('transport_stoppage');
        $this->data['title'] = translate('stoppage');
        $this->data['sub_page'] = 'transport/stoppage';
        $this->data['main_menu'] = 'transport';
        $this->data['headerelements'] = array(
            'css' => array(
                'vendor/bootstrap-timepicker/css/bootstrap-timepicker.css',
            ),
            'js' => array(
                'vendor/bootstrap-timepicker/bootstrap-timepicker.js',
            ),
        );
        $this->load->view('layout/index', $this->data);
    }

    // stoppage information edit
    public function stoppage_edit($id = '')
    {
        if (!get_permission('transport_stoppage', 'is_edit')) {
            access_denied();
        }
        if ($_POST) {
            $this->stoppage_validation();
            if ($this->form_validation->run() !== false) {
                $post = $this->input->post();
                //save all stoppage information in the database file
                $this->transport_model->stoppage_save($post);
                set_alert('success', translate('information_has_been_updated_successfully'));
                $url = base_url('transport/stoppage');
                $array = array('status' => 'success', 'url' => $url, 'error' => '');
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'url' => '', 'error' => $error);
            }
            echo json_encode($array);
            exit();
        }
        $this->data['stoppage'] = $this->app_lib->getTable('transport_stoppage', array('t.id' => $id), true);
        $this->data['title'] = translate('stoppage');
        $this->data['sub_page'] = 'transport/stoppage_edit';
        $this->data['main_menu'] = 'transport';
        $this->data['headerelements'] = array(
            'css' => array(
                'vendor/bootstrap-timepicker/css/bootstrap-timepicker.css',
            ),
            'js' => array(
                'vendor/bootstrap-timepicker/bootstrap-timepicker.js',
            ),
        );
        $this->load->view('layout/index', $this->data);
    }

    public function stoppage_delete($id = '')
    {
        if (get_permission('transport_stoppage', 'is_delete')) {
            if (!is_superadmin_loggedin()) {
                $this->db->where('branch_id', get_loggedin_branch_id());
            }
            $this->db->where('id', $id);
            $this->db->delete('transport_stoppage');
        }
    }

    /* user interface with assign vehicles and stoppage information and delete */
    public function assign()
    {
        if (!get_permission('transport_assign', 'is_view')) {
            access_denied();
        }
        $branchID = $this->application_model->get_branch_id();
        if ($_POST) {
            if (!get_permission('transport_assign', 'is_add')) {
                ajax_access_denied();
            }
            $this->assign_validation();
            if ($this->form_validation->run() !== false) {
                $vehicles = $this->input->post('vehicle');
                foreach ($vehicles as $vehicle) {
                    $arrayData[] = array(
                        'branch_id' => $branchID,
                        'route_id' => $this->input->post('route_id'),
                        'stoppage_id' => $this->input->post('stoppage_id'),
                        'vehicle_id' => $vehicle,
                    );
                }
                $this->db->insert_batch('transport_assign', $arrayData);
                set_alert('success', translate('information_has_been_saved_successfully'));
                $url = base_url('transport/assign');
                $array = array('status' => 'success', 'url' => $url, 'error' => '');
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'url' => '', 'error' => $error);
            }
            echo json_encode($array);
            exit();
        }
        $this->data['branch_id'] = $branchID;
        $this->data['title'] = translate('assign_vehicle');
        $this->data['sub_page'] = 'transport/assign';
        $this->data['main_menu'] = 'transport';
        $this->load->view('layout/index', $this->data);

    }

    /* user interface with vehicles assign information edit */
    public function assign_edit($id = '')
    {
        if (!get_permission('transport_assign', 'is_edit')) {
            access_denied();
        }
        if ($_POST) {
            $this->assign_validation();
            if ($this->form_validation->run() !== false) {
                $branchID = $this->application_model->get_branch_id();
                $routeID = $this->input->post('route_id');
                $stoppageID = $this->input->post('stoppage_id');
                $vehicles = $this->input->post('vehicle');
                foreach ($vehicles as $vehicle) {
                    $data = array(
                        'branch_id' => $branchID,
                        'route_id' => $id,
                        'vehicle_id' => $vehicle,
                    );
                    $query = $this->db->get_where("transport_assign", $data);
                    if ($query->num_rows() == 0) {
                        $data['stoppage_id'] = $stoppageID;
                        $this->db->insert('transport_assign', $data);
                    } else {
                        $this->db->where('id', $query->row()->id);
                        $this->db->update('transport_assign', array(
                            'stoppage_id' => $stoppageID,
                            'route_id' => $routeID,
                        ));
                    }
                }
                $this->db->where_not_in('vehicle_id', $vehicles);
                $this->db->where('route_id', $routeID);
                $this->db->where('branch_id', $branchID);
                $this->db->delete('transport_assign');
                set_alert('success', translate('information_has_been_updated_successfully'));
                $url = base_url('transport/assign');
                $array = array('status' => 'success', 'url' => $url, 'error' => '');
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'url' => '', 'error' => $error);
            }
            echo json_encode($array);
            exit();
        }

        $this->data['assign'] = $this->transport_model->getAssignEdit($id);
        $this->data['title'] = translate('assign_vehicle');
        $this->data['sub_page'] = 'transport/assign_edit';
        $this->data['main_menu'] = 'transport';
        $this->load->view('layout/index', $this->data);
    }

    public function assign_delete($id = '')
    {
        if (get_permission('transport_assign', 'is_delete')) {
            if (!is_superadmin_loggedin()) {
                $this->db->where('branch_id', get_loggedin_branch_id());
            }
            $this->db->where('route_id', $id);
            $this->db->delete('transport_assign');
        }
    }

    // validate here, if the check route assign
    public function unique_route_assign($id)
    {
        if ($this->uri->segment(3)) {
            $this->db->where_not_in('route_id', $this->uri->segment(3));
        }
        $this->db->where(array('route_id' => $id));
        $uniform_row = $this->db->get('transport_assign')->num_rows();
        if ($uniform_row == 0) {
            return true;
        } else {
            $this->form_validation->set_message("unique_route_assign", "This route is already assigned.");
            return false;
        }
    }

    /* student transport allocation report */
    public function report()
    {
        if (!get_permission('transport_allocation', 'is_view')) {
            access_denied();
        }

        $branchID = $this->application_model->get_branch_id();
        if ($_POST) {
            $classID = $this->input->post('class_id');
            $sectionID = $this->input->post('section_id');
            $this->data['allocationlist'] = $this->transport_model->allocation_report($classID, $sectionID, $branchID);
        }

        $this->data['branch_id'] = $branchID;
        $this->data['title'] = translate('allocation_report');
        $this->data['sub_page'] = 'transport/allocation';
        $this->data['main_menu'] = 'transport';
        $this->load->view('layout/index', $this->data);
    }

    public function allocation_delete($id) {
        if (get_permission('transport_allocation', 'is_delete')) {
            $this->db->select('student_id');
            $this->db->where('id', $id);
            if (!is_superadmin_loggedin()) {
                $this->db->where('branch_id', get_loggedin_branch_id());
            }
            $student_id = $this->db->get('enroll')->row()->student_id;
            if (!empty($student_id)) {
                $arrayData = array('vehicle_id' => 0, 'route_id' => 0);
                $this->db->where('id', $student_id);
                $this->db->update('student', $arrayData);
            }
        }
    }

    /* get vehicle list based on the route */
    public function get_vehicle_by_route()
    {
        $routeID = $this->input->post("routeID");
        if (!empty($routeID)) {
            $query = $this->db->select('vehicle_id')->where('route_id', $routeID)->get('transport_assign');
            if ($query->num_rows() != 0) {
                echo '<option value="">' . translate('select') . '</option>';
                $vehicles = $query->result_array();
                foreach ($vehicles as $row) {
                    echo '<option value="' . $row['vehicle_id'] . '">' . get_type_name_by_id('transport_vehicle', $row['vehicle_id'], 'vehicle_no') . '</option>';
                }
            } else {
                echo '<option value="">' . translate('no_selection_available') . '</option>';
            }
        } else {
            echo '<option value="">' . translate('first_select_the_route') . '</option>';
        }
    }

    /* get vehicle list based on the branch */
    public function getVehicleByBranch()
    {
        $html = "";
        $branchID = $this->application_model->get_branch_id();
        if (!empty($branchID)) {
            $result = $this->db->select('id,vehicle_no')->where('branch_id', $branchID)->get('transport_vehicle')->result_array();
            if (count($result)) {
                $html .= '<option value="">' . translate('select') . '</option>';
                foreach ($result as $row) {
                    $html .= '<option value="' . $row['id'] . '">' . $row['vehicle_no'] . '</option>';
                }
            } else {
                $html .= '<option value="">' . translate('no_selection_available') . '</option>';
            }
        } else {
            $html .= '<option value="">' . translate('first_select_the_route') . '</option>';
        }
        echo $html;
    }

    /* get stoppage list based on the branch */
    public function getStoppageByBranch()
    {
        $html = "";
        $branchID = $this->application_model->get_branch_id();
        if (!empty($branchID)) {
            $result = $this->db->select('id,stop_position')->where('branch_id', $branchID)->get('transport_stoppage')->result_array();
            if (count($result)) {
                $html .= '<option value="">' . translate('select') . '</option>';
                foreach ($result as $row) {
                    $html .= '<option value="' . $row['id'] . '">' . $row['stop_position'] . '</option>';
                }
            } else {
                $html .= '<option value="">' . translate('no_selection_available') . '</option>';
            }
        } else {
            $html .= '<option value="">' . translate('first_select_the_branch') . '</option>';
        }
        echo $html;
    }

    protected function route_validation()
    {
        if (is_superadmin_loggedin()) {
            $this->form_validation->set_rules('branch_id', translate('branch'), 'required');
        }
        $this->form_validation->set_rules('route_name', translate('route_name'), 'trim|required');
        $this->form_validation->set_rules('start_place', translate('start_place'), 'required');
        $this->form_validation->set_rules('stop_place', translate('stop_place'), 'trim|required');
    }

    protected function stoppage_validation()
    {
        if (is_superadmin_loggedin()) {
            $this->form_validation->set_rules('branch_id', translate('branch'), 'required');
        }
        $this->form_validation->set_rules('stop_position', translate('stoppage'), 'trim|required');
        $this->form_validation->set_rules('stop_time', translate('stop_time'), 'required');
        $this->form_validation->set_rules('route_fare', translate('route_fare'), 'trim|required|numeric');
    }

    protected function vehicle_validation()
    {
        if (is_superadmin_loggedin()) {
            $this->form_validation->set_rules('branch_id', translate('branch'), 'required');
        }
        $this->form_validation->set_rules('vehicle_no', translate('vehicle_no'), 'trim|required');
        $this->form_validation->set_rules('capacity', translate('capacity'), 'required|numeric');
        $this->form_validation->set_rules('driver_name', translate('driver_name'), 'trim|required');
        $this->form_validation->set_rules('driver_phone', translate('driver_phone'), 'trim|required');
        $this->form_validation->set_rules('driver_license', translate('driver_license'), 'trim|required');
    }

    protected function assign_validation()
    {
        if (is_superadmin_loggedin()) {
            $this->form_validation->set_rules('branch_id', translate('branch'), 'required');
        }
        $this->form_validation->set_rules('route_id', translate('transport_route'), 'required|callback_unique_route_assign');
        $this->form_validation->set_rules('stoppage_id', translate('stoppage'), 'required');
        $this->form_validation->set_rules('vehicle[]', translate('vehicle'), 'required');
    }
}
