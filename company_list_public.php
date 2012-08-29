<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>

<?php find_selected_page();?>

<?php include("includes/header.php"); ?>
			<!-- replace table with a CSS -->
			<table id="structure">
				<tr>
					<td id="navigation">
						<!--<?php echo navigation($sel_subject,$sel_page); ?>
						<br />-->
						<!--<a href="new_subject.php">+ Add a new subject</a>-->
						<br>
						<br>
						<a href="company_list_public.php">Portfolio Companies</a>	
					</td>
					<td id="page">
						<div>
						<h2>Portfolio Companies</h2>
						</div>
						<?php echo companylist(); ?>
					</td>
				</tr>
			</table>
<?php require("includes/footer.php"); ?>
