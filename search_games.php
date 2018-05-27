<?php
require('config.php');
$query = mysqli_query($conn, "select * from gamemetadata where title like '%" . $_REQUEST['q'] . "%'");
?>
<p class="fa fa-window-close" onclick="$('#modal').hide();"></p>
<ul id="playlist" class="playlist videos games">
<?php
$exts = array('avi', 'mp4', 'mkv', 'flv', 'wmv');
while($row = mysqli_fetch_array($query)){
        $ext = pathinfo('/nt/storage/videos/' . $row['filename'], PATHINFO_EXTENSION);
        
          include('gresults.php');
       
}
?>
</ul>
<script>
$('.video').click(function(){

    //post_remote('play file ' + $(this).attr('alt'))
$('#modal').hide();
});
</script>
