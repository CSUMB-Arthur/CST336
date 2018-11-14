<?php
    include 'wmapi.php';
    include 'functions.php';
    session_start();
    if (!isset($_SESSION['cart'])){
        $_SESSION['cart'] = array();
    }
    if (isset($_POST['itemName'])){
        $found = false;
        //Search for item in cart, if found, increase quantity
        foreach ($_SESSION['cart'] as &$item){
            if ($_POST['itemId'] == $item['id']){
                $found = true;
                $item['quantity']++;
                break;
            }
        }
        //If not found, add new entry
        if (!$found){
            $newarray = array();
            $newarray['name'] = $_POST['itemName'];
            $newarray['id'] = $_POST['itemId'];
            $newarray['price'] = $_POST['itemPrice'];
            $newarray['image'] = $_POST['itemImage'];
            $newarray['quantity'] = 1;
            //$_SESSION['cart'][] = $newarray;
            array_push($_SESSION['cart'], $newarray);
        }
    }
    if (isset($_GET['query'])){
        $items = getProducts($_GET['query']);
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <title>Products Page</title>
    </head>
    <body>
    <div class='container'>
        <div class='text-center'>
            
            <!-- Bootstrap Navagation Bar -->
            <nav class='navbar navbar-default - navbar-fixed-top'>
                <div class='container-fluid'>
                    <div class='navbar-header'>
                        <a class='navbar-brand' href='#'>Shopping Land</a>
                    </div>
                    <ul class='nav navbar-nav'>
                        <li><a href='index.php'>Home</a></li>
                        <li><a href='scart.php'><span>Cart: <?php displayCartCount();?></span></a></li>
                    </ul>
                </div>
            </nav>
            <br /> <br /> <br />
            
            <!-- Search Form -->
            <form enctype="text/plain">
                <div class="form-group">
                    <label for="pName">Product Name</label>
                    <input type="text" class="form-control" name="query" id="pName" placeholder="Name">
                </div>
                <input type="submit" value="Submit" class="btn btn-default">
                <br /><br />
            </form>
            
            <!-- Display Search Results -->
            <?php

                if (isset($_GET['query'])){
                    displayResults();
                }
            ?>
            
        </div>
    </div>
    </body>
</html>