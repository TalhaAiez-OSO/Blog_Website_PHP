<?php
declare(strict_types=1);
require_once __DIR__ . "\\..\\Classes\\SQL_CLASS.php";

function dbConnect(): void
{
    $_SESSION["user"] = new SQL("localhost", "blog_website");
    $_SESSION["user"]->connect("root", "");
}

function dbDisconnect(): void
{
    $_SESSION["user"]->disconnect();
    unset($_SESSION["user"]);
}

function userRegister(string $password, string $confpassword, string $email): bool
{
    dbConnect();
    if($password == $confpassword)
    {
        $_SESSION["user"]->register($email, $password);
        dbDisconnect();
        return true;
    }
    else{
        dbDisconnect();
        return false;
    }
}

function userLogin(string $email, string $password): void
{
    dbConnect();
    $_SESSION["logged_in"] = $_SESSION["user"]->login($email, $password);
    dbDisconnect();
}

function create_Post(string $title, string $content, string $author): void{
    dbConnect();
    $_SESSION["user"]->createPost($title, $content, $author);
    dbDisconnect();
}

function posts(string $email = "HOME"): array{
    dbConnect();
    $posts = $_SESSION["user"]->fetchPost($email);
    dbDisconnect();
    return $posts;
}

function delete(string $date): void{
    dbConnect();
    $_SESSION["user"]->deletePost($date);
    dbDisconnect();
}

function updateViewed(string $date, int $currViewCount): void{
    dbConnect();
    $_SESSION["user"]->updateViewCount($currViewCount, $date);
    dbDisconnect();
}

function update_Post(string $title, string $content, string $date): void{
    dbConnect();
    $_SESSION["user"]->updatePost($title, $content, $date);
    dbDisconnect();
}

function singlePost(string $date): array{
    dbConnect();
    $post = $_SESSION["user"]->fetchSinglePost($date);
    dbDisconnect();
    return $post;
}

function PagesNum(int $postNum): float
{
    $pageNum = ceil($postNum / 5);
    return $pageNum;
}

function csrf(string $csrfString): string
{
    if(empty($_SESSION['key'])){
        $_SESSION['key'] = bin2hex(random_bytes(32));
    } 
    $csrf = hash_hmac('sha256', 'RandomSeed:'. $csrfString , $_SESSION['key']);
    return $csrf;
}

function displayPosts(){

}