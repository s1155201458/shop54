<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
class ProductController
{
    protected $db;
    protected $inputs;
    public function __construct()
    {
        $this->db = new SQLite3('../cart.db');
        $this->inputs = $this->sanitizeInput();
    }
    private function sanitizeInput()
    {
        $inputs = [
            'catid' => null,
            'name' => null,
            'description' => null,
            'price' => null,
        ];
        if (isset($_POST['catid'])) {
            $inputs['catid'] = filter_input(INPUT_POST, 'catid', FILTER_VALIDATE_INT);
        }
        if (isset($_POST['name'])) {
            $inputs['name'] = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
        }
        if (isset($_POST['description'])) {
            $inputs['description'] = htmlspecialchars($_POST['description'], ENT_QUOTES, 'UTF-8');
        }
        if (isset($_POST['price'])) {
            $inputs['price'] = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
        }
        return $inputs;
    }
    private function saveImage()
    {
        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        move_uploaded_file($image_tmp, '../images/' . $image);

        return $image;
    }
    public function createProduct()
    {
        extract($this->inputs);
        $image = $this->saveImage();
        if ($catid !== false && $name && $description && $price !== false) {
            $stmt = $this->db->prepare("INSERT INTO products (catid, name, description, price, image) VALUES (:catid, :name, :description, :price, :image)");
            $stmt->bindValue(':catid', $catid);
            $stmt->bindValue(':name', $name);
            $stmt->bindValue(':description', $description);
            $stmt->bindValue(':price', $price);
            $stmt->bindValue(':image', $image);
            if ($stmt->execute()) {
                header('Location: ../admin.php');
                exit();
            } else {
                echo "Error :" . $this->db->lastErrorMsg();
                exit();
            }
        } else {
            echo 'Invalid input';
            exit();
        }
        $this->db->close();
    }
}

$controller = new ProductController();
$controller->createProduct();
?>