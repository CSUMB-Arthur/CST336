<?php
    include "dbconnection.php";
    $conn= getDatabaseConnection("ottermart");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="css/styles.css" rel="stylesheet" type="text/css"/>
        <title>Ottermart Product Search</title>
    </head>
    <body>
        <div>
            <h1>OtterMart Product Search</h1>
            
            <form>
                Product: <input type ="text" name="product"/>
                <br/>
                Category: 
                    <select name="category"> 
                        <option value="">Select One</option>
                        <?= displayCategories()?>
                    </select>
                <br/>
                Price: $<input type="text" name="priceFrom" size="7" placeholder="min"/> to $<input type="text" name="priceTo" size="7" placeholder="max"/>
                <br/>
                Order By:
                <br/>
                <input type="radio" name="orderBy" value="price"/ checked> Price <br/>
                <input type="radio" name="orderBy" value="name"/> Name <br/>
                <br/><br/>
                <input type="submit" name="searchForm" value="Search"/>
            </form>
            
            <br/>
            </div>
            <hr>
            <?=displaySearchResults()?>;
        </div>
    </body>
</html>