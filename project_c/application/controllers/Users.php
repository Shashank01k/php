<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Load database
        $this->load->database();

        // Load model
        $this->load->model('User_model');

        // Load helpers
        $this->load->helper(['url', 'form']);

        // Load validation library
        $this->load->library('form_validation');
    }

    public function register()
    {
        // Validation rules
        $this->form_validation->set_rules(
            'name',
            'Name',
            'trim|required|min_length[2]|max_length[100]'
        );

        $this->form_validation->set_rules(
            'email',
            'Email',
            'trim|required|valid_email|max_length[150]'
        );

        $this->form_validation->set_rules(
            'mobile',
            'Mobile',
            'trim|required|regex_match[/^[0-9]{10,15}$/]'
        );

        $this->form_validation->set_rules(
            'gender',
            'Gender',
            'required|in_list[Male,Female,Other]'
        );

        $this->form_validation->set_rules(
            'state_id',
            'State',
            'required|is_natural_no_zero'
        );

        // If form submitted and validation passes
        if ($this->form_validation->run() === TRUE) {

            $email = trim($this->input->post('email'));

            // Check duplicate email
            if ($this->User_model->email_exists($email)) {

                $data['error'] = 'This email is already registered.';

            } else {

                // Get form data
                $insertData = [
                    'name'       => trim($this->input->post('name')),
                    'email'      => $email,
                    'mobile'     => trim($this->input->post('mobile')),
                    'gender'     => $this->input->post('gender'),
                    'state_id'   => (int) $this->input->post('state_id'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                // Insert into database
                if ($this->User_model->insert_user($insertData)) {

                    $data['success'] = 'User registered successfully.';

                    // redirect('users');

                } else {

                    $data['error'] = 'Something went wrong. Please try again.';
                }
            }
        }

        // Get states for dropdown
        $data['states'] = $this->db
            ->order_by('name', 'ASC')
            ->where('country_id', 101)
            ->get('states')
            ->result();

        // Load form
        $this->load->view('users/create', $data);
    }

    public function index()
    {
        $data['users'] = $this->User_model->get_users();

        $this->load->view('users/index', $data);
    }

    public function edit($id)
    {
        // Get user
        $data['user'] = $this->User_model->get_user_by_id($id);

        // Check user exists
        if (!$data['user']) {
            show_404();
        }

        // Get states
        $data['states'] = $this->db
            ->order_by('name', 'ASC')
            ->where('country_id', 101)
            ->get('states')
            ->result();

        // Validation rules
        $this->form_validation->set_rules(
            'name',
            'Name',
            'trim|required|min_length[2]|max_length[100]'
        );

        $this->form_validation->set_rules(
            'mobile',
            'Mobile',
            'trim|required|regex_match[/^[0-9]{10,15}$/]'
        );

        $this->form_validation->set_rules(
            'gender',
            'Gender',
            'required|in_list[Male,Female,Other]'
        );

        $this->form_validation->set_rules(
            'state_id',
            'State',
            'required|is_natural_no_zero'
        );

        // Form submitted
        if ($this->form_validation->run() === TRUE) {

            /*
            * IMPORTANT:
            * Email is intentionally NOT included here.
            *
            * Therefore email can never be changed
            * through this update operation.
            */
            $updateData = [
                'name'       => trim($this->input->post('name')),
                'mobile'     => trim($this->input->post('mobile')),
                'gender'     => $this->input->post('gender'),
                'state_id'   => (int) $this->input->post('state_id'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            if ($this->User_model->update_user($id, $updateData)) {

                redirect('users');
            }

            $data['error'] = 'Unable to update user. Please try again.';
        }

        // Show edit form
        $this->load->view('users/edit', $data);
    }

    public function delete($id)
    {
        // Only allow POST requests
        if ($this->input->method() !== 'post') {
            show_error('Invalid request method.', 405);
        }

        // Check whether user exists
        $user = $this->User_model->get_user_by_id($id);

        if (!$user) {
            show_404();
        }

        // Delete user
        if ($this->User_model->delete_user($id)) {

            redirect('users');
        }

        show_error('Unable to delete user. Please try again.');
    }
}