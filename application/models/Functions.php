<?php
class Functions extends CI_Model{
	function __construct()
	{
		parent::__construct();
	}
	function changDate($date,$type){
		$ar_date = explode('/',$date);
		if($type == 1){
			$result = $ar_date[2].'-'.$ar_date[1].'-'.$ar_date[0];
		}
		return $result;
	}
	function createCode($number,$table){
		$code = $this->CI_function->RandomString($number);
		$data = $this->query_sql->select_row($table, 'id',array('code' => $code));
		if($order != NULL){
			$code = $this->CI_function->RandomString($number);
		}
		return $code;
	}
	function RandomString($length = 10) {
		$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	function RandomNumber($length = 10) {
		$characters = '0123456789';
		$charactersLength = strlen($characters);
		$data = '';
		for ($i = 0; $i < $length; $i++) {
			$data .= $characters[rand(0, $charactersLength - 1)];
		}
		return $data;
	}
	function changFormatDate($date) {
		$ar_date = explode('/',$date);
		$data = $ar_date[2].'-'.$ar_date[1].'-'.$ar_date[0];
		return $data;
	}
	function createdAlias($alias='',$type,$alias_old = ''){
		$random = rand(0,999);
		$check = $this->query_sql->select_row('tbl_alias', '*', array('alias' => $alias_old,'type' => $type));
		if($check != NULL){
			if($alias == $alias_old){
				$alias = $alias_old;
			}else{
				$data = $this->query_sql->select_row('tbl_alias', '*', array('alias' => $alias));
				if($data != NULL){
					$alias = $alias.'-'.$random;
				}
			}
			$data_edit = array(
				'alias' 	=> 	$alias,
			);
			$result = $this->query_sql->edit('tbl_alias', $data_edit,array('id' => $check['id']));
		}else{
			$data = $this->query_sql->select_row('tbl_alias', '*', array('alias' => $alias));
			if($data != NULL){
				$alias = $alias.'-'.$random;
			}
			$data_add = array(
				'alias' 	=> 	$alias,
				'type' 		=> 	$type,
				'created_at'	=>	gmdate('Y-m-d H:i:s', time()+7*3600)
			);
			$result = $this->query_sql->add('tbl_alias', $data_add);
		}
		return $alias;
	}
	function create_alias($bien)
	{
		if($bien != '')
		{
			$marTViet=array("à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă",
				"ằ","ắ","ặ","ẳ","ẵ","è","é","ẹ","ẻ","ẽ","ê","ề"
				,"ế","ệ","ể","ễ",
				"ì","í","ị","ỉ","ĩ",
				"ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ"
				,"ờ","ớ","ợ","ở","ỡ",
				"ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
				"ỳ","ý","ỵ","ỷ","ỹ",
				"đ",
				"À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă"
				,"Ằ","Ắ","Ặ","Ẳ","Ẵ",
				"È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
				"Ì","Í","Ị","Ỉ","Ĩ",
				"Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ"
				,"Ờ","Ớ","Ợ","Ở","Ỡ",
				"Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
				"Ỳ","Ý","Ỵ","Ỷ","Ỹ",
				"Đ",
				"!","@","#","$","%","^","&","*","(",")");

			$marKoDau=array("a","a","a","a","a","a","a","a","a","a","a"
				,"a","a","a","a","a","a",
				"e","e","e","e","e","e","e","e","e","e","e",
				"i","i","i","i","i",
				"o","o","o","o","o","o","o","o","o","o","o","o"
				,"o","o","o","o","o",
				"u","u","u","u","u","u","u","u","u","u","u",
				"y","y","y","y","y",
				"d",
				"A","A","A","A","A","A","A","A","A","A","A","A"
				,"A","A","A","A","A",
				"E","E","E","E","E","E","E","E","E","E","E",
				"I","I","I","I","I",
				"O","O","O","O","O","O","O","O","O","O","O","O"
				,"O","O","O","O","O",
				"U","U","U","U","U","U","U","U","U","U","U",
				"Y","Y","Y","Y","Y",
				"D",
				"","","","","","","","","","");
			$bien = trim($bien);
			$bien = str_replace("/","",$bien);
			$bien = str_replace(":","",$bien);
			$bien = str_replace("!","",$bien);
			$bien = str_replace("(","",$bien);
			$bien = str_replace(")","",$bien);
			$bien = str_replace($marTViet,$marKoDau,$bien);
			$bien = str_replace("-","",$bien);
			$bien = str_replace("  "," ",$bien);
			$bien = str_replace(" ","-",$bien);
			$bien = str_replace("%","-",$bien);
			$bien = str_replace("+","-",$bien);
			$bien = str_replace("'","",$bien);
			$bien = str_replace("“","",$bien);
			$bien = str_replace("”","",$bien);
			$bien = str_replace(",","",$bien);
			$bien = str_replace("’","",$bien);
			$bien = str_replace(".","",$bien);
			$bien = str_replace('"',"",$bien);
			$bien = str_replace('\\','',$bien);
			$bien = str_replace('//','',$bien);
			$bien = str_replace('?','',$bien);
			$bien = str_replace('&','',$bien);
			$bien = strtolower($bien);
			return $bien;
		}
	}
	function delStringSpecial($bien)
	{
		if($bien != ''){
			$bien = trim($bien);
			$bien = str_replace("/","",$bien);
			$bien = str_replace(":","",$bien);
			$bien = str_replace("!","",$bien);
			$bien = str_replace("(","",$bien);
			$bien = str_replace(")","",$bien);
			$bien = str_replace("-","",$bien);
			$bien = str_replace("  "," ",$bien);
			$bien = str_replace("%","",$bien);
			$bien = str_replace("+","",$bien);
			$bien = str_replace("'","",$bien);
			$bien = str_replace("“","",$bien);
			$bien = str_replace("”","",$bien);
			$bien = str_replace(",","",$bien);
			$bien = str_replace('//','',$bien);
			$bien = str_replace('?','',$bien);
			$bien = str_replace('&','',$bien);
			$bien = str_replace('–','',$bien);
			return $bien;
		}
	}
}
?>
