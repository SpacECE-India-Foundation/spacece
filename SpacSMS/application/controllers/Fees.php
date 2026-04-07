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

class Fees extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('fees_model');
    }

    /* fees type form validation rules */
    protected function type_validation()
    {
        if (is_superadmin_loggedin()) {
            $this->form_validation->set_rules('branch_id', translate('branch'), 'required');
        }
        $this->form_validation->set_rules('type_name', translate('name'), 'trim|required|callback_unique_type');
    }

    /* fees type control */
    public function type()
    {
        if (!get_permission('fees_type', 'is_view')) {
            access_denied();
        }
        if ($_POST) {
            if (!get_permission('fees_type', 'is_add')) {
                ajax_access_denied();
            }
            $this->type_validation();
            if ($this->form_validation->run() !== false) {
                $post = $this->input->post();
                $this->fees_model->typeSave($post);
                set_alert('success', translate('information_has_been_saved_successfully'));
                $array = array('status' => 'success');
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'error' => $error);
            }
            echo json_encode($array);
            exit();
        }
        $this->data['categorylist'] = $this->app_lib->getTable('fees_type');
        $this->data['title'] = translate('fees_type');
        $this->data['sub_page'] = 'fees/type';
        $this->data['main_menu'] = 'fees';
        $this->load->view('layout/index', $this->data);
    }

    public function type_edit($id = '')
    {
        if (!get_permission('fees_type', 'is_edit')) {
            access_denied();
        }

        if ($_POST) {
            $this->type_validation();
            if ($this->form_validation->run() !== false) {
                $post = $this->input->post();
                $this->fees_model->typeSave($post);
                set_alert('success', translate('information_has_been_updated_successfully'));
                $url = base_url('fees/type');
                $array = array('status' => 'success', 'url' => $url);
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'error' => $error);
            }
            echo json_encode($array);
            exit();
        }
        $this->data['category'] = $this->app_lib->getTable('fees_type', array('t.id' => $id), true);
        $this->data['title'] = translate('fees_type');
        $this->data['sub_page'] = 'fees/type_edit';
        $this->data['main_menu'] = 'fees';
        $this->load->view('layout/index', $this->data);
    }

    public function type_delete($id = '')
    {
        if (get_permission('fees_type', 'is_delete')) {
            if (!is_superadmin_loggedin()) {
                $this->db->where('branch_id', get_loggedin_branch_id());
            }
            $this->db->where('id', $id);
            $this->db->delete('fees_type');
        }
    }

    public function unique_type($name)
    {
        $branchID = $this->application_model->get_branch_id();
        $typeID = $this->input->post('type_id');
        if (!empty($typeID)) {
            $this->db->where_not_in('id', $typeID);
        }
        $this->db->where(array('name' => $name, 'branch_id' => $branchID));
        $uniform_row = $this->db->get('fees_type')->num_rows();
        if ($uniform_row == 0) {
            return true;
        } else {
            $this->form_validation->set_message("unique_type", translate('already_taken'));
            return false;
        }
    }

    public function group($branch_id = '')
    {
        if (!get_permission('fees_group', 'is_view')) {
            access_denied();
        }
        if ($_POST) {
            if (!get_permission('fees_group', 'is_add')) {
                ajax_access_denied();
            }
            if (is_superadmin_loggedin()) {
                $this->form_validation->set_rules('branch_id', translate('branch'), 'required');
            }
            $this->form_validation->set_rules('name', translate('group_name'), 'trim|required');
            $elems = $this->input->post('elem');
            $sel = 0;
            if (count($elems)) {
                foreach ($elems as $key => $value) {
                    if (isset($value['fees_type_id'])) {
                        $sel++;
                        $this->form_validation->set_rules('elem[' . $key . '][due_date]', translate('due_date'), 'trim|required');
                        $this->form_validation->set_rules('elem[' . $key . '][amount]', translate('amount'), 'trim|required|greater_than[0]');
                    }
                }
            }
            if ($this->form_validation->run() !== false) {
                if ($sel != 0) {
                    $arrayGroup = array(
                        'name' => $this->input->post('name'),
                        'description' => $this->input->post('description'),
                        'session_id' => get_session_id(),
                        'branch_id' => $this->application_model->get_branch_id(),
                    );
                    $this->db->insert('fee_groups', $arrayGroup);
                    $groupID = $this->db->insert_id();
                    foreach ($elems as $key => $row) {
                        if (isset($row['fees_type_id'])) {
                            $arrayData = array(
                                'fee_groups_id' => $groupID,
                                'fee_type_id' => $row['fees_type_id'],
                                'due_date' => date("Y-m-d", strtotime($row['due_date'])),
                                'amount' => $row['amount'],
                            );
                            $this->db->where(array('fee_groups_id' => $groupID, 'fee_type_id' => $row['fees_type_id']));
                            $query = $this->db->get("fee_groups_details");
                            if ($query->num_rows() == 0) {
                                $this->db->insert('fee_groups_details', $arrayData);
                            }
                        }
                    }
                    set_alert('success', translate('information_has_been_saved_successfully'));
                } else {
                    set_alert('error', 'At least one type has to be selected.');
                }
                $url = base_url('fees/group');
                $array = array('status' => 'success', 'url' => $url);
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'error' => $error);
            }
            echo json_encode($array);
            exit();
        }
        $this->data['branch_id'] = $branch_id;
        $this->data['categorylist'] = $this->app_lib->getTable('fee_groups', array('t.session_id' => get_session_id()));
        $this->data['title'] = translate('fees_group');
        $this->data['sub_page'] = 'fees/group';
        $this->data['main_menu'] = 'fees';
        $this->load->view('layout/index', $this->data);
    }

    public function group_edit($id = '')
    {
        if (!get_permission('fees_group', 'is_edit')) {
            access_denied();
        }
        if ($_POST) {
            $this->form_validation->set_rules('name', translate('group_name'), 'trim|required');
            $elems = $this->input->post('elem');
            $sel = array();
            if (count($elems)) {
                foreach ($elems as $key => $value) {
                    if (isset($value['fees_type_id'])) {
                        $sel[] = $value['fees_type_id'];
                        $this->form_validation->set_rules('elem[' . $key . '][due_date]', translate('due_date'), 'trim|required');
                        $this->form_validation->set_rules('elem[' . $key . '][amount]', translate('amount'), 'trim|required|greater_than[0]');
                    }
                }
            }
            if ($this->form_validation->run() !== false) {
                if (count($sel)) {
                    $groupID = $this->input->post('group_id');
                    $arrayGroup = array(
                        'name' => $this->input->post('name'),
                        'description' => $this->input->post('description'),
                    );
                    $this->db->where('id', $groupID);
                    $this->db->update('fee_groups', $arrayGroup);
                    foreach ($elems as $key => $row) {
                        if (isset($row['fees_type_id'])) {
                            $arrayData = array(
                                'fee_groups_id' => $groupID,
                                'fee_type_id' => $row['fees_type_id'],
                                'due_date' => date("Y-m-d", strtotime($row['due_date'])),
                                'amount' => $row['amount'],
                            );
                            $this->db->where(array('fee_groups_id' => $groupID, 'fee_type_id' => $row['fees_type_id']));
                            $query = $this->db->get("fee_groups_details");
                            if ($query->num_rows() == 0) {
                                $this->db->insert('fee_groups_details', $arrayData);
                            } else {
                                $this->db->where('id', $query->row()->id);
                                $this->db->update('fee_groups_details', $arrayData);
                            }
                        }
                    }
                    $this->db->where_not_in('fee_type_id', $sel);
                    $this->db->where('fee_groups_id', $groupID);
                    $this->db->delete('fee_groups_details');
                    set_alert('success', translate('information_has_been_updated_successfully'));
                } else {
                    set_alert('error', 'At least one type has to be selected.');
                }
                $url = base_url('fees/group');
                $array = array('status' => 'success', 'url' => $url);
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'error' => $error);
            }
            echo json_encode($array);
            exit();
        }
        $this->data['group'] = $this->app_lib->getTable('fee_groups', array('t.id' => $id), true);
        $this->data['title'] = translate('fees_group');
        $this->data['sub_page'] = 'fees/group_edit';
        $this->data['main_menu'] = 'fees';
        $this->load->view('layout/index', $this->data);
    }

    public function group_delete($id)
    {
        if (get_permission('fees_group', 'is_delete')) {
            if (!is_superadmin_loggedin()) {
                $this->db->where('branch_id', get_loggedin_branch_id());
            }
            $this->db->where('id', $id);
            $this->db->delete('fee_groups');
            if ($this->db->affected_rows() > 0) {
                $this->db->where('fee_groups_id', $id);
                $this->db->delete('fee_groups_details');
            }
        }
    }

    /* fees type form validation rules */
    protected function fine_validation()
    {
        if (is_superadmin_loggedin()) {
            $this->form_validation->set_rules('branch_id', translate('branch'), 'required');
        }
        $this->form_validation->set_rules('group_id', translate('group_name'), 'trim|required');
        $this->form_validation->set_rules('fine_type_id', translate('fees_type'), 'trim|required|callback_check_feetype');
        $this->form_validation->set_rules('fine_type', translate('fine_type'), 'trim|required');
        $this->form_validation->set_rules('fine_value', translate('fine') . " " . translate('value'), 'trim|required|numeric|greater_than[0]');
        $this->form_validation->set_rules('fee_frequency', translate('late_fee_frequency'), 'trim|required');
    }

    public function fine_setup()
    {
        if (!get_permission('fees_fine_setup', 'is_view')) {
            access_denied();
        }
        $branchID = $this->application_model->get_branch_id();
        if ($_POST) {
            if (!get_permission('fees_fine_setup', 'is_add')) {
                ajax_access_denied();
            }
            $this->fine_validation();
            if ($this->form_validation->run() !== false) {
                $insertData = array(
                    'group_id' => $this->input->post('group_id'),
                    'type_id' => $this->input->post('fine_type_id'),
                    'fine_value' => $this->input->post('fine_value'),
                    'fine_type' => $this->input->post('fine_type'),
                    'fee_frequency' => $this->input->post('fee_frequency'),
                    'branch_id' => $branchID,
                    'session_id' => get_session_id(),
                );
                $this->db->insert('fee_fine', $insertData);
                set_alert('success', translate('information_has_been_saved_successfully'));
                $array = array('status' => 'success');
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'error' => $error);
            }
            echo json_encode($array);
            exit();
        }
        $this->data['finelist'] = $this->app_lib->getTable('fee_fine');
        $this->data['branch_id'] = $branchID;
        $this->data['title'] = translate('fine_setup');
        $this->data['main_menu'] = 'fees';
        $this->data['sub_page'] = 'fees/fine_setup';
        $this->load->view('layout/index', $this->data);
    }

    public function fine_setup_edit($id = '')
    {
        if (!get_permission('fees_fine_setup', 'is_edit')) {
            access_denied();
        }

        if ($_POST) {
            $branchID = $this->application_model->get_branch_id();
            $this->fine_validation();
            if ($this->form_validation->run() !== false) {
                $insertData = array(
                    'group_id' => $this->input->post('group_id'),
                    'type_id' => $this->input->post('fine_type_id'),
                    'fine_value' => $this->input->post('fine_value'),
                    'fine_type' => $this->input->post('fine_type'),
                    'fee_frequency' => $this->input->post('fee_frequency'),
                    'branch_id' => $branchID,
                    'session_id' => get_session_id(),
                );
                $this->db->where('id', $id);
                $this->db->update('fee_fine', $insertData);
                set_alert('success', translate('information_has_been_updated_successfully'));
                $url = base_url('fees/fine_setup');
                $array = array('status' => 'success', 'url' => $url);
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'error' => $error);
            }
            echo json_encode($array);
            exit();
        }
        $this->data['fine'] = $this->app_lib->getTable('fee_fine', array('t.id' => $id), true);
        $this->data['title'] = translate('fine_setup');
        $this->data['sub_page'] = 'fees/fine_setup_edit';
        $this->data['main_menu'] = 'fees';
        $this->load->view('layout/index', $this->data);
    }

    public function check_feetype($id)
    {
        $groupID = $this->input->post('group_id');
        $fineID = $this->input->post('fine_id');
        if (!empty($fineID)) {
            $this->db->where_not_in('id', $fineID);
        }
        $this->db->where('group_id', $groupID);
        $this->db->where('type_id', $id);
        $query = $this->db->get('fee_fine');
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message("check_feetype", translate('already_taken'));
            return false;
        } else {
            return true;
        }
    }

    public function fine_delete($id)
    {
        if (get_permission('fees_fine_setup', 'is_delete')) {
            if (!is_superadmin_loggedin()) {
                $this->db->where('branch_id', get_loggedin_branch_id());
            }
            $this->db->where('id', $id);
            $this->db->delete('fee_fine');
        }
    }

    public function allocation()
    {
        if (!get_permission('fees_allocation', 'is_add')) {
            access_denied();
        }
        $branchID = $this->application_model->get_branch_id();
        if (isset($_POST['search'])) {
            $this->data['class_id'] = $this->input->post('class_id');
            $this->data['section_id'] = $this->input->post('section_id');
            $this->data['fee_group_id'] = $this->input->post('fee_group_id');
            $this->data['branch_id'] = $branchID;
            $this->data['studentlist'] = $this->fees_model->getStudentAllocationList($this->data['class_id'], $this->data['section_id'], $this->data['fee_group_id'], $branchID);
        }
        if (isset($_POST['save'])) {
            $student_array = $this->input->post('stu_operations');
            $fee_groupID = $this->input->post('fee_group_id');
            foreach ($student_array as $key => $value) {
                $arrayData = array(
                    'student_id' => $value,
                    'group_id' => $fee_groupID,
                    'session_id' => get_session_id(),
                    'branch_id' => $branchID,
                );
                $this->db->where($arrayData);
                $q = $this->db->get('fee_allocation');
                if ($q->num_rows() == 0) {
                    $this->db->insert('fee_allocation', $arrayData);
                }
            }
            if (!empty($student_array)) {
                $this->db->where_not_in('student_id', $student_array);
            }
            $this->db->where('group_id', $fee_groupID);
            $this->db->where('session_id', get_session_id());
            $this->db->delete('fee_allocation');
            set_alert('success', translate('information_has_been_saved_successfully'));
            redirect(base_url('fees/allocation'));
        }
        $this->data['branch_id'] = $branchID;
        $this->data['title'] = translate('fees_allocation');
        $this->data['sub_page'] = 'fees/allocation';
        $this->data['main_menu'] = 'fees';
        $this->load->view('layout/index', $this->data);
    }

    /* student fees invoice search user interface */
    public function invoice_list()
    {
        if (!get_permission('invoice', 'is_view')) {
            access_denied();
        }

        $branchID = $this->application_model->get_branch_id();
        if ($this->input->post('search')) {
            $this->data['class_id'] = $this->input->post('class_id');
            $this->data['section_id'] = $this->input->post('section_id');
            $this->data['invoicelist'] = $this->fees_model->getInvoiceList($this->data['class_id'], $this->data['section_id'], $branchID);
        }
        $this->data['branch_id'] = $branchID;
        $this->data['title'] = translate('payments_history');
        $this->data['sub_page'] = 'fees/invoice_list';
        $this->data['main_menu'] = 'fees';
        $this->load->view('layout/index', $this->data);
    }

    function invoice_delete($student_id)
    {
        if (!get_permission('invoice', 'is_delete')) {
            access_denied();
        }

        if (!is_superadmin_loggedin()) {
            $this->db->where('branch_id', get_loggedin_branch_id());
        }
        $this->db->where('student_id', $student_id);
        $result = $this->db->get('fee_allocation')->result_array();
        foreach ($result as $key => $value) {
            $this->db->where('allocation_id', $value['id']);
            $this->db->delete('fee_payment_history');
        }

        if (!is_superadmin_loggedin()) {
            $this->db->where('branch_id', get_loggedin_branch_id());
        }
        $this->db->where('student_id', $student_id);
        $this->db->delete('fee_allocation');
    }

    /* invoice user interface with information are controlled here */
    public function invoice($id = '')
    {
        if (!get_permission('invoice', 'is_view')) {
            access_denied();
        }
        $this->data['invoice'] = $this->fees_model->getInvoiceStatus($id);
        $this->data['basic'] = $this->fees_model->getInvoiceBasic($id);
        $this->data['title'] = translate('invoice_history');
        $this->data['main_menu'] = 'fees';
        $this->data['sub_page'] = 'fees/collect';
        $this->load->view('layout/index', $this->data);
    }

    public function invoicePrint()
    {
        if (!get_permission('invoice', 'is_view')) {
            access_denied();
        }
        if ($_POST) {
            $this->data['student_array'] = $this->input->post('student_id');
            echo $this->load->view('fees/invoicePrint', $this->data, true);
        }  
    }

    public function due_invoice()
    {
        if (!get_permission('due_invoice', 'is_view')) {
            access_denied();
        }
        $branchID = $this->application_model->get_branch_id();
        if ($this->input->post('search')) {
            $this->data['class_id'] = $this->input->post('class_id');
            $this->data['section_id'] = $this->input->post('section_id');
            $feegroup = explode("|", $this->input->post('fees_type'));

            $feegroup_id = $feegroup[0];
            $fee_feetype_id = $feegroup[1];
            $this->data['invoicelist'] = $this->fees_model->getDueInvoiceList($this->data['class_id'], $this->data['section_id'], $feegroup_id, $fee_feetype_id);
        }
        $this->data['branch_id'] = $branchID;
        $this->data['title'] = translate('payments_history');
        $this->data['sub_page'] = 'fees/due_invoice';
        $this->data['main_menu'] = 'fees';
        $this->load->view('layout/index', $this->data);
    }

    public function fee_add()
    {
        if (!get_permission('collect_fees', 'is_add')) {
            ajax_access_denied();
        }
        $this->form_validation->set_rules('fees_type', translate('fees_type'), 'trim|required');
        $this->form_validation->set_rules('date', translate('date'), 'trim|required');
        $this->form_validation->set_rules('amount', translate('amount'), array('trim','required','numeric','greater_than[0]',array('deposit_verify', array($this->fees_model, 'depositAmountVerify'))));
        $this->form_validation->set_rules('pay_via', translate('payment_method'), 'trim|required');
        if ($this->form_validation->run() !== false) {
            $feesType = explode("|", $this->input->post('fees_type'));
            $amount = $this->input->post('amount');
            $fineAmount = $this->input->post('fine_amount');
            $discountAmount = $this->input->post('discount_amount');
            $date = $this->input->post('date');
            $payVia = $this->input->post('pay_via');
            $arrayFees = array(
                'allocation_id' => $feesType[0],
                'type_id' => $feesType[1],
                'collect_by' => get_loggedin_user_id(),
                'amount' => $amount,
                'discount' => $discountAmount,
                'fine' => $fineAmount,
                'pay_via' => $payVia,
                'remarks' => $this->input->post('remarks'),
                'date' => $date,
            );
            $this->db->insert('fee_payment_history', $arrayFees);
            
            // transaction voucher save function
            if (isset($_POST['account_id'])) {
                $arrayTransaction = array(
                    'account_id' => $this->input->post('account_id'),
                    'amount' => ($amount + $fineAmount) - $discountAmount,
                    'date' => $date,
                );
                $this->fees_model->saveTransaction($arrayTransaction);
            }

            // send payment confirmation sms
            if (isset($_POST['guardian_sms'])) {
                $arrayData = array(
                    'student_id' => $this->input->post('student_id'), 
                    'amount' => $amount, 
                    'paid_date' => $date, 
                );
                $this->sms_model->send_sms($arrayData, 2);
            }
            set_alert('success', translate('information_has_been_saved_successfully'));
            $array = array('status' => 'success');
        } else {
            $error = $this->form_validation->error_array();
            $array = array('status' => 'fail', 'url' => '', 'error' => $error);
        }
        echo json_encode($array);
    }

    public function getBalanceByType()
    {
        $input = $this->input->post('typeID');
        if (empty($input)) {
            $balance = 0;
            $fine = 0;
        } else {
            $feesType = explode("|", $input);
            $fine = $this->fees_model->feeFineCalculation($feesType[0], $feesType[1]);
            $b = $this->fees_model->getBalance($feesType[0], $feesType[1]);
            $balance = $b['balance'];
            $fine = abs($fine - $b['fine']);
        }
        echo json_encode(array('balance' => $balance, 'fine' => $fine));
    }

    public function getTypeByBranch()
    {
        $html = "";
        $branchID = $this->application_model->get_branch_id();
        $typeID = (isset($_POST['type_id']) ? $_POST['type_id'] : 0);
        if (!empty($branchID)) {
            $this->db->where('session_id', get_session_id());
            $this->db->where('branch_id', $branchID);
            $result = $this->db->get('fee_groups')->result_array();
            if (count($result)) {
                $html .= "<option value=''>" . translate('select') . "</option>";
                foreach ($result as $row) {
                    $html .= '<optgroup label="' . $row['name'] . '">';
                        $this->db->where('fee_groups_id', $row['id']);
                        $resultdetails = $this->db->get('fee_groups_details')->result_array();
                        foreach ($resultdetails as $t) {
                            $sel = ($t['fee_groups_id'] . "|" . $t['fee_type_id'] == $typeID ? 'selected' : '');
                            $html .= '<option value="' . $t['fee_groups_id'] . "|" . $t['fee_type_id'] . '"' . $sel . '>' . get_type_name_by_id('fees_type', $t['fee_type_id']) . '</option>';
                        }
                    $html .= '</optgroup>';
                }
            } else {
                $html .= '<option value="">' . translate('no_information_available') . '</option>';
            }
        } else {
            $html .= '<option value="">' . translate('select_branch_first') . '</option>';
        }
        echo $html;
    }

    public function getGroupByBranch()
    {
        $html = "";
        $branch_id = $this->application_model->get_branch_id();
        if (!empty($branch_id)) {
            $result = $this->db->select('id,name')
            ->where(array('branch_id' => $branch_id, 'session_id' => get_session_id()))
            ->get('fee_groups')->result_array();
            if (count($result)) {
                $html .= "<option value=''>" . translate('select') . "</option>";
                foreach ($result as $row) {
                    $html .= '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                }
            } else {
                $html .= '<option value="">' . translate('no_information_available') . '</option>';
            }
        } else {
            $html .= '<option value="">' . translate('select_branch_first') . '</option>';
        }
        echo $html;
    }

    public function getTypeByGroup()
    {
        $html = "";
        $groupID = $this->input->post('group_id');
        $typeID = (isset($_POST['type_id']) ? $_POST['type_id'] : 0);
        if (!empty($groupID)) {
            $this->db->select('t.id,t.name');
            $this->db->from('fee_groups_details as gd');
            $this->db->join('fees_type as t','t.id = gd.fee_type_id', 'left');
            $this->db->where('gd.fee_groups_id', $groupID);
            $result = $this->db->get()->result_array();
            if (count($result)) {
                $html .= "<option value=''>" . translate('select') . "</option>";
                foreach ($result as $row) {
                    $sel = ($row['id'] == $typeID ? 'selected' : '');
                    $html .= '<option value="' . $row['id'] . '" ' . $sel . '>' . $row['name'] . '</option>';
                }
            } else {
                $html .= '<option value="">' . translate('no_information_available') . '</option>';
            }
        } else {
            $html .= '<option value="">' . translate('first_select_the_group') . '</option>';
        }
        echo $html;
    }

    protected function reminder_validation()
    {
        if (is_superadmin_loggedin()) {
            $this->form_validation->set_rules('branch_id', translate('branch'), 'required');
        }
        $this->form_validation->set_rules('frequency', translate('frequency'), 'trim|required');
        $this->form_validation->set_rules('days', translate('days'), 'trim|required|numeric');
        $this->form_validation->set_rules('message', translate('message'), 'trim|required'); 
    }

    public function reminder()
    {
        if (!get_permission('fees_reminder', 'is_view')) {
            access_denied();
        }
        $branchID = $this->application_model->get_branch_id();
        if ($_POST) {
            if (!get_permission('fees_reminder', 'is_add')) {
                ajax_access_denied();
            }
            $this->reminder_validation();
            if ($this->form_validation->run() !== false) {
                $post = $this->input->post();
                $post['branch_id'] = $branchID;
                $this->fees_model->reminderSave($post);
                set_alert('success', translate('information_has_been_saved_successfully'));
                $array = array('status' => 'success');
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'error' => $error);
            }
            echo json_encode($array);
            exit();
        }
        $this->data['branch_id'] = $branchID;
        $this->data['reminderlist'] = $this->app_lib->getTable('fees_reminder');
        $this->data['title'] = translate('fees_reminder');
        $this->data['main_menu'] = 'fees';
        $this->data['sub_page'] = 'fees/reminder';
        $this->load->view('layout/index', $this->data);
    }

    public function edit_reminder($id='')
    {
        if (!get_permission('fees_reminder', 'is_edit')) {
            ajax_access_denied();
        }
        $branchID = $this->application_model->get_branch_id();
        if ($_POST) {
            $this->reminder_validation();
            if ($this->form_validation->run() !== false) {
                $post = $this->input->post();
                $post['branch_id'] = $branchID;
                $this->fees_model->reminderSave($post);
                $url = base_url('fees/reminder');
                set_alert('success', translate('information_has_been_updated_successfully'));
                $array = array('status' => 'success', 'url' => $url);
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'error' => $error);
            }
            echo json_encode($array);
            exit();
        }
        $this->data['reminder'] = $this->app_lib->getTable('fees_reminder', array('t.id' => $id), true);
        $this->data['title'] = translate('fees_reminder');
        $this->data['main_menu'] = 'fees';
        $this->data['sub_page'] = 'fees/edit_reminder';
        $this->load->view('layout/index', $this->data);
    }

    public function reminder_delete($id='')
    {
        if (get_permission('fees_reminder', 'is_delete')) {
            if (!is_superadmin_loggedin()) {
                $this->db->where('branch_id', get_loggedin_branch_id());
            }
            $this->db->where('id', $id);
            $this->db->delete('fees_reminder');
        }
    }

    public function due_report()
    {
        if (!get_permission('fees_reports', 'is_view')) {
            access_denied();
        }
        $branchID = $this->application_model->get_branch_id();
        if ($this->input->post('search')) {
            $this->data['class_id'] = $this->input->post('class_id');
            $this->data['section_id'] = $this->input->post('section_id');
            $this->data['invoicelist'] = $this->fees_model->getDueReport($this->data['class_id'], $this->data['section_id']);
        }
        $this->data['branch_id'] = $branchID;
        $this->data['title'] = translate('due_fees_report');
        $this->data['sub_page'] = 'fees/due_report';
        $this->data['main_menu'] = 'fees_repots';
        $this->load->view('layout/index', $this->data);
    }

    public function payment_history()
    {
        if (!get_permission('fees_reports', 'is_view')) {
            access_denied();
        }
        $branchID = $this->application_model->get_branch_id();
        if ($this->input->post('search')) {
            $classID = $this->input->post('class_id');
            $paymentVia  = $this->input->post('payment_via');
            $daterange = explode(' - ', $this->input->post('daterange'));
            $start = date("Y-m-d", strtotime($daterange[0]));
            $end = date("Y-m-d", strtotime($daterange[1]));
            $this->data['invoicelist'] = $this->fees_model->getStuPaymentHistory($classID, "", $paymentVia, $start, $end, $branchID);
        }
        $this->data['branch_id'] = $branchID;
        $this->data['title'] = translate('fees_payment_history');
        $this->data['sub_page'] = 'fees/payment_history';
        $this->data['main_menu'] = 'fees_repots';
        $this->data['headerelements']   = array(
            'css' => array(
                'vendor/daterangepicker/daterangepicker.css',
            ),
            'js' => array(
                'vendor/moment/moment.js',
                'vendor/daterangepicker/daterangepicker.js',
            ),
        );
        $this->load->view('layout/index', $this->data);
    }


    public function student_fees_report()
    {
        if (!get_permission('fees_reports', 'is_view')) {
            access_denied();
        }
        $branchID = $this->application_model->get_branch_id();
        if ($this->input->post('search')) {
            $classID = $this->input->post('class_id');
            $sectionID  = $this->input->post('section_id');
            $studentID  = $this->input->post('student_id');
            $typeID  = $this->input->post('fees_type');
            $daterange = explode(' - ', $this->input->post('daterange'));
            $start = date("Y-m-d", strtotime($daterange[0]));
            $end = date("Y-m-d", strtotime($daterange[1]));
            $this->data['invoicelist'] = $this->fees_model->getStuPaymentReport($classID, $sectionID, $studentID, $typeID, $start, $end, $branchID);
        }
        $this->data['branch_id'] = $branchID;
        $this->data['title'] = translate('student_fees_report');
        $this->data['sub_page'] = 'fees/student_fees_report';
        $this->data['main_menu'] = 'fees_repots';
        $this->data['headerelements']   = array(
            'css' => array(
                'vendor/daterangepicker/daterangepicker.css',
            ),
            'js' => array(
                'vendor/moment/moment.js',
                'vendor/daterangepicker/daterangepicker.js',
            ),
        );
        $this->load->view('layout/index', $this->data);
    }

    public function fine_report()
    {
        if (!get_permission('fees_reports', 'is_view')) {
            access_denied();
        }
        $branchID = $this->application_model->get_branch_id();
        if ($this->input->post('search')) {
            $classID = $this->input->post('class_id');
            $sectionID  = $this->input->post('section_id');
            $paymentVia  = $this->input->post('payment_via');
            $daterange = explode(' - ', $this->input->post('daterange'));
            $start = date("Y-m-d", strtotime($daterange[0]));
            $end = date("Y-m-d", strtotime($daterange[1]));
            $this->data['invoicelist'] = $this->fees_model->getStuPaymentHistory($classID, $sectionID ,$paymentVia, $start, $end, $branchID, true);
        }
        $this->data['branch_id'] = $branchID;
        $this->data['title'] = translate('fees_fine_reports');
        $this->data['sub_page'] = 'fees/fine_report';
        $this->data['main_menu'] = 'fees_repots';
        $this->data['headerelements']   = array(
            'css' => array(
                'vendor/daterangepicker/daterangepicker.css',
            ),
            'js' => array(
                'vendor/moment/moment.js',
                'vendor/daterangepicker/daterangepicker.js',
            ),
        );
        $this->load->view('layout/index', $this->data);
    }

}
