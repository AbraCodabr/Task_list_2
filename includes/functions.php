<?php
   
    // Функция проверки колл. символов 
    function num_char($new) {
        return strlen($new) > 3 and strlen($new) < 30;
    }


    // Функция проверки на рег. выражение
    function check_regular($new) {
        // Санитизация имени пользователя
        $field = filter_var(trim($new), FILTER_SANITIZE_STRING);
    
        // Валидация имени пользователя
        if( filter_var($new, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z0-9]+$/"))) ) {
            return true;
        }
    }
    

?>
