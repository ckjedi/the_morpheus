<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
		if (intval($_GET['comp']) == 0) {
			redirect_to("company_list.php");
		}
		if (isset($_POST['submit'])) {
			$errors = array();

			$required_fields = array('name', 'position', 'visible');
			foreach($required_fields as $fieldname) {
				if (!isset($_POST[$fieldname]) || (empty($_POST[$fieldname]) && !is_numeric($_POST[$fieldname]))) { 
					$errors[] = $fieldname; 
				}
			}
			$fields_with_lengths = array('name' => 30);
			foreach($fields_with_lengths as $fieldname => $maxlength ) {
				if (strlen(trim(mysql_prep($_POST[$fieldname]))) > $maxlength) { $errors[] = $fieldname; }
			}
			
			if (empty($errors)) {
				// Perform Update
				$id = mysql_prep($_GET['comp']);
				$name = mysql_prep($_POST['name']);
				$position = mysql_prep($_POST['position']);
				$visible = mysql_prep($_POST['visible']);
				
				$query = "UPDATE portfolio_company SET 
							name = '{$name}', 
							position = {$position}, 
							visible = {$visible} 
						WHERE id = {$id}";
				$result = mysql_query($query, $connection);
				if (mysql_affected_rows() == 1) {
					// Success
					$message = "The Company was successfully updated.";
				} else {
					// Failed
					$message = "The Company update failed.";
					$message .= "<br />". mysql_error();
				}
				
			} else {
				// Errors occurred
				$message = "There were " . count($errors) . " errors in the form.";
			}
		} // end: if (isset($_POST['submit']))
?>
<?php find_selected_company();?>

<?php include("includes/header.php"); ?>
			<!-- replace table with a CSS -->
			<table id="structure">
				<tr>
					<td id="navigation">
						<!--<?php echo navigation($sel_subject,$sel_page); ?>-->
						<!--<a href="new_subject.php">+ Add a new subject</a>-->
						<br>
						<br>
						<a href="company_list.php">Portfolio Companies</a>	
					</td>
					<td id="page">
						<h2>Edit Company: <?php echo $sel_company['name'];?></h2>
						<?php if (!empty($message)) {
							echo "<p class=\"message\">" . $message . "</p>";
						} ?>
						<?php
						// output a list of the fields that had errors
						if (!empty($errors)) {
							echo "<p class=\"errors\">";
							echo "Please review the following fields:<br />";
							foreach($errors as $error) {
								echo " - " . $error . "<br />";
							}
							echo "</p>";
						}
						?>
						<form action="company_edit.php?comp=<?php echo urlencode($sel_company['id']);?>" method="post">
							<p>Company name: 
								<input type="text" name="name" value="<?php echo $sel_company['name'];?>" id="name" />
							</p>
							<p>Position: 
								<select name="position">
									<?php
										$company_set = get_portfolio_company_all();
										$company_count = mysql_num_rows($company_set);
										// $subject_count + 1 b/c we are adding a subject
										for($count=1; $count <= $company_count+1; $count++) {
											echo "<option value=\"{$count}\"";
											if($sel_company['position']==$count){
												echo " selected";
											}
											echo ">{$count}</option>";
										}
									?>
								</select>
							</p>
							<p>Visible: 
								<input type="radio" name="visible" value="0"<?php 
								if ($sel_company['visible'] == 0) { echo " checked"; } 
								?> /> No
								&nbsp;
								<input type="radio" name="visible" value="1"<?php 
								if ($sel_company['visible'] == 1) { echo " checked"; } 
								?> /> Yes
							</p>
							<input type="submit" name="submit" value="Edit Company" />
							&nbsp;&nbsp;
							<!-- <a href="company_delete.php?comp=<?php echo urlencode($sel_company['id']);?>" onclick="return confirm('Are you sure?');">Delete Company</a> -->
						</form>
						<br />
						<a href="company_list.php">Cancel</a>
					</td>
				</tr>
			</table>
<?php require("includes/footer.php"); ?>
