<html>
<head>
<link rel="shortcut icon" href="icons/mkdirIcon.png">
<h1><center><span style="display:inline;">Delete</center></h1>
</head>
<title>Delete</title>
<?php
	session_start();
	include("../config.php");
	require_once("../classes/database.class.php");
	if (!isset($_SESSION['uname']) || $_SESSION['uname']==$_SESSION['projectName'])
		header("location:/views/loginwrong.html");
?>
<h6 align="right"><a href="../controllers/logout.php">
<input type="submit" style="design:inline" value="Logout"></a>
<a href="../controllers/homePage.php"><input type="submit" value="Home"></a></h6>
<br><br><br>
<body bgcolor=#cfcfcf alink="#ee0000" link="#0000ee" vlink="#551a8b">
<form action="../controllers/Deletefile.php" method="post" >
<fieldset>
<?php
	include("../config.php");
	if($_POST['mode']==1)
	exec("find $PROJECT_ROOT  \( ! -regex '.*/\..*' \) -type d",$out);
	else if($_POST['mode']==2)
		exec("find $PROJECT_ROOT \( ! -regex '.*/\..*' \) -type f",$out);
	else 
		exec("find $PROJECT_ROOT  \( ! -regex '.*/\..*' \) ",$out);
	foreach($out as &$tmp)
	{
		$sub=substr($tmp,strlen($PROJECT_ROOT)-1);
		if(strcmp($tmp,$out[0])==0)
			echo "<input type=checkbox name='files[]' value='$tmp' CHECKED/>$sub<br>\n";
		else
			echo "<input type=checkbox name='files[]' value='$tmp'/>$sub<br>\n";
	}
	echo "<input type=submit value=\"Delete\">\n";
	echo "</form>\n";
?>
</body>
</html>
