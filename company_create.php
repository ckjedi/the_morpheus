<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
	$errors=array();
	
	//Form Validation
	$required_fields=array('name','position','visible');
	foreach($required_fields as $fieldname){
		if(!isset($_POST[$fieldname]) || empty($_POST[$fieldname])){
			$errors[]=$fieldname;
		}
	}
	/*if(!isset($_POST['menu']) || empty($_POST['menu_name'])){
		$errors[]='menu_name';
	}
	*/
	
	$fields_with_lengths=array('name'=>30);
	foreach($fields_with_lengths as $fieldname => $maxlength){
		if(strlen(trim(mysql_prep($_POST[$fieldname]))) > $maxlength){
			$errors[]=$fieldname;
		}
	}
	
	if(!empty($errors)){
		redirect_to('new_company.php');
	}
?>
<?php
	$name=mysql_prep($_POST['name']);
	$position=mysql_prep($_POST['position']);
	$visible=mysql_prep($_POST['visible']);
?>
<?php
	$query ="INSERT INTO portfolio_company(
		name,position,visible)
		VALUES(
			'{$name}',{$position},{$visible}
		)";
	$result = mysql_query($query,$connection);
	if($result){
		//Success
		header("Location: company_list.php");
		exit;
	}else{
		//Display error message
		echo "<p>Company creation failed</p>";
		echo "<p>" . mysql_error() . "</p>";
	}
?>
<?php mysql_close($connection); ?>