<?php
function tempMess(){
    if(isset($_SESSION['TempMess'])){
        $message = $_SESSION['TempMess'];
        echo $message;
        unset($_SESSION['TempMess']);
    }
}

function setTempMess($message) {
    $_SESSION['TempMess'] = $message;
}
?>