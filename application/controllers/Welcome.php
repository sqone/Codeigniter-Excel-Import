<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->library(array(
			'custom_upload',
			'form_validation'
		));
		$this->load->helper('url');
	}

	public function index() {
		$this->load->view('welcome_message');
	}

	public function multiple_upload() {
		$file = $this->custom_upload->multiple_upload('file', array(
			'upload_path' => 'upload/multiple',
			'allowed_types' => 'jpg|jpeg|bmp|png|gif' // etc
		));

		$image = array();
		foreach ($file as $f) {
			array_push($image, array(
				'file_name' => $f
			));
		}
		$this->db->insert_batch('multiple_upload', $image);
		redirect(site_url('welcome'));
	}

	public function single_upload() {
		$file = $this->custom_upload->single_upload('file', array(
			'upload_path' => 'upload/single',
			'allowed_types' => 'jpg|jpeg|bmp|png|gif' // etc
		));

		$this->db->insert('single_upload', array(
			'file_name' => ((empty($file)) ? null : $file)
		));
		redirect(site_url('welcome'));
	}

}
