<?php
class UploadController extends BaseController {

	private $base_url;
	private $upload_path;
	private $script_url;
	private $options;

	public function __construct()
	{
		$this->base_url 	= URL::to('/');
		$this->upload_path 	= public_path().'/uploads/';
		$this->upload_url 	= $this->base_url.'/uploads/';
		$this->script_url   = $this->base_url.'/upload/';
		$this->options 		= array('file_name' => uniqid());
	}

    public function upload($resource = null)
    {
    	switch ($resource) {
    		case 'item':
    			$options = array(
		    		 'upload_dir' => $this->upload_path.'item/'
		    		,'upload_url' => $this->upload_url.'item/'
		    		,'script_url' => $this->script_url.'item/'
		    	);
    			break;
    		case 'item_video':
    			$options = array(
		    		 'upload_dir' => $this->upload_path.'item/video/'
		    		,'upload_url' => $this->upload_url.'item/video/'
		    		,'script_url' => $this->script_url.'item/video/'
		    	);
    			break;
    		case 'discount':
    			$options = array(
		    		 'upload_dir' => $this->upload_path.'discount/'
		    		,'upload_url' => $this->upload_url.'discount/'
		    		,'script_url' => $this->script_url.'discount/'
		    	);
    			break;
    		case 'profile':
    			$options = array(
		    		 'upload_dir' => $this->upload_path.'profile/'
		    		,'upload_url' => $this->upload_url.'profile/'
		    		,'script_url' => $this->script_url.'profile/'
		    	);
    			break;
    		default:
    			# code...
    			break;
    	}
    	$this->options 	= array_merge($this->options,$options);
		$upload 		= new UploadHandler($this->options);
	}

}