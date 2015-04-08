<?php

    // Service Details
        // Var : Content
        $title = "Youtube Private Streaming";
        $copyright = "Youtube Private Streaming";
        $logo = "img/logo.png"; // Example: http://www.myimages.com/images/logo.png Size: 300x75 px

    // Private Youtube Video Streaming

        if($_GET['stream'] == "" || $_GET['stream'] == "empty"){
            $StreamAccess = 0;
        }else{
            $StreamAccess = 1;
        }

        $VideoFile = file_get_contents("http://gdata.youtube.com/feeds/api/videos/".$_GET['stream']."?v=2&alt=json");
        $VideoGet  = json_decode($VideoFile, true);

        $VideoName = $VideoGet['entry']['title']['$t'];
        $VideoViews = $VideoGet['entry']['yt$statistics']['viewCount'];
        $VideoLikes = $VideoGet['entry']['yt$rating']['numLikes'];
        $VideoDislikes = $VideoGet['entry']['yt$rating']['numDislikes'];
        $VideoPublished = $VideoGet['entry']['published']['$t'];

        $Stream = '<iframe width="965" height="575" src="https://www.youtube.com/embed/'.$_GET['stream'].'?autohide=0&cc_load_policy=0&fs=0&modestbranding=1&showinfo=0" frameborder="0" allowfullscreen></iframe>';

?>
<!DOCTYPE html>
 <html lang="en">
     <head>
        <meta charset="UTF-8">
         
        <title><?php echo $title; ?></title>
         
        <link href="style/css/bootstrap.min.css" rel="stylesheet">
        <link href="css/primary.css" rel="stylesheet">
        <link href="https://s.ytimg.com/yts/img/favicon-vfldLzJxy.ico" rel="shortcut icon">
     </head>
     <body>
         
         <div id="wrapper">
             
             <div class="container" id="top"><a href="index.php"><img src="<?php echo $logo; ?>"></a></div>
             
             <div class="panel panel-default" id="Stream">
                <div class="panel-heading" id="Panel-Heading">
                 <?php
                    // if Stream Access
                        if($StreamAccess == 0)
                            echo '<center>Youtube Private Video Streaming</center>';   
                        else
                            echo "<span class='glyphicon glyphicon-facetime-video' aria-hidden='true'></span> &nbsp;".$VideoName.'<div style="float: right;"><a href="index.php?stream='.$_GET["stream"].'"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span></a> &nbsp;&nbsp;<a href="?stream=empty"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></div>';
                            
                 ?>
                </div>
                <div class="panel-body">
                    <?php
                        // if Stream Access
                            if($StreamAccess == 0)
                                echo '
                                
                                   <div class="panel panel-default" id="answer">
                                        <div class="panel-body">
                                            <font color="#f7f7f7">Where I find the video id?</font> <br/>
                                            <font color="#585858">https://www.youtube.com/watch?v=</font><font color="#e52d27"><strong>PRU2ShMzQRg</strong></font>
                                        </div>
                                    </div>
                                
                                   <form action="index.php?stream=" method="get">
                                    <div class="input-group input-group-lg" id="Video-Input">
                                        <span class="input-group-addon" id="sizing-addon1" style="background: #000000; border-color: #000;"><span class="glyphicon glyphicon-film" aria-hidden="true"></span></span>
                                        <input type="text" class="form-control"  name="stream" id="Video-Post" placeholder="Youtube Video ID" aria-describedby="sizing-addon1">
                                    </div>
                                    <button class="btn btn-default btn-block" id="Video-Button" type="submit">Stream</button>
                                   </form>
                                ';
                            else
                                echo $Stream;
                    ?>
                </div>
                <div class="panel-footer" id="Panel-Footer">
                 <?php
                    // if Stream Access
                        if($StreamAccess == 0)
                            echo '<center>&copy; Copyright '.$copyright.' '.date(Y).'.</center>';   
                        else
                            // Print Video details
                             echo '
                             <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> <font color="#d7d7d7">'.number_format($VideoViews,0,".",".").'</font>
                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                             <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span> <font color="#d7d7d7">'.number_format($VideoLikes,0,".",".").'</font>
                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                             <span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span> <font color="#d7d7d7">'.number_format($VideoDislikes,0,".",".").'</font>
                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                             <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> <font color="#d7d7d7">'.substr(str_replace('-','/',$VideoPublished),0,-14).'</font>
                             
                             <div style="float: right;">
                                Download: &nbsp;<a href="http://convert2mp3.net/c-mp4.php?url=http://www.youtube.com/watch?v='.$_GET['stream'].'" target="_blank">MP4</a>&nbsp;or&nbsp;<a href="http://convert2mp3.net/c-mp3.php?url=http://www.youtube.com/watch?v='.$_GET['stream'].'" target="_blank">MP3</a>
                             </div>
                             ';
                        
                 ?>
                </div>
             </div>
             
         </div>
     
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
     </body>
 </html>
