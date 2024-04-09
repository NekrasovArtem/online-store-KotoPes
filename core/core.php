<?php
class KotoPes {
    private const string DB_HOST = 'localhost';
    private const string DB_USER = 'ueremanm_losev_artyom';
    private const string DB_PASSWORD = 'bwuLN375';
    private const string DB_NAME = 'ueremanm_db_kotopes';
    private mysqli|false $connection;

    public function getConnection():false|mysqli
    {
        $this->connection = mysqli_connect(self::DB_HOST, self::DB_USER, self::DB_PASSWORD, self::DB_NAME);
        return $this->connection;
    }

    public function getAllCategories():array
    {
        $categories['main'] = $this->getCategories();
        $categories['sub'] = $this->getSubCategories();
        return $categories;
    }

    private function getCategories():mysqli_result|bool
    {
        $sql = "SELECT * FROM categories";
        return $this->connection->query($sql);
    }

    private function getSubCategories():mysqli_result|bool
    {
        $sql = "SELECT * FROM subcategories";
        return $this->connection->query($sql);
    }

    public function getAllUsers():mysqli_result|bool
    {
        $sql = "SELECT * FROM users";
        return $this->connection->query($sql);
    }

    public function getUserData($id):false|array|null
    {
        $sql = "SELECT * FROM users WHERE id='".$id."'";
        return $this->connection->query($sql)->fetch_assoc();
    }

    public function getAllProducts():mysqli_result|bool
    {
        $sql = "SELECT products.id, products.name, categories.name as category, subcategories.name as subcategory, products.image, products.brand, products.quantity, products.price
                FROM products
                JOIN categories
                ON products.id_cat=categories.id
                JOIN subcategories
                ON products.id_subcat=subcategories.id
                ORDER BY timestamp DESC;";
        $products = $this->connection->query($sql);
        return $products;
    }

    public function getProducts($productsIds)
    {
        $ids = implode(',', $productsIds);
        $sql = "SELECT * FROM products WHERE id in ($ids)";
        return $this->connection->query($sql);
    }

    public function getProductsToOrder($ids):mysqli_result|bool
    {
        $sql = "SELECT id, name FROM products WHERE id IN (". implode(',', $ids) .")";
        return $this->connection->query($sql);
    }

    public function addNewUser($user):mysqli_result|bool
    {
        $sql = "INSERT INTO users (name, surname, phone, email, hash_password, role) VALUES ('".$user['name']."', '".$user['surname']."', '".$user['phone']."', '".$user['email']."', '".$user['hash']."', '".$user['role']."')";
        return $this->connection->query($sql);
    }

    public function updateUserInfo($user):void
    {
        $sql = "UPDATE users
        SET name='".$user['name']."', surname='".$user['surname']."', patronymic='".$user['patronymic']."', phone='".$user['phone']."', email='".$user['email']."', address='".$user['address']."', image='".$user['image']."'
        WHERE id='".$user['id']."'";
        $this->connection->query($sql);
        $_SESSION['user_image'] = $user['image'];
    }

    public function addNewProduct($newProduct):bool
    {
        $sql = "INSERT INTO products (name, id_cat, id_subcat, quantity, price, timestamp, brand, country, weight, description, image) VALUES ('".$newProduct['name']."', '".$newProduct['category']."', '".$newProduct['subcategory']."', '".$newProduct['quantity']."', '".$newProduct['price']."', '".$newProduct['date']."', '".$newProduct['brand']."', '".$newProduct['country']."', '".$newProduct['weight']."', '".$newProduct['description']."', '".$newProduct['image']."')";
        return $this->connection->query($sql);
    }

    public function addNewCategory($name):mysqli_result|bool
    {
        $sql = "INSERT INTO categories (name) VALUES ($name)";
        return $this->connection->query($sql);
    }

    public function addNewSubcategory($name):mysqli_result|bool
    {
        $sql = "INSERT INTO subcategories (name) VALUES ($name)";
        return $this->connection->query($sql);
    }

    public function deleteCategory($id):mysqli_result|bool
    {
        $sql = "DELETE FROM categories WHERE id=$id";
        return $this->connection->query($sql);
    }

    public function deleteSubcategory($id):mysqli_result|bool
    {
        $sql = "DELETE FROM subcategories WHERE id=$id";
        return $this->connection->query($sql);
    }

    public function authorization($email, $password):void
    {
        $sql = "SELECT * FROM users WHERE email='".$email."'";
        $userData = $this->connection->query($sql)->fetch_assoc();
        if (password_verify($password, $userData['hash_password'])) {
            $_SESSION['id'] = $userData['id'];
            $_SESSION['role'] = $userData['role'];
            $_SESSION['user_image'] = $userData['image'];
            Header("Location: /profile");
        } else {
            echo "Введены неправильные данные.";
        }
    }

    public function getNoveltyProducts():mysqli_result|bool
    {
        $sql = "SELECT products.id, products.name, products.price, products.image, categories.url_name FROM products
         JOIN categories ON products.id_cat=categories.id
         ORDER BY timestamp DESC LIMIT 10";
        return $this->connection->query($sql);
    }
}