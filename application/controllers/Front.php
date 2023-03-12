<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->helper('x_helper');
	}

	public function index()
	{
		$data['title'] = 'Home';
		$this->load->view('home', $data);
	}

	public function about()
	{
		$data['title'] = "About";
		$this->load->view('about', $data);
	}

	public function donation()
	{
		$data['title'] = "List of Donations";

		$this->load->view('donation', $data);
	}

	public function donation_detail($id)
	{
		$curl = curl_init();
		$url = "{$_ENV['API_URL']}/campaigns/{$id}";

		curl_setopt_array($curl, [
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1
		]);

		$response = curl_exec($curl);

		if (curl_errno($curl)) {
			$error_msg = strtolower(curl_error($curl));
		}

		curl_close($curl);

		$result = json_decode($response, true);

		if (@$result['success']) {
			$data_response = [
				'message' => $result['message'],
				'status' => $result['success'],
				'data' => $result['data'],
			];
		} else {
			if (isset($result['message'])) {
				$data_response = [
					'message' => $result['message'],
					'status' => $result['success'],
					'error' => $result['error']
				];
			} else {
				if (isset($error_msg)) {
					$data_response = [
						'message' => "CURL error, err: {$error_msg}",
						'status' => false,
						'error' => "CURL error, err: {$error_msg}"
					];
				} else {
					$data_response = [
						'message' => "unexpected error!",
						'status' => false,
						'error' => "unexpected error!"
					];
				}
			}

			echo "<script>
				alert(`{$data_response['error']}`);
				window.location.href = `".site_url("donations")."`;;
			</script>";
			exit;
		}

		$data['title'] = "Donation Detail";
		$data['data'] = $data_response['data'];
		$data['percentage'] = round($data['data']["current_amount"] / $data['data']["goal_amount"] * 100);
		$data['percentage'] = $data['percentage'] > 100 ? "100" : $data['percentage'];

		$this->load->view('donation_detail', $data);
	}

}
