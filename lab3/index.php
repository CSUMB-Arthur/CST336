<!DOCTYPE html>
<?php
    $backgroundimage= "img/sea.jpg";
    $layout= $_POST['layout'];
    if ($_POST['keyword'] != ''){
        //echo 'Value set';
        //echo 'You searched for ' . $_POST['keyword'];
        include 'api/pixabayAPI.php';
        $imageURLs = getImageURLs($_POST['keyword'],$layout);
        //print_r($imageURLs);
        $backgroundimage = $imageURLs[array_rand($imageURLs)];
    }

?>


<html>
    <head>
        <title>Image Carousel</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <style>
            @import url("css/styles.css");
            body{
                background-image: url('<?=$backgroundimage?>');
            }
        </style>

        

    </head>
    <body>
        <br/><br/>
        <div id="inputcontainer">
            <form method="post">
                <table>
                    <tr>

                        <td colspan="3">
                            <input id="formtextbox" type="text" name="keyword" placeholder="Keyword"/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="radioinput">

                            <input type="radio" name="layout" value="horizontal" checked/>
                            <label for="layout_h"> Horizontal </label>
                            <br>
                            <input type="radio" name="layout" value="vertical" id="layout_v" />
                            <label for="layout_v"> Vertical </label>
                        </td>
                        <td>
                            <select name="keyword">
                                <option value="">-Popular-</option>
                                <option value="Sea">Ocean</option>
                                <option value="Mountain">Mountain</option>
                                <option value="Dune">Desert</option>
                                <option value="Meadow">Meadow</option>
                            </select>
                            <input id="submitbox" type="submit" value="Submit"/>
                            
                        </td>
                    </tr>
                </table>
                
                
            </form>
        </div>

        
        <?php

            if (!isset($imageURLs)){
                //echo 'imageURLs not set';
                echo"<h2> Type a keyword to display a slideshow <br/> with random images from Pixabay.com</h2>";
            }
            else{
        ?>
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <?php
                    for ($i=0; $i<5;$i++){
                        echo "<li data-target='#carousel-example-generic' data-slide-to='$i' ";
                        echo  ($i==0)?" class= 'active'":"";
                        echo "></li>";
                    }
                ?>
            </ol>
            <div class="carousel-inner" role="listbox">
            <?php
                
                    //echo 'imageURLs set';
                    //Display carousel
                    for ($i = 0; $i < 5; $i++){
                        do{
                            $randomIndex = rand(0,count($imageURLs));
                        }
                        while(!isset($imageURLs[$randomIndex]));

                        echo "<div class='item img-responsive center-block ";
                        echo ($i== 0)?"active":"";
                        echo "'>";
                        echo "<img src='" . $imageURLs[$randomIndex] . "'/>";
                        echo "</div>";
                        unset($imageURLs[$randomIndex]);
                    }
            ?>
            
            </div>

            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
            
        </div>
            <?php
                }
            ?>
        

        
        <br/><br/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
            
</html>