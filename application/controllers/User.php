<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->has_userdata('id') == null) {
            redirect('auth/login');
        }

        if ($this->session->userdata('role') == "admin") {
            redirect('admin/dashboard');
        }
	}

    public function index()
	{
		redirect('user/dashboard');
	}

    public function dashboard()
	{
		$data['title'] = "Dashboard";
        $data['content'] = $this->load->view('user/dashboard/index', NULL, TRUE);
		$data['custom_script'] = $this->load->view('user/dashboard/index_script', NULL, TRUE);

		$this->load->view('user/base', $data);
	}

    public function campaigns()
	{
		$data['title'] = "Campaigns";
		$data['content'] = $this->load->view('user/campaigns/index', NULL, TRUE);
		$data['custom_script'] = $this->load->view('user/campaigns/index_script', NULL, TRUE);

		$this->load->view('user/base', $data);
	}

    public function transactions()
	{
		$data['title'] = "Transactions";
		$data['content'] = $this->load->view('user/transactions/index', NULL, TRUE);
		$data['custom_script'] = $this->load->view('user/transactions/index_script', NULL, TRUE);

		$this->load->view('user/base', $data);
	}

    public function settings()
	{
		$data['title'] = "Account Setting";
		$data['content'] = $this->load->view('user/settings/index', $data, TRUE);
		$data['custom_script'] = $this->load->view('user/settings/index_script', NULL, TRUE);

		$this->load->view('user/base', $data);
	}

	public function wallet()
	{
		$data['title'] = "Wallet Management";
		$data['content'] = $this->load->view('user/wallet/index', $data, TRUE);
		$data['custom_script'] = $this->load->view('user/wallet/index_script', NULL, TRUE);

		$this->load->view('user/base', $data);
	}
}
