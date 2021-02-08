<?php
/*функция удаляющая сессию
сначала удаляет все значения массива $_SESSION(т.е. делает массив пустым), потом удаляет куки с именем
 session_id()(функция возвращает имя сессии) и после закрывает сессию
 *  */
function delete_session_and_data() {
        $_SESSION = array();
        setcookie(session_id(),'',time() - 6000000);
        session_destroy();
  
}

