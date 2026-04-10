<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Userrole_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getTeachersList($branchID = '')
    {
        $this->db->select('staff.*,staff_designation.name as designation_name,staff_department.name as department_name,login_credential.role as role_id, roles.name as role');
        $this->db->from('staff');
        $this->db->join('login_credential', 'login_credential.user_id = staff.id and login_credential.role != "6" and login_credential.role != "7"', 'inner');
        $this->db->join('roles', 'roles.id = login_credential.role', 'left');
        $this->db->join('staff_designation', 'staff_designation.id = staff.designation', 'left');
        $this->db->join('staff_department', 'staff_department.id = staff.department', 'left');
        if ($branchID != "") {
            $this->db->where('staff.branch_id', $branchID);
        }
        $this->db->where('login_credential.role', 3);
        $this->db->where('login_credential.active', 1);
        $this->db->order_by('staff.id', 'ASC');
        return $this->db->get()->result();
    }

    // get route information by route id and vehicle id
    public function getRouteDetails($routeID, $vehicleID)
    {
        $this->db->select('ta.route_id,ta.stoppage_id,ta.vehicle_id,r.name as route_name,r.start_place,r.stop_place,sp.stop_position,sp.stop_time,sp.route_fare,v.vehicle_no,v.driver_name,v.driver_phone');
        $this->db->from('transport_assign as ta');
        $this->db->join('transport_route as r', 'r.id = ta.route_id', 'left');
        $this->db->join('transport_vehicle as v', 'v.id = ta.vehicle_id', 'left');
        $this->db->join('transport_stoppage as sp', 'sp.id = ta.stoppage_id', 'left');
        $this->db->where('ta.route_id', $routeID);
        $this->db->where('ta.vehicle_id', $vehicleID);
        return $this->db->get()->row_array();
    }

    public function getAssignList($branch_id = '')
    {
        $this->db->select('ta.route_id,ta.stoppage_id,ta.branch_id,r.name,r.start_place,r.stop_place,sp.stop_position,sp.stop_time,sp.route_fare');
        $this->db->from('transport_assign as ta');
        $this->db->join('transport_route as r', 'r.id = ta.route_id', 'left');
        $this->db->join('transport_stoppage as sp', 'sp.id = ta.stoppage_id', 'left');
        $this->db->group_by(array('ta.route_id', 'ta.stoppage_id', 'ta.branch_id'));
        if (!empty($branch_id)) {
            $this->db->where('ta.branch_id', $branch_id);
        }
        return $this->db->get()->result_array();
    }

    // get vehicle list by route_id
    public function getVehicleList($route_id)
    {
        $this->db->select('ta.vehicle_id,v.vehicle_no');
        $this->db->from('transport_assign as ta');
        $this->db->join('transport_vehicle as v', 'v.id = ta.vehicle_id', 'left');
        $this->db->where('ta.route_id', $route_id);
        $vehicles = $this->db->get()->result();
        $name_list = '';
        foreach ($vehicles as $row) {
            $name_list .= '- ' . $row->vehicle_no . '<br>';
        }
        return $name_list;
    }

    // get hostel information by hostel id and room id
    public function getHostelDetails($hostelID, $roomID)
    {
        $this->db->select('h.name as hostel_name,h.watchman,h.category_id,h.address,hc.name as hcategory_name,rc.name as rcategory_name,hr.name as room_name,hr.no_beds,hr.bed_fee');
        $this->db->from('hostel as h');
        $this->db->join('hostel_category as hc', 'hc.id = h.category_id', 'left');
        $this->db->join('hostel_room as hr', 'hr.hostel_id = h.id', 'left');
        $this->db->join('hostel_category as rc', 'rc.id = hr.category_id', 'left');
        $this->db->where('hr.id', $roomID);
        $this->db->where('h.id', $hostelID);
        return $this->db->get()->row();
    }

    // check attendance by staff id and date
    public function get_attendance_by_date($studentID, $date)
    {
        $sql = "SELECT student_attendance.* FROM student_attendance WHERE student_id = " . $this->db->escape($studentID) . " AND date = " . $this->db->escape($date);
        return $this->db->query($sql)->row_array();
    }

   
    public function getStudentDetails()
    {
        if (is_student_loggedin()) {
            $studentID = get_loggedin_user_id();
        } elseif (is_parent_loggedin()) {
            $studentID = get_activeChildren_id();
        }
        $this->db->select('CONCAT(s.first_name, " ", s.last_name) as fullname,s.email as student_email,e.branch_id,e.student_id,s.hostel_id,s.room_id,s.route_id,s.vehicle_id,e.class_id,e.section_id,c.name as class_name,se.name as section_name,b.school_name,b.email as school_email,b.mobileno as school_mobileno,b.address as school_address');
        $this->db->from('enroll as e');
        $this->db->join('student as s', 's.id = e.student_id', 'inner');
        $this->db->join('branch as b', 'b.id = e.branch_id', 'left');
        $this->db->join('class as c', 'c.id = e.class_id', 'left');
        $this->db->join('section as se', 'se.id = e.section_id', 'left');
        $this->db->where('s.id', $studentID);
        return $this->db->get()->row_array();
    }

    public function getHomeworkList($studentID)
    {
        $this->db->select('homework.*,CONCAT(s.first_name, " ",s.last_name) as fullname,s.register_no,e.student_id, e.roll,subject.name as subject_name,class.name as class_name,section.name as section_name,he.id as ev_id,he.status as ev_status,he.remark as ev_remarks,he.rank');
        $this->db->from('homework');
        $this->db->join('enroll as e', 'e.class_id=homework.class_id and e.section_id = homework.section_id and e.session_id = homework.session_id', 'inner');
        $this->db->join('student as s', 'e.student_id = s.id', 'inner');
        $this->db->join('homework_evaluation as he', 'he.homework_id = homework.id and he.student_id = e.student_id', 'left');
        $this->db->join('subject', 'subject.id = homework.subject_id', 'left');
        $this->db->join('class', 'class.id = homework.class_id', 'left');
        $this->db->join('section', 'section.id = homework.section_id', 'left');
        $this->db->where('e.student_id', $studentID);
        if (!is_superadmin_loggedin()) {
            $this->db->where('homework.branch_id', get_loggedin_branch_id());
        }
        $this->db->where('homework.status', 0);
        $this->db->where('homework.session_id', get_session_id());
        $this->db->order_by('homework.id', 'desc');
        return $this->db->get()->result_array();
    }

}
