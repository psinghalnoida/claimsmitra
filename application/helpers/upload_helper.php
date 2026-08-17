<?php 

class UPLOAD{

    public function multipleuploadFile($input_name, $upload_path) {
        $CI = &get_instance();
        $CI->load->library('upload');
        
        $files = $_FILES[$input_name];
        $file_count = count($files['name']);
        
        $uploaded_files = array();
        
        for ($i = 0; $i < $file_count; $i++) {
            $uploadedfile = basename($files['name'][$i]);
            $_FILES[$input_name]['name'] = $uploadedfile;
            $_FILES[$input_name]['type'] = $files['type'][$i];
            $_FILES[$input_name]['tmp_name'] = $files['tmp_name'][$i];
            $_FILES[$input_name]['error'] = $files['error'][$i];
            $_FILES[$input_name]['size'] = $files['size'][$i];
              
            $CI->upload->initialize(array('upload_path' => $upload_path,'allowed_types' => '*'));
          
            if ($CI->upload->do_upload($input_name)) {
                $uploaded_files[] = $CI->upload->data('file_name');
            } else {
                $uploaded_files[] = $CI->upload->display_errors();
            }
        }
        return $uploaded_files;
    }

  function singleuploadFile($input_name, $upload_path)
  {
    $this->load->library('upload', $config);
    $thumbnail = null;
    $files = $_FILES[$input_name];
    
    $imagepath = basename($files['name']);
    if($imagepath != null){
            preg_match('/(?<extension>\.\w+)$/im', $imagepath, $matches);
            $extension = $matches['extension'];
            $thumbnail = 'thumb_'.sha1($imagepath.time()) . $extension;
    }

    $_FILES[$input_name]['name'] = $thumbnail;
    $_FILES[$input_name]['type'] = $files['type'];
    $_FILES[$input_name]['tmp_name'] = $files['tmp_name'];
    $_FILES[$input_name]['error'] = $files['error'];
    $_FILES[$input_name]['size'] = $files['size'];
    
    /*$CI->upload->initialize(array(
        'upload_path' => $upload_path,
        'allowed_types' => 'csv',
        'max_size'=> 2048,
    ));*/

    $config['upload_path']   = './assets/uploads/';
    $config['allowed_types']   = 'csv';
    $config['max_size']   = 2048;

    
    if ($this->upload->do_upload($input_name)) {
        return $CI->upload->data();
    } else {
        return $CI->upload->display_errors();
    }
  }
}