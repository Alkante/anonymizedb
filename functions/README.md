Put here your PHP files with your functions.  
  
Structure of each functions :  
```php
/**
 * @param string $fieldName Name of the field in your DB
 * @param array $data Data of the line in your DB
 * @param array $param Parameters from your json
 */
function randomData_<NAME_OF_YOUR_FUNCTION>(string $fieldName, array $data, $param=[]){
  /*
    Examples of param's value :
    $fieldName == "mail"
    $data == [
      "id" => "1",
      "name" => "Do",
      "firstname" => "John",
      "mail" => "jdo@exemple.com",
      "login" => "jdo",
      "pwd" => "$2y$10$mK2enen6vIcLbwvfXyq/8ONipueshDe4D6CmuuCS9eH1tx033Cnne"
    ]
    $param == [
      "myparam1" => "plop",
      "myparam2" => "42",
    ]  
  */
  if(!empty($param['showHelp'])){
    return [
      "return" => "<EXPLAINE_WHAT_IT_DOES>",
      "param" => [
        "<YOUR_PARAM>" => "<EXPLAINE_WHAT_IT_DOES>",
        <...>
      ],
      "info" => "<OTHER_INFORMATIONS>"
    ];
  }else{
    $<YOUR_PARAM> = getParam($param, '<YOUR_PARAM>', '<DEFAULT_VALUE>'');

    $oldValue = $data[$fieldName];
    $newValue = "";

    //do something

    return $newValue;
  }
}
```
