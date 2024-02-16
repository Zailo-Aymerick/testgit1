<?php
require_once('utils/DBconnect.php');
require_once('dao/IProductDao.php');
class IProductDaoImp implements IProductDao
{

    private PDO $conn;

    public function __construct()
    {
        $this->conn = DBconnect::getInstance(
            "mysql:host=localhost;dbname=gestionProduit",
            "root",
            ""
        )->getConnexion();
    }
    public function saveProduct(
        $name,
        $numProduit,
        $price,
        $description
    ): bool {
        try {

            $query = "INSERT INTO product (name, numProduct, price, description) VALUES (:name, :numProduit, :price, :description)";
            $statement = $this->conn->prepare($query);
            $statement->bindValue(':name', $name, PDO::PARAM_STR);
            $statement->bindValue(':numProduit', $numProduit);
            $statement->bindValue(':price', $price);
            $statement->bindValue(':description', $description);
            $statement->execute();
            echo "produit ajouté avec succès";
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return false;
    }
    public function getAllProducts(): array
    {
        $stmt = $this->conn->query('SELECT * FROM product ;');
        $products = [];

        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($res as $row) {
            $product = new Product($row['id'], $row['name'], $row['numProduct'], $row['price'], $row['description']);
            $products[] = $product;
        }
        return $products;
    }

    function updateProduct($name, $numProduct, $price, $description, $id): bool
    {
        try {
            $query  = "UPDATE Product SET name = :name , price = :price , numProduct = :numProduct, 
            description = :description WHERE id = :id ;";

            $stmt = $this->conn->prepare($query);

            $stmt->bindValue(":id", $id);
            $stmt->bindValue(':name', $name);
            $stmt->bindValue(':numProduct', $numProduct);
            $stmt->bindValue(':price', $price);
            $stmt->bindValue(':description', $description);

            $stmt->execute();
            return true;
        } catch (PDOException $PDOException) {
            echo $PDOException->getMessage();
        }
        return false;
    }

    function deleteProduct($id): bool
    {
        $query = "DELETE FROM product
        WHERE id=:id;";

        try {
            $statement = $this->conn->prepare($query);
            $statement->bindParam(":id", $id);

            $statement->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        return false;
    }

    public function getProductById($id): array
    {
        $product = [];
        try {

            $query = "SELECT * FROM product WHERE id = :id ;";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($result as $row) {
                // Création d'un nouvel objet Person avec les données récupérées
                $product[] = new Product(
                    $row["id"],
                    $row['name'],
                    $row['numProduct'],
                    $row['price'],
                    $row['description']
                );
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        } // end catch
        return $product;
    }
    function getProductsByName($name): array
    {

        return [];
    }
    function getProductsByPriceIN($minPrice, $maxPrice): array
    {
        return [];
    }
}
