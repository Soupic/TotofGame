<?php
session_destroy();
if(isset($perso))
{
	unset($perso);
}
header('location:index.php');
exit();