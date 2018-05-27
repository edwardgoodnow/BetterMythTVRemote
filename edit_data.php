<?php
require('config.php');
?>
<p class="fa fa-window-close" onclick="$('#modal2').hide();"></p>
<?php
//echo "select * from music_albumart where song_id=" . $_GET['song_id'] . " order by albumart_id desc limit 1";
require($_REQUEST['sect'] . 'settings.php');
switch($_REQUEST['sect']){
  case('game'):
    $l = 'igdb'; 
  break;
  case('music'):
    $l = 'cddb';
  break;
  case('video'):
    $l = 'imdb';
  break;
}  
?>
<div id="scraper_data"></div>
<script>
function drawTable(data) {
console.log(data.length);
    for (var i = 0; i < data.length; i++) {
    console.log(data[i]);
        drawRow(data[i]);
    }
}

function drawRow(rowData) {
    var row = $("<tr />")
    $("#modal2 #scraper_data table").append(row); //this will append tr element to table... keep its reference for a while since we will add cels into it
    row.append($("<td>" + rowData.id + "</td>"));
    row.append($("<td>" + rowData.firstName + "</td>"));
    row.append($("<td>" + rowData.lastName + "</td>"));
}


$(document).ready(function(){
$('form input[name="title"], form input[name="gamename"]').keyup(function(e){
$('#scraper_data').html('<img src="loading.gif" />  ');
$("#modal2 #scraper_data").show();
$.ajax({
                        url: '<?php echo $l; ?>_parser.php',
                        data: {m: $('form input[name="title"], form input[name="gamename"]').val(), o: 'json'},
                        dataType: 'html',
                        success: function(response){
                            $("#modal2 #scraper_data").html(response);
                       
                        }        
            });
            });
});
</script>
