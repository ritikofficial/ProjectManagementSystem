<html>
<?php
	echo $_FILES["uploadedfile"]["tmp_name"];
	$target='repos/';
	$target=$target.$_FILES['uploadedfile']['name'];
	move_uploaded_file($_FILES['uploadedfile']['tmp_name'],$target);
?>
</html>
