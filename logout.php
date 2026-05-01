<?php
session_start();
session_unset();
session_destroy();
header("location:/cfees_committee/");
exit();
?>