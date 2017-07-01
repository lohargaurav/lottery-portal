<?php

namespace App\Helpers;

class Helper {

    public static function full_name($first_name,$last_name) {
        return $first_name . ', '. $last_name;   
    }
	
	public static function encode($value){ 
	  if(!$value){return false;}
	  $text = $value;
	  $skey = "jZDE0u9afyOkx50AzgLTQqhnmCyNnLS8";
	  $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
	  $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
	  $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $skey, $text, MCRYPT_MODE_ECB, $iv);
	  $en= trim(Helper::safe_b64encode($crypttext)); 
	  return $en;

	 }

	 public static function decode($value){
		if(!$value){return false;}
			$crypttext = Helper::safe_b64decode($value); 
			$skey = "jZDE0u9afyOkx50AzgLTQqhnmCyNnLS8";
			$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
			$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
			$decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $skey, $crypttext, MCRYPT_MODE_ECB, $iv);
			$de= trim($decrypttext);
	  return $de;
		}
	   
	 public static  function safe_b64encode($string) {
	  $data = base64_encode($string);
	  $data = str_replace(array('+','/','='),array('-','_',''),$data);
	  return $data;
	 }

	 public static  function safe_b64decode($string) {
	  $data = str_replace(array('-','_'),array('+','/'),$string);
	  $mod4 = strlen($data) % 4;
	  if ($mod4) {
	   $data .= substr('====', $mod4);
	  }
	  return base64_decode($data);
	 }
}