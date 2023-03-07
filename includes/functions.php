<?php
   
    // Функция проверки колл. символов 
    function num_char($new) {
        return strlen($new) > 3 and strlen($new) < 30;
    }


    // Функция проверки на рег. выражение
    function checkUser($login) {
        // Санитизация имени пользователя
        $field = filter_var(trim($login), FILTER_SANITIZE_STRING);
    
        // Валидация имени пользователя
        if( filter_var($login, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z0-9]+$/"))) ) {
            return true;
        } else {
            return false;
        }

    }
    

?>
