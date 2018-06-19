<?php
require("../config/config.php");
session_unset();

header('Location: index.php');
exit;
?>