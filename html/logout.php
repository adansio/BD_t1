<?
require_once('include/session.php');
require_once('include/header.php');
session_destroy();

header('Location: index.php');
?>

