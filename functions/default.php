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
        "dicoCol" => "[Optional] Column in the dico. Default 1. Start 0."
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
        "prefix" => "[Optional] Prefix. <prefix><firstname>.<name>@<domain>. Default null"
                    ."\n\tExample : \"test+\" => test+<firstname>.<name>@<domain>",
        "firstname" => "[Optional] Name of the field «firstname». Default random string",
        "name" => "[Optional] Name of the field «name». Default null",
        "domain" => "[Optional] Domain of the email. Default localhost.lan"
      ],
      "info" => "If firstname, name and domain are set, then output : <prefix><firstname>.<name>@<domain>"
    ];
  }else{
    $email = "";
    $firstname = getParam($param, 'firstname', "");
    if(!empty($data[$firstname])){
      $email .= $data[$firstname];
    }
    $name = getParam($param, 'name', "");
    if(!empty($data[$name])){
      if(!empty($email)){
        $email .= ".";
      }
      $email .= $data[$name];
    }
    $email = getParam($param, 'prefix', "").$email."@".getParam($param, 'domain', "localhost.lan");
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

function randomData_loremIpsum(string $fieldName, array $data, $param=[]){
  if(!empty($param['showHelp'])){
    return [
      "return" => "Return a string.",
      "param" => [
      	"nParagraphs" => "[Optional] Number of paragraphs. Default 1.",
      	"minSentences" => "[Optional] Min size of sentences. Default 3.",
      	"maxSentences" => "[Optional] Max size of sentences. Default 8.",
      	"dico" => "[Optional] Name of the csv dico in ./dico/. Default lorem_ipsum.csv",
      	"dicoCol" => "[Optional] Column in the dico with word. Default 0. Start 0"
      ],
      "info" => ""
    ];
  }else{
    $dicoName = getParam($param, 'dico', 'lorem_ipsum.csv');
    $dicoCol = getParam($param, 'dicoCol', 0);

		$nParagraphs = getParam($param, 'nParagraphs', 1);
		$minSentences = getParam($param, 'minSentences', 3);
		$maxSentences = getParam($param, 'maxSentences', 8);

    importFile($dicoName);

    if(!empty($GLOBALS['dico'][$dicoName])){
    	$dico = $GLOBALS['dico'][$dicoName];
    	$nbRow = count($dico)-1;

	    /**
	     * Lorem ipsum
	     * By mpen
	     * https://stackoverflow.com/questions/20633310/how-to-get-random-text-from-lorem-ipsum-in-php#answer-39986034
	     */
      $paragraphs = [];
      for($p = 0; $p < $nParagraphs; ++$p) {
        $nsentences = random_int($minSentences,$maxSentences);
        $sentences = [];
        for($s = 0; $s < $nsentences; ++$s) {
          $frags = [];
          $commaChance = .33;
          while(true) {
          	$words = [];
          	$count = random_int(3, 15);
          	for ($i=0; $i < $count; $i++) { 
          		$words[] = $dico[random_int(0, $nbRow)][$dicoCol];
          	}
            $frags[] = implode(' ', $words);
            if((random_int(0, PHP_INT_MAX-1)/PHP_INT_MAX) >= $commaChance) {
              break;
            }
            $commaChance /= 2;
          }

          $sentences[] = ucfirst(implode(', ', $frags)) . '.';
        }
        $paragraphs[] = implode(' ',$sentences);
      }
      return implode("\n\n",$paragraphs);
    }else{
    	return "lorem ipsum dolor sit amet consectetur adipiscing elit praesent interdum dictum mi non egestas nulla in lacus.";
    }
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

function randomData_city(string $fieldName, array $data, $param=[]){
  if(!empty($param['showHelp'])){
    return [
      "return" => "Return name of a city",
      "param" => [
      	"fieldPostalCode" => "[Optional] Name of your postal code field. Get the city from the postal code.",
        "dico" => "[Optional] Name of the csv dico in ./dico/. Default laposte_hexasmal.csv",
        "dicoColCity" => "[Optional] Column in the dico with cities names. Default 1. Start 0"
      ],
      "info" => ""
    ];
  }else{
    $dicoName = getParam($param, 'dico', 'laposte_hexasmal.csv');
    $dicoColCity = getParam($param, 'dicoColCity', 1);

    importFile($dicoName);

    if(!empty($GLOBALS['dico'][$dicoName])){
    	$row = $GLOBALS['dico'][$dicoName][random_int(0, count($GLOBALS['dico'][$dicoName])-1)];
    	if(empty($GLOBALS['dico']['city'])){
    		$GLOBALS['dico']['city'] = [];
    	}
    	$GLOBALS['dico']['city'][$row[$dicoColCity]] = $row;
      return $row[$dicoColCity];
    }else{
      return "";
    }
  }
}

function randomData_postalCode(string $fieldName, array $data, $param=[]){
  if(!empty($param['showHelp'])){
    return [
      "return" => "Return name of a postal code",
      "param" => [
      	"fieldCity" => "[Optional] Name of your city field. Get the postal code from the city.",
        "dico" => "[Optional] Name of the csv dico in ./dico/. Default laposte_hexasmal.csv",
        "dicoColPostalCode" => "[Optional] Column in the dico with postal code. Default 2. Start 0"
      ],
      "info" => "It's better to place in your json the function city before postalCode."
      					."\n\tExample:
	{ ...
		\"ville\":{
			\"function\":\"city\"
		},
		\"cp\":{
			\"function\":\"postalCode\",
			\"param\":{
				\"fieldCity\":\"ville\"
			}
		}
	}"
    ];
  }else{
		$fieldCity = getParam($param, 'fieldCity', '');
    $dicoColPostalCode = getParam($param, 'dicoColPostalCode', 2);
		if(!empty($fieldCity) && !empty($data[$fieldCity]) && !empty($GLOBALS['dico']['city'][$data[$fieldCity]])){
			$row = $GLOBALS['dico']['city'][$data[$fieldCity]];
			if(!empty($row[$dicoColPostalCode])){
				return $row[$dicoColPostalCode];
			}else{
				return null;
			}
		}else{
	    $dicoName = getParam($param, 'dico', 'laposte_hexasmal.csv');

	    importFile($dicoName);

	    if(!empty($GLOBALS['dico'][$dicoName])){
	    	$row = $GLOBALS['dico'][$dicoName][random_int(0, count($GLOBALS['dico'][$dicoName])-1)];
	    	if(empty($GLOBALS['dico']['postalCode'])){
	    		$GLOBALS['dico']['postalCode'] = [];
	    	}
	    	$GLOBALS['dico']['postalCode'][$row[$dicoColPostalCode]] = $row;
	      return $row[$dicoColPostalCode];
	    }else{
	      return "";
	    }
		}
  }
}