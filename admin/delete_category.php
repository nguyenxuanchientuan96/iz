<?php require_once'../inc/lib.php'; ?>
<?php require_once('templates-part/head.php');?>
<?php require_once('templates-part/header.php');?>
<?php require_once('templates-part/menu.php');?>
<?php include("templates-part/slider-admin.php"); ?>
<div id="content">
    <h2> Delete Category:</h2>
	   <form action="" method="post">
       <fieldset>
            <legend>Delete Category</legend>
                <label for="delete">Are you sure?</label>
                <div>
                    <input type="radio" name="delete" value="no" checked="checked" /> No
                    <input type="radio" name="delete" value="yes" /> Yes
                </div>
                <div><input type="submit" name="submit" value="Delete" onclick="return confirm('Are you sure?');" /></div>
        </fieldset>
       </form>
</div><!--end content-->

<?php require_once('templates-part/footer.php');?>