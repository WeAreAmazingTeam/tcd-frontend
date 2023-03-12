<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

		if ($this->session->has_userdata('id') == null) {
            redirect('auth/login');
        }

        if ($this->session->userdata('role') == "user") {
            redirect('user/dashboard');
        }
	}

	public function index()
	{
		redirect('admin/dashboard');
	}

    public function dashboard()
	{
		$data['title'] = "Dashboard";
		$data['content'] = $this->load->view('admin/dashboard/index', NULL, TRUE);
		$data['custom_script'] = $this->load->view('admin/dashboard/index_script', NULL, TRUE);

		$this->load->view('admin/base', $data);
	}

	public function users()
	{
		$data['title'] = "Users";
		$data['content'] = $this->load->view('admin/users/index', NULL, TRUE);
		$data['custom_script'] = $this->load->view('admin/users/index_script', NULL, TRUE);

		$this->load->view('admin/base', $data);
	}

	public function categories()
	{
		$data['title'] = "Categories";
		$data['content'] = $this->load->view('admin/categories/index', NULL, TRUE);
		$data['custom_script'] = $this->load->view('admin/categories/index_script', NULL, TRUE);

		$this->load->view('admin/base', $data);
	}

    public function campaigns()
	{
		$data['title'] = "Campaigns";
		$data['content'] = $this->load->view('admin/campaigns/index', NULL, TRUE);
		$data['custom_script'] = $this->load->view('admin/campaigns/index_script', NULL, TRUE);


		$this->load->view('admin/base', $data);
	}

	public function transactions()
	{
		$data['title'] = "Transactions";
		$data['content'] = $this->load->view('admin/transactions/index', NULL, TRUE);
		$data['custom_script'] = $this->load->view('admin/transactions/index_script', NULL, TRUE);

		$this->load->view('admin/base', $data);
	}

	public function logs_activity()
	{
		$data['title'] = "Activity Logs";
		$data['content'] = $this->load->view('admin/logs/activity', NULL, TRUE);
		$data['custom_script'] = $this->load->view('admin/logs/activity_script', NULL, TRUE);

		$this->load->view('admin/base', $data);
	}

	public function settings()
	{
		$data['title'] = "Account Setting";
		$data['content'] = $this->load->view('admin/settings/index', $data, TRUE);
		$data['custom_script'] = $this->load->view('admin/settings/index_script', NULL, TRUE);

		$this->load->view('admin/base', $data);
	}

	public function wallet()
	{
		$data['title'] = "Wallet Management";
		$data['content'] = $this->load->view('admin/wallet/index', $data, TRUE);
		$data['custom_script'] = $this->load->view('admin/wallet/index_script', NULL, TRUE);

		$this->load->view('admin/base', $data);
	}

	public function withdrawal_requests()
	{
		$data['title'] = "Withdrawal Requests";
		$data['content'] = $this->load->view('admin/withdrawal_requests/index', $data, TRUE);
		$data['custom_script'] = $this->load->view('admin/withdrawal_requests/index_script', NULL, TRUE);

		$this->load->view('admin/base', $data);
	}

	public function company_cash_flow()
	{
		$data['title'] = "Company Cash Flow";
		$data['content'] = $this->load->view('admin/company_cash_flow/index', $data, TRUE);
		$data['custom_script'] = $this->load->view('admin/company_cash_flow/index_script', NULL, TRUE);

		$this->load->view('admin/base', $data);
	}
}