<?php
    function getDatabaseConnection($dbname='ottermart'){
        $host='localhost';
        $username='csumbarthur';
        $password='';
        
        $dbConn= new PDO("mysql:host=$host; dbname=$dbname", $username, $password);
        
        $dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        return $dbConn;
    }
    
    function displayCategories(){
        global $conn;
        
        $sql = "SELECT catID, catName FROM om_category ORDER BY catName";
        $stmt = $conn->prepare($sql);
        $stmt-> execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($records as $record){
            //echo "<option value='$record['catid']'>$record['catName']</option>";
            echo "<option value='" . $record['catid'] . "'>" . $record['catName'] . "</option>";
        }
    }
    
    function displaySearchResults(){
        global $conn;
        if (isset($_GET['searchForm'])){
            echo "<h3>Products Found:</h3>";
            $namedParams = array();
            
            $sql="SELECT * FROM  om_product WHERE 1";
            
            if (!empty($_GET['product'])){
                $sql .= " AND productname LIKE :productname";
                $namedParams[":productname"] =  "%". $_GET['product'] ."%";
            }
            
            if (!empty($_GET['priceFrom'])){
                $sql .= " AND price >= :priceFrom";
                $namedParams[":priceFrom"] =  $_GET['priceFrom'];
            }
            
            if (!empty($_GET['priceTo'])){
                $sql .= " AND price <= :priceTo";
                $namedParams[":priceTo"] =  $_GET['priceTo'];
            }
            
            if (isset($_GET['orderBy'])){
                if ($_GET['orderBy'] == "price"){
                    $sql .= " ORDER BY price";
                }
                else{
                    $sql .= " ORDER BY productName";
                }
            }
            
            $stmt =$conn->prepare($sql);
            $stmt ->execute($namedParams);
            $records = $stmt-> fetchAll(PDO::FETCH_ASSOC);
            
            foreach($records as $record){
                echo "<a href=\"purchasehistory.php?productId=".$record['productId']."\">History</a> ";
                echo $record["productName"] . " " . $record["recordDescription"] . " $" . $record["price"] . "<br/><br/>";
            }
        }
        else{
            echo "Type in a search entry";
        }
    }
?>