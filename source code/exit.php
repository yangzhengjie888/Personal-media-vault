<?php
	session_start();
	unset($_SESSION['username']);
	unset($_SESSION['user_id']);
	echo "<script>alert('Exit!');window.location.href='index.html';</script>;";
?>