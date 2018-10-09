<?php
require('config.php');
$query = mysqli_query($conn, "select * from videometadata where title like '%" . $_REQUEST['q'] . "%'");
?>

 <video width="320" height="240" controls style="display:none;" id="videoplayer">
  <source src="" type="video/webm" id="mp4video" />
</video> 
<ul id="playlist" class="playlist videos">
<?php
$exts = array('avi', 'mp4', 'mkv', 'flv', 'wmv');
while($row = mysqli_fetch_array($query)){
        $ext = pathinfo('/nt/storage/videos/' . $row['filename'], PATHINFO_EXTENSION);
        if(!preg_match('/sample/i', $row['title']) & in_array($ext, $exts)){
          include('vresults.php');
        }else{
        exec("rm \"" . $conf['directory'] . "videos/" . $row['filename'] . "\" -f");
        mysqli_query($conn, "delete from videometadata where intid=" . $row['intid']);
        }
}
?>
</ul>
<script>
$('.video').click(function(){

    //post_remote('play file ' + $(this).attr('alt'))
$('#modal').hide();
});
</script>
