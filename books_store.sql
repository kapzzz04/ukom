-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: book_store
-- ------------------------------------------------------
-- Server version	8.3.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `books` (
  `id_book` int NOT NULL AUTO_INCREMENT,
  `category_id` int DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `author` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `publisher` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `description` text COLLATE utf8mb4_general_ci,
  `image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_book`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `books_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books`
--

LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` VALUES (1,3,'Steve Jobs','Walter Isaacson','Simon &amp;amp;amp;amp;amp;amp;amp; Schuster',180000.00,90,'Biografi resmi Steve Jobs yang menggambarkan perjalanan hidupnya.','steve_jobs.jpg','2025-04-12 13:44:06'),(3,5,'Sapiens: A Brief History of Humankind','Yuval Noah Harari','Harper',200000.00,67,'Buku non-fiksi tentang sejarah manusia dari zaman prasejarah hingga modern.','Sapiens.jpg','2025-04-08 08:19:56'),(4,4,'percobaan','aku','aku',10000.00,1,'coba','axis.png','2025-04-08 08:06:12'),(5,1,'harry potter','saya','saya',150000.00,80,'bagus banget harus di beli','harry_potter.jpeg','2025-04-10 16:31:33'),(6,2,'DILAN 1990','zahra','aku',99000.00,90,'tentang dua remaja yang saling jatuh cinta di masa sma','dilan.jpg','2025-04-12 13:54:59');
/*!40000 ALTER TABLE `books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carts`
--

DROP TABLE IF EXISTS `carts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carts` (
  `id_carts` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `book_id` int DEFAULT NULL,
  `quantity` int NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_carts`),
  KEY `user_id` (`user_id`),
  KEY `book_id` (`book_id`),
  CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `carts_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id_book`) ON DELETE CASCADE,
  CONSTRAINT `carts_chk_1` CHECK ((`quantity` > 0))
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carts`
--

LOCK TABLES `carts` WRITE;
/*!40000 ALTER TABLE `carts` DISABLE KEYS */;
INSERT INTO `carts` VALUES (43,4,3,1,'2025-04-08 18:34:10'),(59,2,4,1,'2025-04-12 07:21:47'),(60,2,3,1,'2025-04-12 07:39:11');
/*!40000 ALTER TABLE `carts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (3,'Biografi'),(4,'Fiksi'),(1,'Komik'),(5,'Non-Fiksi'),(2,'Novel');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_items` (
  `id_items` int NOT NULL AUTO_INCREMENT,
  `order_id` int DEFAULT NULL,
  `book_id` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `price_each` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id_items`),
  KEY `order_id` (`order_id`),
  KEY `book_id` (`book_id`),
  CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id_book`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
INSERT INTO `order_items` VALUES (12,10,4,1,10000.00),(13,11,3,4,200000.00),(14,11,4,1,10000.00),(20,16,3,1,200000.00),(21,17,1,1,180000.00),(22,18,3,1,200000.00),(23,19,3,1,200000.00),(24,20,3,2,200000.00),(25,20,4,1,10000.00),(26,21,4,1,10000.00),(27,22,3,1,200000.00),(31,23,3,1,200000.00),(34,25,1,1,180000.00),(35,25,4,1,10000.00),(36,26,4,1,10000.00),(37,27,4,5,10000.00),(38,28,1,5,180000.00),(39,28,3,3,200000.00);
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` enum('pending','paid','shipped','completed','canceled') COLLATE utf8mb4_general_ci DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nama_penerima` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `metode_pembayaran` enum('gopay','shopee','dana','bca','cod') COLLATE utf8mb4_general_ci NOT NULL,
  `nomor_pembayaran` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bukti_pembayaran` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (10,4,10000.00,'completed','2025-04-08 06:50:26','','gopay',NULL,NULL),(11,4,810000.00,'completed','2025-04-08 07:36:04','','gopay',NULL,NULL),(16,4,200000.00,'pending','2025-04-08 08:17:32','','gopay',NULL,NULL),(17,4,180000.00,'pending','2025-04-08 08:18:04','','gopay',NULL,NULL),(18,4,200000.00,'pending','2025-04-08 08:20:24','','gopay',NULL,NULL),(19,4,200000.00,'pending','2025-04-08 08:24:58','','gopay',NULL,NULL),(20,4,410000.00,'pending','2025-04-08 08:35:15','','gopay',NULL,NULL),(21,4,10000.00,'pending','2025-04-08 08:35:49','','gopay',NULL,NULL),(22,2,200000.00,'pending','2025-04-08 09:19:18','','gopay',NULL,NULL),(23,2,200000.00,'pending','2025-04-10 17:17:17','keylaazhr','cod','',''),(25,2,190000.00,'canceled','2025-04-12 06:32:12','keyla','shopee','0892929982','harry_potter.jpeg'),(26,2,10000.00,'pending','2025-04-12 07:05:50','keyla','gopay','0812-3456-7890 (GoPay)','steve_jobs.jpg'),(27,2,50000.00,'pending','2025-04-12 07:07:04','jk','dana','0857-1234-5678 (Dana)','photobooth_(2).png'),(28,8,1500000.00,'completed','2025-04-12 13:42:14','iss','dana','0892929982','logo_17.jpeg');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pesan_baru`
--

DROP TABLE IF EXISTS `pesan_baru`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pesan_baru` (
  `id_pesan` int NOT NULL AUTO_INCREMENT,
  `id_user` int DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subjek` varchar(150) NOT NULL,
  `isi_pesan` text NOT NULL,
  `tanggal_kirim` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_pesan`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `pesan_baru_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pesan_baru`
--

LOCK TABLES `pesan_baru` WRITE;
/*!40000 ALTER TABLE `pesan_baru` DISABLE KEYS */;
INSERT INTO `pesan_baru` VALUES (1,4,'keyla','keyno596@gmail.com','MASALAH PENGRIMAN','saya sudah menunggu lama sekali untuk pengiriman tolongdipercepat','2025-04-09 01:26:24'),(3,2,'keyla azahra','ngasal123@gmail.com','WOIII GANTENGG','apa ayang','2025-04-10 18:08:30'),(4,2,'keyla','keynes@gmail.com','apaja','Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur rem, quaerat fugit nemo, distinctio repellat aliquid assumenda provident delectus perferendis, natus eos similique dignissimos quia. Maxime deleniti, eligendi fuga natus pariatur quia perferendis omnis. Quis placeat enim sapiente suscipit beatae. Eveniet sint nulla provident. Impedit soluta aut, est mollitia molestias delectus, sit facilis quod, alias in velit fuga? Animi aliquid, sit fuga rem inventore adipisci quia illo voluptas provident, incidunt dolores praesentium est autem exercitationem pariatur repellendus libero error ea nesciunt. Doloribus, ipsam perferendis dolor rerum assumenda dolore optio quam animi corrupti corporis amet quaerat a eveniet itaque nostrum non voluptates ad excepturi aspernatur ullam fugiat, sapiente perspiciatis eligendi? Eaque a animi delectus ipsa dolore tempore deleniti laborum nisi, ab, repellendus distinctio, fugiat illum totam eum earum incidunt? Minus, veniam omnis. Error fugiat nulla ad cumque maxime officiis iste. Facilis, quibusdam, amet perspiciatis inventore velit esse odit ipsum dolor numquam vitae, optio blanditiis vero error dolores unde mollitia ut excepturi adipisci rem! Inventore perspiciatis, perferendis nesciunt veniam iure, hic quis libero repudiandae eius dolore maiores sapiente quos! Minus enim modi velit fugiat corporis dolor voluptatibus obcaecati aliquam, sit facilis id, ipsa voluptate ducimus nam perspiciatis nulla unde minima officia dolore.','2025-04-12 03:43:24'),(5,2,'adad','kalea@gmail.com','ada','<h1 class=\"text-align p-5 bg-danger\">KEYLA AZAHRA</h1>\r\n','2025-04-12 03:45:29'),(6,2,'aad','kalea@gmail.com','sad','? Punya pertanyaan? Kirim pesan ke kami dan tim BukuMart akan segera membalas!','2025-04-12 03:46:53'),(7,2,'asd','seliaaaputriii@gmail.com','asd','\r\n                                    ? Nama\r\n                                    \r\n                                ','2025-04-12 03:47:48'),(8,8,'Dwi Ayu Hartantri','kalea@gmail.com','PENGIRIMAN LAMBAT','saya udah kasdkasjd','2025-04-12 13:38:30');
/*!40000 ALTER TABLE `pesan_baru` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kota` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kode_pos` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin','admin@tokobuku.com','Perum Pesona Curug Blok F6 no 5 RT.006 RW.003','Jakarta Pusat','1586','admin123','admin','2025-03-15 09:02:28'),(2,'sadas','user1@tokobuku.com','ask','ask','ask','user123','user','2025-03-15 09:02:28'),(4,'keynes','keynes@gmail.com','w','w','16627','123456y','user','2025-04-07 16:33:31'),(5,'keylaazhr','keylaanes@gmail.com','Pengarangan bunga santai jln perak','Medan','18290','S098765l','admin','2025-04-10 16:05:19'),(6,'key','admin2@tokobuku.com','palasari','Tangerang','15267','key123','user','2025-04-12 13:27:17'),(7,'hahah','admin1@tokobuku.com','palasari','Tangerang','23411','Key123','user','2025-04-12 13:29:57'),(8,'','user2@tokobuku.com','palasari','Tangerang','1234','key123','user','2025-04-12 13:32:35'),(9,'lidia','lidia@gmail.com','legok','Tangerang','1234','123456','user','2025-04-12 13:46:05');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-12 21:44:23
