<?php
if(isset($_GET['trancode'])){
 $old_ext = pathinfo($_REQUEST['trancode'], PATHINFO_EXTENSION);
 echo "ffmpeg -i '" . $_REQUEST['trancode'] . "' -acodec libvorbis -ac 2 -ab 96k -ar 44100 -b:v 345k -s 640x360 '" . str_replace( $old_ext, 'webm', $_REQUEST['trancode']) . "'";
 exec("ffmpeg -i '" . $_REQUEST['trancode'] . "' -acodec libvorbis -ac 2 -ab 96k -ar 44100 -b:v 345k -s 640x360 '" . str_replace( $old_ext, 'webm', $_REQUEST['trancode']) . "'");
 exit;
}
exec("mythutil --scanvideos");
require('config.php');

?>
<script>
function video_stream(vid, act){
   $('#modal, #videoplayer').show();
}
function trancode_video(file){
  $.ajax({
         url: 'vplaylist.php?trancode=' + file,
         success: function(response){
         
         }
   });      
}
$('#modal, #videoplayer').show();
</script>
<style>
.videos .video img[src="images/stream.png"], .videos .video img[src="images/transcode.png"] {
	width: 35px;
	height: 40px;
	position: relative;
	top: 165px;
	left: -20px;
	margin-bottom: -45px;
}
</style>
<p class="fa fa-window-close" onclick="$('#modal').hide();"></p>
 
<ul id="playlist" class="playlist videos">
<video width="320" height="240" controls style="display:none;" id="videoplayer">
  <source src="http://10.0.0.186/Videos/10.Cloverfield.Lane.2016.HDRip.XViD.AC3-ETRG/10.Cloverfield.Lane.2016.HDRip.XViD.AC3-ETRG.webm" type="video/webm">
</video> 
<?php
$exts = array('avi', 'mp4', 'mkv', 'flv', 'wmv', 'webm');

$query = mysqli_query($conn, "select * from videometadata");

while($row = mysqli_fetch_array($query)){
$old_ext = pathinfo("/mnt/storage/videos/" . $row['filename'], PATHINFO_EXTENSION); 

        $ext = pathinfo('/mnt/storage/videos/' . $row['filename'], PATHINFO_EXTENSION);
        if(!preg_match('/sample/i', $row['title']) & in_array($ext, $exts)){
        include('vresults.php');
          
        }else{
        exec("rm \"" . $conf['directory'] . "videos/" . $row['filename'] . "\" -f");
        mysqli_query($conn, "delete from videometadata where intid=" . $row['intid']);
        }
}
echo mysqli_error($conn);
?>
</ul>
<script>
$('.video').click(function(){

    //post_remote('play file ' + $(this).attr('alt'))
//$('#modal').hide();
});
</script>
