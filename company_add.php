<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>


<?php include("includes/header.php"); ?>
			<!-- replace table with a CSS -->
			<table id="structure">
				<tr>
					<td id="navigation">
						<!--<?php echo navigation($sel_subject,$sel_page); ?>-->
						<br />
						<!--<a href="new_subject.php">+ Add a new subject</a>-->
						<br>
						<br>
						<a href="company_list.php">Portfolio Companies</a>	
					</td>
					<td id="page">
						<h2>Add Company</h2>
						<form action="company_create.php" method="post">
							<p>Company name: 
								<input type="text" name="name" value="" id="name" />
							</p>
							<p>Position: 
								<select name="position">
									<?php
										$company_set = get_portfolio_company_all();
										$company_count = mysql_num_rows($company_set);
										// $subject_count + 1 b/c we are adding a subject
										for($count=$company_count+1; $count <= $company_count+1; $count++) {
											echo "<option value=\"{$count}\">{$count}</option>";
										}
									?>
								</select>
							</p>
							<p>Visible: 
								<input type="radio" name="visible" value="0" /> No
								&nbsp;
								<input type="radio" name="visible" value="1" /> Yes
							</p>
							<input type="submit" value="Add Company" />
						</form>
						<br />
						<a href="content.php">Cancel</a>
					</td>
				</tr>
			</table>
<?php require("includes/footer.php"); ?>
