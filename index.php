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
						<!-- When we start using the Subjects and Pages-->
						<!--<a href="new_subject.php">+ Add a new subject</a>-->
						<br>
						<br>
						<a href="company_list_public.php">Portfolio Companies</a>	
					</td>
					<td id="page">
						
						<?php if(!is_null($sel_subject)){//subject selected?>
						   <h2><?php echo $sel_subject['menu_name']; ?></h2>
						   
						<?php } elseif (!is_null($sel_page)){//page selected?>
						   <h2><?php echo $sel_page['menu_name']; ?></h2>
						   
						   <div class="page-content">
							<?php echo $sel_page['content']; ?>
							
						   </div>
						   
						<?php } else {//nothing selected?>
						   <h2>Welcome to the gang!</h2>
						<?php }?>
						
					</td>
				</tr>
			</table>
<?php require("includes/footer.php"); ?>
