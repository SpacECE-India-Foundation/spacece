<h6 class="card-title"><?php echo $video_data['title']; ?></h6>

                                        <?php echo $video_data['v_date']; ?> <br>
                                        <a href="likecnt.php?btn=<?php echo $video_data['v_id'] ?>">
                                            <button name="likecnt" class ="btn"><img src="like.png" style="justify-content: center; padding-left: 30%; height: 20px; width: auto"></button>
                                            
                                        </a>
                                        <?php echo $video_data['cntlike']; ?>
                                        <a href="likecnt.php?btn1=<?php echo $video_data['v_id'] ?>">
                                            <button name="dislikecnt" class = "btn"><img src="dislike.png" style="justify-content: center; padding-left: 30%; height: 20px; width: auto"></button>
                                            
                                        </a>
                                        <?php echo $video_data['cntdislike']; ?>
                                        <button name="share" class = "btn"><a href="whatsapp://send?text=<?php echo "*SpacTube - Video Gallery on Child Education* %0a %0aI am sharing one important video on Child Education.%0ahttps://www.youtube.com/watch?v=". $video_data['v_url'] . " %0a %0aYou can also subscribe to SpacTube by clicking on the following.%0ahttps://www.spacece.co/offerings/spactube %0a %0aThanks and Regards, %0aSpacECE India Foundation %0a %0awww.spacece.co %0awww.spacece.in %0a"; ?>" data-action="share/whatsapp/share" target="_blank"><img src="share.jpg" style="justify-content: center; padding-left: 30%; height: 20px; width: auto"></a></button>
                                        <!-- <a href="comment.php">
                                            <button name="comment" class="btn"><img src="comments.png" style="justify-content: center; padding-left: 30%; height: 20px; width: 35px"></button>
                                        </a> -->