<?php
declare(strict_types=1);

class SQL{
    private $dsn;
    private $connection = null;

    function __construct(string $host, string $db){
        $this->dbname = $db;
        $this->dsn = "mysql:host={$host};dbname={$db}";
    }

    public function connect(string $userName, string $password): void{
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try {
            $this->connection = new PDO($this->dsn, $userName, $password, $options);
        } catch (PDOException $e) {
            throw new Exception('Failed to connect to the database: ' . $e->getMessage());
        }
    }

    public function createPost(string $title, string $content, string $author): void{
        $stmt = $this->connection->prepare("INSERT INTO blog_post (Title, Content, ViewCount, Author) VALUES (?, ?, ?, ?)");
        $stmt->execute([$title, $content, 0, $author]);
    }

    public function updateViewCount(int $currViewCount, string $date): void{
        $stmt = $this->connection->prepare("UPDATE blog_post SET ViewCount=? WHERE Date = ?");
        $stmt->execute([$currViewCount + 1, $date]);
    }

    public function updatePost(string $title, string $content, string $date): void{
        $stmt = $this->connection->prepare("UPDATE blog_post SET Title=?, Content=? WHERE Date=?");
        $stmt->execute([$title, $content, $date]);
    }

    public function deletePost(string $date): void{
        $stmt = $this->connection->prepare("DELETE FROM blog_post WHERE Date = ?");
        $stmt->execute([$date]);
    }

    public function fetchPost(string $email): array{
        if($email === "HOME"){
            $stmt = $this->connection->prepare("SELECT * FROM blog_post");
            $stmt->execute();
            return $stmt->fetchAll();
        }
        else{
            if($_SESSION['logged_in']['isAdmin']){
                $stmt = $this->connection->prepare("SELECT * FROM blog_post");
                $stmt->execute();
                return $stmt->fetchAll();
            }
            else{
                $stmt = $this->connection->prepare("SELECT * FROM blog_post WHERE Author=?");
                $stmt->execute([$email]);
                return $stmt->fetchAll();
            }
        }
    }

    public function fetchSinglePost(string $date): array{
        $stmt = $this->connection->prepare("SELECT * FROM blog_post WHERE Date=?");
        $stmt->execute([$date]);
        return $stmt->fetchAll();
    }

    public function login(string $email, string $password): array{
        $stmt = $this->connection->prepare("SELECT Email, Password, isAdmin FROM user WHERE email=?");
        $stmt->execute([$email]);
        $storedPassword = $stmt->fetch();
        if(password_verify($password, $storedPassword['Password']))
            return $storedPassword;
        return NULL;
    }

    public function isAdmin(string $email): bool{
        $stmt = $this->connection->prepare("SELECT isAdmin FROM user WHERE email=?");
        $stmt->execute([$email]);
        $isAdmin = $stmt->fetch();
        return ($isAdmin["isAdmin"] == 1)? true : false;
    }

    public function register(string $email, string $password): bool{
        $hashedPassword = password_hash($password, PASSWORD_ARGON2I, ['memory_cost' => 1024, 'time_cost' => 2, 'threads' => 2]);
        $stmt = $this->connection->prepare("SELECT email FROM user WHERE email=?");
        $stmt->execute([$email]);
        if(count($stmt->fetchAll()) == 0)
        {
            $stmt = null;
            $stmt = $this->connection->prepare("INSERT INTO user (Email, Password) VALUES (?, ?)");
            $stmt->execute([$email, $hashedPassword]);
            return true;
        }
        else
            return false;
    }

    public function disconnect(): void{
        $this->connection = null;
    }

    function __destruct(){
        $this->disconnect();
    }
};
?>