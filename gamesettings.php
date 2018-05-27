<form action="javascript:;submit_edits(<?php echo $_REQUEST['sect']; ?>);" name="edit_data" id="edit_data"> 
<?php
$query = mysqli_query($conn, "show columns from gamemetadata");



$query_data = mysqli_query($conn, "select * from gamemetadata where intid=" . $_REQUEST['id']);

$row_data= mysqli_fetch_array($query_data);

while($row= mysqli_fetch_array($query)){

   ?>
     <div class="form-control" style="display:inline-block;border: 1px solid #c2c2c2;border-radius:5px; margin:5px 0px;">
       <div class="row">
         <label><?php echo ucfirst($row[0]); ?></label>
         <input type="<?php $row[0]=='intid'?'hidden':'text'; ?>" name="<?php echo $row[0]; ?>" id="<?php echo $row[0]; ?>" value="<?php echo $row_data[$row[0]]; ?>" />
       </div>
     </div>  
   <?php
}

?>
</form>
