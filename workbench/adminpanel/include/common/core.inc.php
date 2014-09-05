<?php
    session_start();
    ob_start();
    $currentfile=$_SERVER['SCRIPT_NAME'];
    
    function axi_admin_loggedin()
    {
        if(isset($_SESSION['adminID']) && !empty($_SESSION['adminID']))
        {
            return true;
        }
        else return false;
    }
    
    function axi_user_loggedin()
    {
        if(isset($_SESSION['userID']) && !empty($_SESSION['userID']))
        {
            return true;
        }
        else return false;
    }
?>