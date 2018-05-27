 <ul class="albums_list">
                        <?php $sqla = "select distinct album_name, album_id from music_albums where artist_id=$row[artist_id] order by album_name asc"; 
                            $qrya = mysqli_query($conn, $sqla);
                            while($rowa = mysqli_fetch_array($qrya)){
                            ?>
                                <li class="show_songs" data-album="<?php echo $rowa['album_id']; ?>" data-artist="<?php echo $row['artist_id']; ?>"><a href='#'><span><?php echo $rowa['album_name']; ?></span><p id="album_<?php echo $rowa['album_id']; ?>" class="select_album"></p></a>
                            </li>
                            <?php } ?>
                        </ul>
