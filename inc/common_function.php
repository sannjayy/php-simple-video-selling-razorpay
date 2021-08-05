<?php
	function find($type, $table, $value='*', $where_clause, $execute=array())
	{
		global $db;

		if($where_clause)
		{
			$sql = "SELECT ".$value." FROM ".$table." ".$where_clause."";
		}
		else
		{
			$sql = "SELECT ".$value." FROM ".$table;
		}
		$prepare_sql = $db->prepare($sql);
		$prepare_sql->execute($execute);
		if($prepare_sql->errorCode() == 0) {
			if($type == 'first')
			{
				//fetch single record from database
				$result = $prepare_sql->fetch();
			}
			else if($type == 'all')
			{
				//fetch multiple record from database
				$result = $prepare_sql->fetchAll();
			}
			return $result;
		} else {
			$errors = $prepare_sql->errorInfo();
			echo '<pre>';
			print_r($errors[2]);
			echo '</pre>';
			die();
		}
	}
	function checkImageValid($name)
	{
		$check_valild = true;
		$validImageFormats = array('.jpg', '.gif', '.png', '.jpeg');
		$extention = strtolower(strrchr($name,'.'));
		if(!in_array($extention, $validImageFormats))
		{
			$check_valild = false;
		}
		return $check_valild;
	}

	function checkVideoValid($name)
	{
		$check_valild = true;
		$validImageFormats = array('.mp4', '.avi', '.ogg', '.webm');
		$extention = strtolower(strrchr($name,'.'));
		if(!in_array($extention, $validImageFormats))
		{
			$check_valild = false;
		}
		return $check_valild;
	}
	function compressImage($source, $destination, $quality) {
	    $info = getimagesize($source);
	    if ($info['mime'] == 'image/jpeg') 
	    $image = imagecreatefromjpeg($source);
	    elseif ($info['mime'] == 'image/gif') 
	    $image = imagecreatefromgif($source);
	    elseif ($info['mime'] == 'image/jpg') 
	    $image = imagecreatefromgif($source);
	    elseif ($info['mime'] == 'image/png') 
	    $image = imagecreatefrompng($source);
	    imagejpeg($image, $destination, $quality);
	}
   
	/*
	* insert record into database
	* @param string table name
	* @param string fields
	* @param string values
	* @return resulting array
	*/

	function save($table, $fields, $values, $execute)
	{
		global $db;
		$result = false;
		$sql = "INSERT INTO ".$table." (".$fields.") VALUES (".$values.")";
	        foreach($execute As $key=>$value){
			$execute[$key] = htmlentities($value);
		}
		$prepare_sql = $db->prepare($sql);
		$prepare_sql->execute($execute);

		/*$errors = $prepare_sql->errorInfo();
		echo '<pre>';
		print_r($errors[2]);
		echo '</pre>';*/
		$result = $db->lastInsertId();
		return $result;
	}

	function randomString($length = 6) {
		$str = "";
		$characters = array_merge(range('A','Z'), range('0','9'));
		$max = count($characters) - 1;
		for ($i = 0; $i < $length; $i++) {
			$rand = mt_rand(0, $max);
			$str .= $characters[$rand];
		}
		return $str;
	}

	function url() {
	  // $result = parse_url($url);
	  // return $result['scheme']."://".$result['host'];
	  return $_SERVER['SERVER_NAME'];
	}

	function symbol_cur($cur){
		if($cur == 'USD'){ return '$'; } 
		elseif($cur == 'EURO'){ return '€'; } 
		else { return '£'; }
	}

	function getPercentOfNumber($number, $percent){
		return ($percent / 100) * $number;
	}

	
	function getAmountPercent($price, $discount){
		if ($price && $discount) {
			$percent = $discount/$price;
			return number_format($percent * 100) . '%';
		}
		// return number_format( $percent * 100, 2 ) . '%';
	}

	/*
	* update record into database
	* @param string table name
	* @param string set fields
	* @param string where conditions
	* @return true or false
	*/

	function update($table, $set_value, $where_clause, $execute)
	{
		global $db;

		$sql = "UPDATE ".$table." SET ".$set_value." ".$where_clause."";
		foreach($execute As $key=>$value){
			$execute[$key] = htmlentities($value);
		}
		$prepare_sql = $db->prepare($sql);
		if($prepare_sql->errorCode() == 0) {
			$prepare_sql->execute($execute);
			$errors = $prepare_sql->errorInfo();
			/*echo '<pre>';
			print_r($errors[2]);
			echo '</pre>';*/
			return true;
		} else {
			$errors = $prepare_sql->errorInfo();
			/*echo '<pre>';
			print_r($errors[2]);
			echo '</pre>';
			die();*/
			return false;
		}
	}


	/*
	* delete record from database
	* @param string table name
	* @param string where conditions
	* @return true or false
	*/

	function delete($table, $where_clause)
	{
		global $db;

		$sql = "DELETE FROM ".$table." ".$where_clause."";
		$prepare_sql = $db->prepare($sql);
		$prepare_sql->execute();

		return true;
	}

	function logout()
	{
		// if(count($_SESSION))
		// {
		
		// 	//header("Location: ".DOMAIN_NAME.'index.php');
		// 	session_destroy();
		// }
		header("Location:".SITE_PATH.'logout');
	}
	

	function change_date_indian($date)
	{
		$date_date1 = explode('-', $date);
		$date_date = $date_date1[2]."/".$date_date1[1]."/".$date_date1[0];
		return $date_date;
	}

	function change_date_indian_na($date)
	{
		$date_date1 = explode('-', $date);
		$date_date = $date_date1[2]."-".$date_date1[1]."-".$date_date1[0];
		return $date_date;
	}

	function GetToday(){
		if(date("w") == '0'){
			return 'Sun';
		}
		if(date("w") == '1'){
			return 'Mon';
		}
		if(date("w") == '2'){
			return 'Tue';
		}
		if(date("w") == '3'){
			return 'Wed';
		}
		if(date("w") == '4'){
			return 'Thu';
		}
		if(date("w") == '5'){
			return 'Fri';
		}
		if(date("w") == '6'){
			return 'Sat';
		}
	}


/**
* Convert BR tags to nl
*
* @param string The string to convert
* @return string The converted string
*/
function br2nl($string)
{
    //$varr= nl2br($string);
   // $description= preg_replace("/\r\n|\r|\n/",'<br />',$varr);
    return  html_entity_decode(str_ireplace(array("<br />","<br>"),array("\n","\n"),$string));
}



?>
