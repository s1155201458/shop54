<?php
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
        $filterArgs = [
            'catid' => FILTER_VALIDATE_INT,
            'name' => ["filter" => FILTER_SANITIZE_STRING, "flags" => FILTER_FLAG_NO_ENCODE_QUOTES],
        ];

        return filter_input_array(INPUT_POST, $filterArgs);
    }
    public function createCategory()
    {
        extract($this->inputs);

        if ($name !== false) {
            $stmt = $this->db->prepare("INSERT INTO categories (name) VALUES (:name)");
            $stmt->bindValue(':name', $name);

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
$controller->createCategory();
?>