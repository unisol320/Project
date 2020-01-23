<?php

	function multiUpload(&$files)
	{
		$CI = get_instance();
		$CI->load->helper('string');
		$data = [];

		$count = count($files['galery']['name']);

		for($i=0;$i<$count;$i++){

			if(!empty($files['galery']['name'][$i])){

				$files['file']['name'] = $files['galery']['name'][$i];
				$files['file']['type'] = $files['galery']['type'][$i];
				$files['file']['tmp_name'] = $files['galery']['tmp_name'][$i];
				$files['file']['error'] = $files['galery']['error'][$i];
				$files['file']['size'] = $files['galery']['size'][$i];

				$config['upload_path'] = './uploads/';
				$config['allowed_types'] = 'jpg|jpeg|png|gif';
				$config['max_size'] = '5000';
				$config['file_name'] = random_string('alnum', 16).$files['galery']['name'][$i];

				$CI->load->library('upload',$config);
				if($CI->upload->do_upload('file')){
					$uploadData = $CI->upload->data();
					$filename = $uploadData['file_name'];
					$data['totalFiles'][] = $filename;
				}
			}

		}
		return $data['totalFiles'];
	}

