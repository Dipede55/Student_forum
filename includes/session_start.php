<?php
session_start();

// Default guest
if (!isset($_SESSION['loggedin'])) {
    $_SESSION['loggedin'] = false;
    $_SESSION['user_id'] = null;
    $_SESSION['name'] = 'Guest';
    $_SESSION['is_admin'] = false;
    $_SESSION['is_school_role'] = false;
}
?>