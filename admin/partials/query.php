<?php

$buku = query("SELECT * FROM books");

$users = query("SELECT * FROM users");
$users2 = query("SELECT * FROM users");




$kategori = query("SELECT * FROM categories");
$pesan_baru = query("SELECT * FROM pesan_baru");


$buku_join = query("SELECT * FROM books JOIN categories ON books.category_id = categories.id");

// $ord_details = query("SELECT * FROM order_details JOIN books ON order_details.book_id = books.id_book");

$carts = query("SELECT * FROM carts JOIN books ON carts.book_id = books.id_book ");

$buku_habis = query("SELECT * FROM books 
JOIN categories ON books.category_id = categories.id 
WHERE books.stock IS NOT NULL");

$buku_tersedia = query("SELECT * FROM books 
JOIN categories ON books.category_id = categories.id 
WHERE books.stock IS NOT NULL");