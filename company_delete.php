<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>

<?php
    if(intval($_GET['comp']) == 0){
        redirect_to("company_list.php");
    }
    
    $id = mysql_prep($_GET['comp']);
    
    if ($company = get_company_by_id($id)) {
        $query = "DELETE FROM portfolio_company WHERE id={$id} LIMIT 1";
        $result = mysql_query($query,$connection);
        if(mysql_affected_rows() == 1){
            redirect_to("company_list.php");
        }else{
            echo "<p>Subject deletion failed.</p>";
            echo "<p>" . mysql_error() . "</p>"; 
            echo "<a href=\"company_list.php\">Return to Main Page</a>";
        }
    }else{
        redirect_to("company_list.php");
    }
?>

<?php mysql_close($connection); ?>