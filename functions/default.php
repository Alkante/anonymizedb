<?php

function randomData_empty(string $fieldName, array $data, $param=[]){
	if(!empty($param['showHelp'])){
		return [
			"return" => "Return an empty string.",
			"param" => [],
			"info" => ""
		];
	}else{
		return "";
	}
}

function randomData_null(string $fieldName, array $data, $param=[]){
	if(!empty($param['showHelp'])){
		return [
			"return" => "Return null.",
			"param" => [],
			"info" => ""
		];
	}else{
		return null;
	}
}

function randomData_name(string $fieldName, array $data, $param=[]){
	if(!empty($param['showHelp'])){
		return [
			"return" => "Return a name.",
			"param" => [
				"dico" => "[Optional] Name of the csv dico in ./dico/. Default name_fr.csv",
				"dicoCol" => "[Optional] Column in the dico. Default 0"
			],
			"info" => ""
		];
	}else{
		$dicoName = getParam($param, 'dico', 'name_fr.csv');
		$dicoCol = getParam($param, 'dicoCol', 0);
		importFile($dicoName);

		if(!empty($GLOBALS['dico'][$dicoName])){
			return $GLOBALS['dico'][$dicoName][random_int(0, count($GLOBALS['dico'][$dicoName])-1)][0];
		}else{
			return "";
		}
	}
}

function randomData_firstname(string $fieldName, array $data, $param=[]){
	if(!empty($param['showHelp'])){
		return [
			"return" => "Return a firstname.",
			"param" => [
				"dico" => "[Optional] Name of the csv dico in ./dico/. Default firstname_fr.csv",
				"dicoCol" => "[Optional] Column in the dico. Default 1"
			],
			"info" => ""
		];
	}else{
		$dicoName = getParam($param, 'dico', 'firstname_fr.csv');
		$dicoCol = getParam($param, 'dicoCol', 1);

		importFile($dicoName);

		if(!empty($GLOBALS['dico'][$dicoName])){
			return $GLOBALS['dico'][$dicoName][random_int(0, count($GLOBALS['dico'][$dicoName])-1)][$dicoCol];
		}else{
			return "";
		}
	}
}

function randomData_email(string $fieldName, array $data, $param=[]){
	if(!empty($param['showHelp'])){
		return [
			"return" => "Return an email.",
			"param" => [
				"firstname" => "[Optional] Name of the field «firstname». Default random string",
				"name" => "[Optional] Name of the field «name». Default null",
				"domain" => "[Optional] Domain of the email. Default localhost.lan"
			],
			"info" => "If firstname, name and domain are set, then output : <firstname>.<name>@<domain>"
		];
	}else{
		$firstname = getParam($param, 'firstname', "");
		if(!empty($data[$firstname])){
			$email = $data[$firstname];
		}
		$name = getParam($param, 'name', "");
		if(!empty($data[$name])){
			if(!empty($email)){
				$email .= ".";
			}
			$email .= $data[$name];
		}
		$domain = getParam($param, 'domain', "localhost.lan");
		$email .= "@".$domain;
		return strtolower($email);
	}
}

function randomData_login(string $fieldName, array $data, $param=[]){
	if(!empty($param['showHelp'])){
		return [
			"return" => "Return a login.",
			"param" => [
				"firstname" => "[Optional] Name of the field «firstname». Default null",
				"name" => "[Optional] Name of the field «name». Default null",
				"size" => "[Optional] Size of the login. Default 8"
			],
			"info" => "If firstname and name are set, then login = first letter of firstname + name\n"
								."\tElse login = random string"
		];
	}else{
		$login = "";
		$firstname = getParam($param, 'firstname', "");
		$name = getParam($param, 'name', "");

		if(!empty($data[$firstname])){
			$login = substr($data[$firstname], 0,1);
		}
		if(!empty($data[$name])){
			$login .= $data[$name];
		}

		if(empty($login)){
			return randomData_string('', [], ['size' => 8]);
		}else{
			return strtolower($login);
		}

	}
}

function randomData_password(string $fieldName, array $data, $param=[]){
	if(!empty($param['showHelp'])){
		return [
			"return" => "Return a password.",
			"param" => [
			],
			"info" => ""
		];
	}else{
		$default = getParam($param, 'default', "");
		if(!empty($default)){
			return $default;
		}else{
			return randomData_string("", [], ['size' => 12]);
		}
	}
}

function randomData_string(string $fieldName, array $data, $param=[]){
	if(!empty($param['showHelp'])){
		return [
			"return" => "Return a string.",
			"param" => [
				//"char" => "String allow char. Ex: «0-9a-z» or «abcd» or «a-f0-9» ...",
				"char" => "String allow char. Ex: «0123456789».\n\tDefault 0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ",
				"size" => "Integer size of the string. Default 10"
			],
			"info" => ""
		];
	}else{
		$characters = getParam($param, 'char', '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
		$size = getParam($param, 'size', 10);

		if(!empty($param['size'])){
			$size = (int)$param['size'];
		}
 		$charactersLen = strlen($characters)-1;
    $randstring = '';
    for ($i = 0; $i < $size; $i++) {
        $randstring .= $characters[random_int(0, $charactersLen)];
    }
    return $randstring;
	}
}

function randomData_number(string $fieldName, array $data, $param=[]){
	if(!empty($param['showHelp'])){
		return [
			"return" => "Return a number.",
			"param" => [
				"min" => "Default 0",
				"max" => "Default 100000"
			],
			"info" => ""
		];
	}else{
		$min = getParam($param, 'min', 0);
		$max = getParam($param, 'max', 100000);

		return random_int($min, $max);
	}
}

function randomData_phoneNumber(string $fieldName, array $data, $param=[]){
	if(!empty($param['showHelp'])){
		return [
			"return" => "Return a phoneNumber.",
			"param" => [
				"format" => 'Format of the number. Replace all "X" in string by a number [0-9].'
							."\n\tDefault : \"0X XX XX XX XX\" => \"03 72 13 71 25\""
							."\n\tExample : \"+33 X XX XX XX XX\" => \"+33 9 16 28 82 19\""
							."\n\t          \"06 XX XX XX XX\" => \"06 91 94 68 04\""
							."\n\t          \"0X.XX.XX.XX.XX\" => \"01.61.96.15.60\""
			],
			"info" => ""
		];
	}else{
		$format = getParam($param, "format", '0X XX XX XX XX');
		$l = strlen($format);
		$phoneNumber = "";
		for($i=0; $i<$l; $i++){
			if($format[$i] == "X" || $format[$i] == "x"){
				$phoneNumber .= random_int(0,9);
			}else{
				$phoneNumber .= $format[$i];
			}
		}

		return $phoneNumber;
	}
}

function randomData_date(string $fieldName, array $data, $param=[]){
	if(!empty($param['showHelp'])){
		return [
			"return" => "Return a date.",
			"param" => [
				"format" => "[Optional] Format of the date.\n\tSee https://secure.php.net/manual/en/function.date.php.\n\tDefault «Y-m-d»",
				"now" => "[Optional] If not empyt, return now.",
				"after" => "[Optional] Find date after.\n\tSee https://secure.php.net/manual/en/datetime.modify.php.\n\tDefault «-100 year»",
				"before" => "[Optional] Find date before.\n\tSee https://secure.php.net/manual/en/datetime.modify.php.\n\tDefault «-1 year»",
			],
			"info" => ""
		];
	}else{
		$format = getParam($param, 'format', "Y-m-d");
		$now = getParam($param, 'now', "");
		if(!empty($now)){
			return date($format);
		}else{
			$after = getParam($param, 'format', '-100 year');
			$before = getParam($param, 'format', "-1 year");

			$dateAfter = new DateTime('now');
			$dateAfter = $dateAfter->modify($after);
			$timeAfter = $dateAfter->getTimestamp();

			$dateBefore = new DateTime('now');
			$dateBefore = $dateBefore->modify($before);
			$timeBefore = $dateBefore->getTimestamp();

			return date($format, random_int($timeAfter, $timeBefore));
		}
	}
}