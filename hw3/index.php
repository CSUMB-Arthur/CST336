<!DOCTYPE html>
<?php
    if (isset($_POST['submit'])){
        $text = $_POST['text'];
        $bold = (isset($_POST['bold']) ? 'checked':'');
        $italic = (isset($_POST['italic']) ? 'checked':'');
        $underline = (isset($_POST['underline']) ? 'checked':'');
        $strikethrough = (isset($_POST['strikethrough']) ? 'checked':'');
        
        $color = (isset($_POST['color']) ? $_POST['color']:'#000000');
        $color2 = (isset($_POST['color2']) ? $_POST['color2']:'#000000');
        
        $family = $_POST['family'];
    }
    else{
        $placeholder="Sample Text";
        $bold='';
        $italic='';
        $underline='';
        $strikethrough='';
        $color = '#000000';
        $color2 = '#ffffff';
        
        $family = 'serif';
    }
?>
<html>
    <head>
        <title>Forms</title>
        <style>
            @import url("css/styles.css");
        </style>
    </head>
    <body>
        <head>
            <h1>
                Text Tester
            </h1>
        <br/>
        </head>
            <div id="maincontainer">
                <form method="post">
                    <table id="upperinput">
                        <div>
                        <tr>
                            <td>
                                <input id="formtextbox" type="text" name="text" <?php echo (isset($_POST['text']) ? "value="."'$text'":'')?> placeholder="Sample text" />
                            </td>
                        
                            <td>
                                <input id="submitbox" type="submit" name="submit" value="Submit"/>
                            </td>
                        </tr>
                        </div>
                    </table>
                    
                    
                    <table class="generic-container">
                        <tr>
                            <td class="inputcol">
                                <fieldset>
                                    <legend>Font options</legend>
                                    <input id="multiple" type="checkbox" name="bold" <?php echo $bold;?> />Bold<br/>
                                    <input id="multiple" type="checkbox" name="italic" <?php echo $italic;?> />Italics<br/>
                                    <input id="multiple" type="checkbox" name="underline" <?php echo $underline;?> />Underline<br/>
                                    <input id="multiple" type="checkbox" name="strikethrough" <?php echo $strikethrough;?> />Strikethrough<br/>
                                </fieldset>
                            </td>
                            <td id="outputcol" rowspan="3">
                                <div>
                                    <legend>Output</legend>
                                    <font 
                                    <?php
                                    echo "color='$color' ";
                                    echo "style='";
                                    echo "background-color:$color2; ";
                                    echo "font-family:$family; ";
                                    echo "'";
                                    if ($bold == 'checked'){ echo '<strong>';}
                                    if ($italic == 'checked'){ echo '<em>';}
                                    if ($underline == 'checked'){ echo '<ul>';}
                                    if ($strikethrough == 'checked'){ echo '<del>';}
                                    echo $text;
                                    if ($bold == 'checked'){ echo '</strong>';}
                                    if ($italic == 'checked'){ echo '</em>';}
                                    if ($underline == 'checked'){ echo '</ul>';}
                                    if ($strikethrough == 'checked'){ echo '</del>';}
                                    ?>
                                    </font>
                                </div>
                            </td>
                        </tr>
                        
                        <tr>
                            <td class="inputcol">
                                <fieldset>
                                    <legend>Colors</legend>
                                    <span>Foreground</span><br/>
                                    <input type="color" name="color" value="<?php echo $color;?>" /> 
                                    <br/>
                                    <span>Background</span><br/>
                                    <input type="color" name="color2" value="<?php echo $color2;?>" /> 
                                    <br>
                                </fieldset>
                            </td>
                        </tr>
                        
                        <tr>
                            <td class="inputcol">
                                <fieldset>
                                    <legend>Font-Family</legend>
                                    <?php
                                        $families = array("serif", "sans-serif", "monospace");
                                        
                                        for ($i = 0; $i < 3; $i++){
                                            $checked = ($family == $families[$i])?'checked':'';
                                            echo "<input id='exclusive' type='radio' name='family' value='$families[$i]'$checked/>" . ucfirst($families[$i]) . "<br/>\n";
                                            //echo $stuff[$i];
                                            //echo $i ."<br/>";
                                        }
                                        
                                        //print_r($stuff);
                                    ?>
                                </fieldset>
                            </td>
                        </tr>
                        <br/>
                    </table>
                    
                </form>
                
            </div>
        
        <br/>

    </body>
            
</html>