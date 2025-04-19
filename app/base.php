<?php
session_start();

function is_get() {
    return $_SERVER['REQUEST_METHOD'] == 'GET';
}

// Is POST request?
function is_post() {
    return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function get($key, $value = null) {
    $value = $_GET[$key] ?? $value;
    return is_array($value) ? array_map('trim', $value) : trim($value);
}

// Obtain POST parameter
function post($key, $value = null) {
    $value = $_POST[$key] ?? $value;
    return is_array($value) ? array_map('trim', $value) : trim($value);
}

function redirect($url = null) {
    // TODO
    $url ??=$_SERVER['REQUESR_URI'];
    header("Location:$url");
    exit();
 }

function req($key, $value = null) {
    $value = $_REQUEST[$key] ?? $value;
    return is_array($value) ? array_map('trim', $value) : trim($value);
}

function getBookDetails($name)
{
    global $_db;
    $query = $_db->prepare("SELECT * FROM products__1_ WHERE name = ?");
    $query->execute([$name]);
    return $query->fetch(PDO::FETCH_ASSOC);
}

function temp($key, $value = null) {
    if ($value !== null) {
        $_SESSION["temp_$key"] = $value;
    }
    else {
        $value = $_SESSION["temp_$key"] ?? null;
        unset($_SESSION["temp_$key"]);
        return $value;
    }
}


function getBooksByCategory($category = '')
{
    global $_db;
    if ($category) {
        $query = $_db->prepare("SELECT name, price, imageSource FROM products__1_ WHERE FIND_IN_SET(?, genre)");
        $query->execute([$category]);
    } else {
        $query = $_db->query("SELECT name, price, imageSource FROM products__1_");
    }
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function getUniqueGenres()
{
    global $_db;
    $query = $_db->query("SELECT DISTINCT genre FROM products__1_");
    $allGenres = $query->fetchAll(PDO::FETCH_COLUMN);
    $uniqueGenres = [];

    foreach ($allGenres as $genreList) {
        $genres = explode(',', $genreList);
        foreach ($genres as $genre) {
            $trimmedGenre = trim($genre);
            if (!in_array($trimmedGenre, $uniqueGenres)) {
                $uniqueGenres[] = $trimmedGenre;
            }
        }
    }
    return $uniqueGenres;
}

// Encode HTML special characters
function encode($value) {
    return htmlentities($value);
}

// Generate <input type='text'>
function html_text($key, $attr = '') {
    $value = encode($GLOBALS[$key] ?? '');
    echo "<input type='text' id='$key' name='$key' value='$value' $attr>";
}

// Generate <input type='search'>
function html_search($key, $attr = '') {
    $value = encode($GLOBALS[$key] ?? '');
    echo "<input type='search' id='$key' name='$key' value='$value' $attr>";
}

$_db= new PDO('mysql:dbname=try','root','',
                [PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_OBJ]);
                
$_books = $_db->query('SELECT bookID,name,publishedDate,author,genre,price,language,description,imageSource FROM products__1_')
                ->fetchAll(PDO::FETCH_ASSOC); //fetch as associative array

