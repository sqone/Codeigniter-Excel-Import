<?php
class Custom_upload {

	public function __construct() {
		$this->CI =& get_instance();

		$this->CI->load->library('upload');
	}

	public function single_upload($field_name, $conf = array()) {
		$upload_path = FCPATH.$conf['upload_path'];
		if (!is_dir($upload_path))
			mkdir($upload_path, 0777, true);

		$config = array(
			'upload_path' => $upload_path,
			'allowed_types' => $conf['allowed_types'],
			'max_size' => 0,
			'encrypt_name' => true
		);
		$this->CI->upload->initialize($config);
		if ($this->CI->upload->do_upload($field_name)) {
			$data = $this->CI->upload->data();
			chmod($data['full_path'], 0777);

			return $data['file_name'];
		}
	}

	public function multiple_upload($field_name, $conf = array()) {
		$files = $_FILES[$field_name];
		$file_upload = sizeof($_FILES[$field_name]['tmp_name']);

		$image = array();
		$multiple = array();

		for ($i = 0; $i < $file_upload; $i++) {
			$_FILES[$field_name]['name'] = $files['name'][$i];
			$_FILES[$field_name]['type'] = $files['type'][$i];
			$_FILES[$field_name]['tmp_name'] = $files['tmp_name'][$i];
			$_FILES[$field_name]['error'] = $files['error'][$i];
			$_FILES[$field_name]['size'] = $files['size'][$i];

			$upload_path = FCPATH.$conf['upload_path'];
			if (!is_dir($upload_path))
				mkdir($upload_path, 0777, true);

			$config = array(
				'upload_path' => $upload_path,
				'allowed_types' => $conf['allowed_types'],
				'max_size' => 0,
				'encrypt_name' => true
			);
			$this->CI->upload->initialize($config);
			if ($this->CI->upload->do_upload($field_name)) {
				$data = $this->CI->upload->data();
				chmod($data['full_path'], 0777);

				$multiple[$i] = $data['file_name'];
			}
		}
		return $multiple;
	}

}