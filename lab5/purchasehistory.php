<?php
    include "dbconnection.php";
    $conn= getDatabaseConnection("ottermart");
    $productId= $_GET['productId'];
    $sql = "SELECT * 
    FROM om_product
    NATURAL JOIN om_purchase
    WHERE productId = :pId";

    $np = array();
    $np[':pId'] = $productId;

    $stmt= $conn->prepare($sql);
    $stmt->execute($np);
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql = "SELECT * FROM om_product WHERE productId = :pId";

    $np = array();
    $np[':pId'] = $productId;

    $stmt= $conn->prepare($sql);
    $stmt->execute($np);
    $productInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //print_r($productInfo);
    
    echo $productInfo[0]["productName"]."</br>";
    echo "<img src='". $productInfo[0]['productImage'] ."' width=200/> <br/>";
        

    if (empty($records)){
        echo "No history";
    }
    else{

        foreach ($records as $record){
            echo "Purchase Date: " . $record['purchaseDate'] . "<br/>";
            echo "Unit Price: " . $record['unitPrice'] . "<br/>";
            echo "Quantity: " . $record['quantity'] . "<br/>";
        }
    }
    

    

?>