<?php
session_start();

unset($_SESSION['username']);
	unset($_SESSION['user_id']);



?>


<html>
<body>
<?php 
		include "login.html";
?>
</body>
</html>