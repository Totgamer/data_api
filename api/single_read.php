<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/product.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Product($db);

    $item->id = isset($_GET['id']) ? $_GET['id'] : die();
  
    $item->getSingleProduct();

    if($item->naam != null){
        // create array
        $pro_arr = array(
            "id" =>  $item->id,
            "naam" => $item->naam,
            "beschrijving" => $item->beschrijving,
            "prijs" => $item->prijs,
            "category_id" => $item->category_id,
            "toegevoegd_op" => $item->toegevoegd_op
        );
      
        http_response_code(200);
        echo json_encode($pro_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Product not found.");
    }
?>