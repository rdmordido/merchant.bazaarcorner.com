<?php

function printpre($data){
	echo "<pre>";print_r($data);echo"</pre>";
}

function getUploadedImageurl($type,$image_name){
        $base_url       = url("/uploads/{$type}");
        $base_path      = public_path()."/uploads/{$type}/";
        $image_url      = new stdClass;

        if($type != '' && file_exists($base_path.$image_name)){
                $image_url->url         = $base_url.'/'.$image_name;
                $image_url->thumbUrl    = $base_url.'/thumbnail/'.$image_name;
                $image_url->mediumUrl   = $base_url.'/medium/'.$image_name;
                $image_url->largeUrl    = $base_url.'/large/'.$image_name;
        }else{
                $image_url->url         = url('assets/images/noimage.jpg');
                $image_url->thumbUrl    = url('assets/images/noimage.jpg');
        }
        return $image_url;
}