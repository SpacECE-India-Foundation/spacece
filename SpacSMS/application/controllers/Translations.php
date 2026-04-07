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

class Translations extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (!get_permission('translations', 'is_view')) {
            access_denied();
        }
        $this->data['edit_language'] = '';
        $this->data['sub_page'] = 'language/index';
        $this->data['main_menu'] = 'settings';
        $this->data['title'] = translate('translations');
        $this->data['headerelements'] = array(
            'css' => array(
                'vendor/dropify/css/dropify.min.css',
                'vendor/bootstrap-toggle/css/bootstrap-toggle.min.css',
            ),
            'js' => array(
                'vendor/dropify/js/dropify.min.js',
                'vendor/bootstrap-toggle/js/bootstrap-toggle.min.js',
            ),
        );
        $this->load->view('layout/index', $this->data);
    }

    public function set_language($action = '')
    {
        if (is_loggedin()) {
            $this->session->set_userdata('set_lang', $action);
            if (!empty($_SERVER['HTTP_REFERER'])) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect(base_url('dashboard'), 'refresh');
            }
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function update()
    {
        if (!get_permission('translations', 'is_edit')) {
            access_denied();
        }
        $language = html_escape($this->input->get('lang'));
        if (!empty($language)) {
            $query_language = $this->db->query("SELECT `id`, `word`, `$language` FROM `languages`");
            if ($this->input->post('submit') == 'update') {
                if ($query_language->num_rows() > 0) {
                    $words = $query_language->result();
                    foreach ($words as $row) {
                        $word = $this->input->post('word_' . $row->word);
                        if (!empty($word)) {
                            $this->db->where('word', $row->word);
                            $this->db->update('languages', array($language => $word));
                        }
                    }
                    $this->db->where('lang_field', $language);
                    $this->db->update('language_list', array(
                        'updated_at' => date('Y-m-d H:i:s'),
                    ));
                }
                set_alert('success', translate('information_has_been_updated_successfully'));
                redirect(base_url('translations'));
            }
            $this->data['select_language'] = $language;
            $this->data['query_language'] = $query_language;
            $this->data['sub_page'] = 'language/index';
            $this->data['main_menu'] = 'settings';
            $this->data['title'] = translate('translations');
            $this->load->view('layout/index', $this->data);
        } else {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
    }

    public function submitted_data($action = '', $id = '')
    {
        if ($action == 'create') {
            if (!get_permission('translations', 'is_add')) {
                access_denied();
            }
            $language = $this->input->post('name', true);
            $this->db->insert('language_list', array('name' => ucfirst($language)));
            $id = $this->db->insert_id();

            if (!empty($_FILES["flag"]["name"])) {
                move_uploaded_file($_FILES['flag']['tmp_name'], 'uploads/language_flags/flag_' . $id . '.png');
                $this->create_thumb('uploads/language_flags/flag_' . $id . '.png');
            }

            $language = 'lang_' . $id;
            $this->db->where('id', $id);
            $this->db->update('language_list', array(
                'lang_field' => $language,
            ));

            $this->load->dbforge();
            $fields = array(
                $language => array(
                    'type' => 'LONGTEXT',
                    'collation' => 'utf8_unicode_ci',
                    'null' => true,
                    'default' => '',
                ),
            );
            $res = $this->dbforge->add_column('languages', $fields);
            if ($res == true) {
                set_alert('success', translate('information_has_been_saved_successfully'));
            } else {
                set_alert('error', translate('information_add_failed'));
            }
            redirect(base_url('translations'));
        }

        if ($action == 'rename') {
            if (!get_permission('translations', 'is_edit')) {
                access_denied();
            }
            $language = $this->input->post('rename', true);
            $this->db->where('id', $id);
            $this->db->update('language_list', array(
                'name' => $language,
            ));

            if (!empty($_FILES["flag"]["name"])) {
                move_uploaded_file($_FILES['flag']['tmp_name'], 'uploads/language_flags/flag_' . $id . '.png');
                $this->create_thumb('uploads/language_flags/flag_' . $id . '.png');
            }

            set_alert('success', translate('information_has_been_updated_successfully'));
            redirect(base_url('translations'));
        }

        if ($action == 'delete') {
            if (!get_permission('translations', 'is_delete')) {
                access_denied();
            }
            $lang = $this->db->select('lang_field')->where('id', $id)->get('language_list')->row()->lang_field;
            $this->load->dbforge();
            $this->dbforge->drop_column('languages', $lang);
            $this->db->where('id', $id);
            $this->db->delete('language_list');
            if (file_exists('uploads/language_flags/flag_' . $id . '.png')) {
                unlink('uploads/language_flags/flag_' . $id . '.png');
                unlink('uploads/language_flags/flag_' . $id . '_thumb.png');
            }
        }
    }

    public function create_thumb($source)
    {
        ini_set('memory_limit', '-1');
        $config['image_library'] = 'gd2';
        $config['create_thumb'] = true;
        $config['maintain_ratio'] = true;
        $config['width'] = 16;
        $config['height'] = 12;
        $config['source_image'] = $source;
        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
        $this->image_lib->clear();
    }

    /* language publish/unpublished */
    public function status()
    {
        if (is_superadmin_loggedin()) {
            $id = $this->input->post('lang_id');
            $status = $this->input->post('status');
            if ($status == 'true') {
                $array_data['status'] = 1;
                $message = translate('language_published');
            } else {
                $array_data['status'] = 0;
                $message = translate('language_unpublished');
            }
            $this->db->where('id', $id);
            $this->db->update('language_list', $array_data);
            echo $message;
        }
    }

    public function get_details()
    {
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $query = $this->db->get('language_list');
        $result = $query->row_array();
        echo json_encode($result);
    }
}
