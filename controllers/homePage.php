<html>
<head>
<link rel="shortcut icon" href="../views/icons/home.png">
</head>
<?php
/****************************************************************************************
homePage.php is the homepage of a current user.Contains the buttons to perform git actions.
***************************************************************************************/
require_once("../classes/database.class.php");
$con = new Database();
$con->connect();
session_start();
$reply=$con->query("SELECT uname,projectName FROM Accounts WHERE sessionID='$_SESSION[SessionID]'");
if ($reply==0)
{
//User not logged in and tries to access hompepage.php by typing in the url
echo '<body style="background-image: url(../views/images.png); color: rgb(0, 0, 0);" alink="#ee0000" link="#0000ee" vlink="#551a8b">';
echo "<h3>You are not logged in..Please Login...</h3>";
echo "<br><a href='../views/login.html'><input type='submit' value='Login'></a>";
exit;
}
$row=mysql_fetch_assoc($reply);
$con->close();
$_SESSION['project']=$row['projectName'];
echo "<title>Homepage of $row[uname]</title>";
echo $_SESSION['message'];$_SESSION['message']=''; 
?>
<body style="background-image: url(../views/images.png); color: rgb(0, 0, 0);" alink="#ee0000" link="#0000ee" vlink="#551a8b">
<font face='Ubuntu'>
<h1><center><font color=white> Welcome <b><?php echo $row['uname'];?></a></b></font></center></h1>
<form method='post' action='logout.php' align='right'>
	<input type='submit' value='Logout'>
</form>
<font size="6" color="white">Project name :<?php echo " $row[projectName]"; ?></font><br><br>
<a href='../views/upload.php'>
<input type='image' src='../views/icons/upload.png' value='Upload a file' style="display:inline"></a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<form method='post' action='gitCommands/download.php' style="display:inline">
<input type='image' src='../views/icons/download.png' value='Download all files'>
</form>
<br>
</font>
<font size='4' color='white' face='ubuntu'>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Upload
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;
Download
</font>
</body>
</html>
