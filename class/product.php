<?php
    class Product{

        // Connection
        private $conn;

        // Table
        private $db_table = "product";

        // Columns
        public $id;
        public $naam;
        public $beschrijving;
        public $prijs;
        public $category_id;
        public $toegevoegd_op;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getProduct(){
            $sqlQuery = "SELECT id, naam, beschrijving, prijs, category_id, toegevoegd_op,  gewijzigd_op FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createProduct(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        naam = :naam, 
                        beschrijving = :beschrijving, 
                        prijs = :prijs, 
                        category_id = :category_id, 
                        toegevoegd_op = :toegevoegd_op";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->naam=htmlspecialchars(strip_tags($this->naam));
            $this->beschrijving=htmlspecialchars(strip_tags($this->beschrijving));
            $this->prijs=htmlspecialchars(strip_tags($this->prijs));
            $this->category_id=htmlspecialchars(strip_tags($this->category_id));
            $this->toegevoegd_op=htmlspecialchars(strip_tags($this->toegevoegd_op));
        
            // bind data
            $stmt->bindParam(":naam", $this->naam);
            $stmt->bindParam(":beschrijving", $this->beschrijving);
            $stmt->bindParam(":prijs", $this->prijs);
            $stmt->bindParam(":category_id", $this->category_id);
            $stmt->bindParam(":toegevoegd_op", $this->toegevoegd_op);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // READ single
        public function getSingleProduct(){
            $sqlQuery = "SELECT
                        id, 
                        naam, 
                        beschrijving, 
                        prijs, 
                        category_id, 
                        toegevoegd_op
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->naam = $dataRow['naam'];
            $this->beschrijving = $dataRow['beschrijving'];
            $this->prijs = $dataRow['prijs'];
            $this->category_id = $dataRow['category_id'];
            $this->toegevoegd_op = $dataRow['toegevoegd_op'];
        }        

        // UPDATE
        public function updateProduct(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        naam = :naam, 
                        beschrijving = :beschrijving, 
                        prijs = :prijs, 
                        category_id = :category_id, 
                        toegevoegd_op = :toegevoegd_op
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->naam=htmlspecialchars(strip_tags($this->naam));
            $this->beschrijving=htmlspecialchars(strip_tags($this->beschrijving));
            $this->prijs=htmlspecialchars(strip_tags($this->prijs));
            $this->category_id=htmlspecialchars(strip_tags($this->category_id));
            $this->toegevoegd_op=htmlspecialchars(strip_tags($this->toegevoegd_op));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind data
            $stmt->bindParam(":naam", $this->naam);
            $stmt->bindParam(":beschrijving", $this->beschrijving);
            $stmt->bindParam(":prijs", $this->prijs);
            $stmt->bindParam(":category_id", $this->category_id);
            $stmt->bindParam(":toegevoegd_op", $this->toegevoegd_op);
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteProduct(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>