<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../config/database.php';
    include_once '../class/product.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Product($db);

    $stmt = $items->getProduct();
    $itemCount = $stmt->rowCount();


    echo json_encode($itemCount);

    if($itemCount > 0){
        
        $productArr = array();
        $productArr["body"] = array();
        $productArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "naam" => $naam,
                "beschrijving" => $beschrijving,
                "prijs" => $prijs,
                "category_id" => $category_id,
                "toegevoegd_op" => $toegevoegd_op
            );

            array_push($productArr["body"], $e);
        }
        echo json_encode($productArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>