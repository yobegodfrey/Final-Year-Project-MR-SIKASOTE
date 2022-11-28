<!-- Export link -->
<div class="col-md-12 head">
    <div class="float-right">
        <a href="exportData.php" class="btn btn-success"><i class="dwn"></i> Export</a>
    </div>
</div>

<!-- Data list table --> 
<table class="table table-striped table-bordered">
    <thead class="thead-dark">
        <tr>
            <th>reply_text</th>
            <th>user_id</th>
            <th>conversation_id</th>
        </tr>
    </thead>
    <tbody>
   <?php 
    // Fetch records from database 
    $result = $db->query("SELECT * FROM replies"); 
    if($result->num_rows > 0){ 
        while($row = $result->fetch_assoc()){ 
    ?>
        <tr>
            <td><?php echo $row['reply_text']; ?></td>
            <td><?php echo $row['user_id']; ?></td>
            <td><?php echo $row['conversation_id']; ?></td>
            <td> <?php echo ($row['status'] == 1)?'Active':'Inactive'; ?> </td>
        </tr>
    <?php } }else{ ?>
        <tr><td colspan="7">No member(s) found...</td></tr>
    <?php } ?>
    </tbody>
</table>