<?php
    session_start();
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        /*
        echo '<pre>';
        var_dump($_SESSION);
        echo '</pre>';
        */
        echo 'hea';
    } else {
        /*
        echo '<pre>';
        var_dump($_SESSION);
        echo '</pre>';
        */
        echo 'halb';
    }
?>