-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: nyg_transporte
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `logo_path` varchar(255) NOT NULL,
  `website_url` varchar(255) DEFAULT NULL,
  `order` int(10) unsigned NOT NULL DEFAULT 0,
  `is_published` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (1,'Mercado Libre','images/clients/mercadolibre.png',NULL,0,1,'2026-08-02 21:19:01','2026-08-02 21:19:01'),(2,'Ocasa','images/clients/ocasa.png',NULL,1,1,'2026-08-02 21:19:01','2026-08-02 21:19:01'),(3,'Webpack','images/clients/webpack.png',NULL,2,1,'2026-08-02 21:19:01','2026-08-02 21:19:01'),(4,'Welivery','images/clients/welivery.png',NULL,3,1,'2026-08-02 21:19:01','2026-08-02 21:19:01');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_requests`
--

DROP TABLE IF EXISTS `contact_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact_requests` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(60) DEFAULT NULL,
  `message` text NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'nuevo',
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_requests`
--

LOCK TABLES `contact_requests` WRITE;
/*!40000 ALTER TABLE `contact_requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faqs`
--

DROP TABLE IF EXISTS `faqs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `faqs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `order` int(10) unsigned NOT NULL DEFAULT 0,
  `is_published` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faqs`
--

LOCK TABLES `faqs` WRITE;
/*!40000 ALTER TABLE `faqs` DISABLE KEYS */;
INSERT INTO `faqs` VALUES (1,'¿Qué zonas cubre NYG Transporte?','Coordinamos operaciones de transporte y distribución según cada solicitud. Contanos tu origen y destino desde el formulario de cotización y te confirmamos la cobertura para tu operación puntual.','Cobertura',0,1,'2026-08-01 22:52:07','2026-08-01 22:52:07'),(2,'¿Qué tipos de mercadería pueden transportar?','Trabajamos con distintos tipos de carga, incluyendo mercadería que requiere temperatura controlada (congelada y supercongelada). Indicá el tipo de producto en el formulario para que evaluemos la unidad adecuada.','Mercadería',1,1,'2026-08-01 22:52:07','2026-08-01 22:52:07'),(3,'¿Tienen transporte con temperatura controlada?','Sí, disponemos de unidades equipadas para carga congelada y supercongelada, que cumplen con los requerimientos de frío según el tipo de producto.','Temperatura controlada',2,1,'2026-08-01 22:52:07','2026-08-01 22:52:07'),(4,'¿Cómo puedo hacer seguimiento de mi envío?','Nuestras unidades cuentan con sistemas de seguimiento satelital con recupero. Durante la operación mantenemos informado al cliente sobre el estado de su envío.','Seguimiento',3,1,'2026-08-01 22:52:07','2026-08-01 22:52:07'),(5,'¿Ofrecen servicio de almacenamiento?','Sí. Recepcionamos, clasificamos y almacenamos la mercadería en nuestros depósitos, y luego realizamos la preparación y el despacho de los envíos.','Almacenamiento',4,1,'2026-08-01 22:52:07','2026-08-01 22:52:07'),(6,'¿Cómo solicito una cotización?','Completá el formulario de cotización con los datos de tu operación (origen, destino, tipo de mercadería, volumen aproximado) o escribinos directamente por WhatsApp. Te respondemos a la brevedad.','Cotizaciones',5,1,'2026-08-01 22:52:07','2026-08-01 22:52:07'),(7,'¿Cuál es el tiempo de respuesta a una consulta?','Respondemos las consultas a la brevedad. El tiempo exacto puede variar según la complejidad de la operación consultada.','Tiempos de respuesta',6,1,'2026-08-01 22:52:07','2026-08-01 22:52:07'),(8,'¿Qué documentación necesito para una operación de comercio exterior?','La documentación varía según el tipo de operación de importación o exportación. Consultanos los detalles de tu caso puntual para indicarte qué necesitás.','Documentación',7,1,'2026-08-01 22:52:07','2026-08-01 22:52:07'),(9,'¿Realizan transporte de cargas completas?','Sí, coordinamos el traslado de cargas completas evaluando el volumen, el tipo de mercadería y el destino de cada operación.','Cargas completas',8,1,'2026-08-01 22:52:07','2026-08-01 22:52:07'),(10,'¿Pueden coordinar operaciones programadas o recurrentes?','Sí. Indicá la frecuencia estimada en el formulario de cotización (única vez, semanal, mensual, etc.) para que podamos coordinar una operación programada.','Operaciones programadas',9,1,'2026-08-01 22:52:07','2026-08-01 22:52:07');
/*!40000 ALTER TABLE `faqs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `industries`
--

DROP TABLE IF EXISTS `industries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `industries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `icon` varchar(100) NOT NULL DEFAULT 'building',
  `order` int(10) unsigned NOT NULL DEFAULT 0,
  `is_published` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `industries_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `industries`
--

LOCK TABLES `industries` WRITE;
/*!40000 ALTER TABLE `industries` DISABLE KEYS */;
/*!40000 ALTER TABLE `industries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `legal_pages`
--

DROP TABLE IF EXISTS `legal_pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `legal_pages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `last_reviewed_at` timestamp NULL DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `legal_pages_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `legal_pages`
--

LOCK TABLES `legal_pages` WRITE;
/*!40000 ALTER TABLE `legal_pages` DISABLE KEYS */;
INSERT INTO `legal_pages` VALUES (1,'Política de privacidad','politica-de-privacidad','<p>Esta política describe cómo NYG Transporte recolecta, utiliza y protege los datos personales enviados a través de este sitio web (formularios de contacto y de cotización).</p><h2>Datos que recolectamos</h2><p>Nombre, empresa, correo electrónico, teléfono y demás datos que el usuario decida incluir en los formularios, incluyendo archivos adjuntos opcionales.</p><h2>Uso de los datos</h2><p>Los datos se utilizan exclusivamente para responder consultas comerciales y elaborar propuestas de servicio. No se comparten con terceros salvo obligación legal.</p><h2>Conservación</h2><p>Los datos se conservan mientras exista una relación comercial vigente o potencial, y pueden eliminarse a pedido del titular.</p><p><em>Este texto es una base editable y debe ser revisado por un profesional legal antes de su publicación definitiva.</em></p>',NULL,1,'2026-08-01 22:52:08','2026-08-01 22:52:08'),(2,'Política de cookies','politica-de-cookies','<p>Este sitio utiliza cookies técnicas necesarias para su funcionamiento (por ejemplo, mantener la sesión del panel administrativo) y, opcionalmente, cookies de análisis.</p><p>Podés gestionar o deshabilitar las cookies desde la configuración de tu navegador.</p><p><em>Este texto es una base editable y debe ser revisado por un profesional legal antes de su publicación definitiva.</em></p>',NULL,1,'2026-08-01 22:52:08','2026-08-01 22:52:08'),(3,'Términos y condiciones','terminos-y-condiciones','<p>El uso de este sitio web implica la aceptación de los presentes términos. La información publicada tiene fines informativos y comerciales; las condiciones definitivas de cada servicio se establecen en la cotización y/o contrato correspondiente.</p><p><em>Este texto es una base editable y debe ser revisado por un profesional legal antes de su publicación definitiva.</em></p>',NULL,1,'2026-08-01 22:52:08','2026-08-01 22:52:08');
/*!40000 ALTER TABLE `legal_pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `media` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `disk` varchar(30) NOT NULL DEFAULT 'public',
  `path` varchar(255) NOT NULL,
  `original_name` varchar(255) NOT NULL,
  `alt_text` varchar(255) DEFAULT NULL,
  `collection` varchar(60) NOT NULL DEFAULT 'general',
  `size_bytes` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
/*!40000 ALTER TABLE `media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2024_01_01_000001_create_service_categories_table',1),(5,'2024_01_01_000002_create_services_table',1),(6,'2024_01_01_000003_create_industries_table',1),(7,'2024_01_01_000004_create_clients_table',1),(8,'2024_01_01_000005_create_faqs_table',1),(9,'2024_01_01_000006_create_contact_requests_table',1),(10,'2024_01_01_000007_create_quote_requests_table',1),(11,'2024_01_01_000008_create_quote_request_attachments_table',1),(12,'2024_01_01_000009_create_settings_table',1),(13,'2024_01_01_000010_create_pages_table',1),(14,'2024_01_01_000011_create_page_sections_table',1),(15,'2024_01_01_000012_create_media_table',1),(16,'2024_01_01_000013_create_seo_metadata_table',1),(17,'2024_01_01_000014_create_legal_pages_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `page_sections`
--

DROP TABLE IF EXISTS `page_sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `page_sections` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `page_id` bigint(20) unsigned NOT NULL,
  `key` varchar(100) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` text DEFAULT NULL,
  `body` longtext DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `order` int(10) unsigned NOT NULL DEFAULT 0,
  `is_published` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `page_sections_page_id_key_unique` (`page_id`,`key`),
  CONSTRAINT `page_sections_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page_sections`
--

LOCK TABLES `page_sections` WRITE;
/*!40000 ALTER TABLE `page_sections` DISABLE KEYS */;
INSERT INTO `page_sections` VALUES (1,1,'historia','Trayectoria y Compromiso',NULL,'NYG Transporte nació en 2018 con la convicción de ir más allá del traslado convencional de mercaderías. Nos propusimos redefinir la logística integral a través de un servicio que combina rigurosidad operativa, tecnología aplicada y una profunda vocación humana. Crecimos entendiendo que cada carga representa la confianza de un cliente, y respondemos a ella con dedicación absoluta.',NULL,0,1,'2026-08-01 22:52:08','2026-08-02 21:00:38'),(2,1,'como-trabajamos','Cuidado Absoluto en Cada Kilómetro',NULL,'En NYG, entendemos la logística como una cadena de valor donde las personas son lo primero. Cuidamos a nuestros choferes, colaboradores y comunidades en la ruta con la misma exigencia y esmero con los que custodiamos su producto. La seguridad, el respeto y la puntualidad no son variables negociables; son la base de cada viaje que emprendemos.',NULL,0,1,'2026-08-01 22:52:08','2026-08-02 21:00:38'),(3,1,'mision','Misión',NULL,'Brindar soluciones logísticas integrales y de alta eficiencia mediante una flota moderna y un monitoreo en tiempo real constante. Nos esforzamos por facilitar el crecimiento de nuestros clientes, garantizando tranquilidad, profesionalismo y trazabilidad total en cada etapa del camino.',NULL,0,1,'2026-08-01 22:52:08','2026-08-02 21:00:38'),(4,1,'vision','Visión',NULL,'Consolidarnos como el socio estratégico de logística integral de referencia en la región, reconocidos por nuestra integridad ética, la excelencia en la ejecución y nuestra capacidad de adaptarnos a los desafíos más complejos del mercado logístico nacional.',NULL,0,1,'2026-08-01 22:52:08','2026-08-02 21:00:38'),(5,1,'valores','Valores Fundamentales',NULL,'La confianza mutua, el comportamiento ético transparente y el compromiso con la sustentabilidad guían nuestras decisiones. Priorizamos la seguridad humana en el transporte terrestre, la flexibilidad ante imprevistos y la eficiencia operativa diaria para honrar la palabra dada a cada uno de nuestros socios comerciales.',NULL,0,1,'2026-08-01 22:52:08','2026-08-02 21:00:38'),(6,1,'accion-social','Compromiso Social',NULL,'Creemos firmemente en generar un impacto positivo en nuestro entorno. Por ello, colaboramos activamente facilitando fletes solidarios sin costo para entidades de bien público y organizaciones comunitarias acreditadas, aportando nuestra estructura logística al desarrollo social del país.',NULL,0,1,'2026-08-01 22:52:08','2026-08-02 21:00:38'),(7,2,'intro','Cada envío visible. Cada decisión respaldada.',NULL,'Todas las unidades de nuestra flota cuentan con sistemas de seguimiento satelital con recupero, que el cliente puede visualizar en tiempo real. Esto permite mantener informado al cliente sobre el estado de su envío durante toda la operación y reaccionar rápido ante cualquier imprevisto.',NULL,0,1,'2026-08-01 22:52:08','2026-08-01 22:52:08');
/*!40000 ALTER TABLE `page_sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `template` varchar(60) NOT NULL DEFAULT 'generic',
  `is_published` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pages_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,'Empresa','empresa','empresa',1,'2026-08-01 22:52:08','2026-08-01 22:52:08'),(2,'Tecnología y seguimiento','tecnologia-y-seguimiento','tecnologia',1,'2026-08-01 22:52:08','2026-08-01 22:52:08');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quote_request_attachments`
--

DROP TABLE IF EXISTS `quote_request_attachments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quote_request_attachments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `quote_request_id` bigint(20) unsigned NOT NULL,
  `original_name` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `mime_type` varchar(150) NOT NULL,
  `size_bytes` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quote_request_attachments_quote_request_id_foreign` (`quote_request_id`),
  CONSTRAINT `quote_request_attachments_quote_request_id_foreign` FOREIGN KEY (`quote_request_id`) REFERENCES `quote_requests` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quote_request_attachments`
--

LOCK TABLES `quote_request_attachments` WRITE;
/*!40000 ALTER TABLE `quote_request_attachments` DISABLE KEYS */;
/*!40000 ALTER TABLE `quote_request_attachments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quote_requests`
--

DROP TABLE IF EXISTS `quote_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quote_requests` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) NOT NULL,
  `company` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(60) NOT NULL,
  `service_id` bigint(20) unsigned DEFAULT NULL,
  `service_type_other` varchar(150) DEFAULT NULL,
  `origin` varchar(150) DEFAULT NULL,
  `destination` varchar(150) DEFAULT NULL,
  `cargo_type` varchar(150) DEFAULT NULL,
  `requires_temperature_control` tinyint(1) NOT NULL DEFAULT 0,
  `temperature_requirement` varchar(100) DEFAULT NULL,
  `approx_weight_kg` decimal(10,2) DEFAULT NULL,
  `approx_volume_m3` decimal(10,2) DEFAULT NULL,
  `pallets_or_packages` int(10) unsigned DEFAULT NULL,
  `frequency` varchar(100) DEFAULT NULL,
  `estimated_date` date DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'nueva',
  `internal_notes` text DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quote_requests_service_id_foreign` (`service_id`),
  KEY `quote_requests_status_index` (`status`),
  CONSTRAINT `quote_requests_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quote_requests`
--

LOCK TABLES `quote_requests` WRITE;
/*!40000 ALTER TABLE `quote_requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `quote_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seo_metadata`
--

DROP TABLE IF EXISTS `seo_metadata`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seo_metadata` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `seo_metadatable_type` varchar(255) NOT NULL,
  `seo_metadatable_id` bigint(20) unsigned NOT NULL,
  `meta_title` varchar(70) DEFAULT NULL,
  `meta_description` varchar(160) DEFAULT NULL,
  `og_image` varchar(255) DEFAULT NULL,
  `canonical_url` varchar(255) DEFAULT NULL,
  `no_index` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `seo_metadata_seo_metadatable_type_seo_metadatable_id_index` (`seo_metadatable_type`,`seo_metadatable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seo_metadata`
--

LOCK TABLES `seo_metadata` WRITE;
/*!40000 ALTER TABLE `seo_metadata` DISABLE KEYS */;
/*!40000 ALTER TABLE `seo_metadata` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_categories`
--

DROP TABLE IF EXISTS `service_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `order` int(10) unsigned NOT NULL DEFAULT 0,
  `is_published` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `service_categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_categories`
--

LOCK TABLES `service_categories` WRITE;
/*!40000 ALTER TABLE `service_categories` DISABLE KEYS */;
INSERT INTO `service_categories` VALUES (1,'Transporte','transporte',NULL,0,1,'2026-08-01 22:52:07','2026-08-01 22:52:07'),(2,'Almacenamiento y distribución','almacenamiento-y-distribucion',NULL,1,1,'2026-08-01 22:52:07','2026-08-01 22:52:07'),(3,'Comercio exterior','comercio-exterior',NULL,2,1,'2026-08-01 22:52:07','2026-08-01 22:52:07');
/*!40000 ALTER TABLE `service_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `service_category_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `problem` varchar(300) DEFAULT NULL,
  `short_description` text NOT NULL,
  `description` longtext NOT NULL,
  `benefits` text DEFAULT NULL,
  `icon` varchar(100) NOT NULL DEFAULT 'truck',
  `cover_image` varchar(255) DEFAULT NULL,
  `order` int(10) unsigned NOT NULL DEFAULT 0,
  `is_featured_on_home` tinyint(1) NOT NULL DEFAULT 0,
  `is_published` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `services_slug_unique` (`slug`),
  KEY `services_service_category_id_foreign` (`service_category_id`),
  CONSTRAINT `services_service_category_id_foreign` FOREIGN KEY (`service_category_id`) REFERENCES `service_categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,1,'Transporte terrestre','transporte-terrestre','Necesitás que tus insumos o productos lleguen a planta o al centro de distribución sin demoras ni sorpresas.','Transportamos insumos y productos para el abastecimiento de plantas productivas y centros de distribución.','Coordinamos el transporte terrestre de tu carga con unidades preparadas según el tipo de mercadería y el destino. Cada unidad de la flota cuenta con seguimiento satelital con recupero, visible para el cliente en tiempo real.\n\nTrabajamos la operación de punta a punta: retiro, traslado y confirmación de entrega, manteniendo informado al cliente sobre el estado de su envío.','Seguimiento satelital de la unidad.\nCoordinación de horarios de retiro y entrega.\nInformación del estado del envío durante todo el trayecto.','truck',NULL,0,1,1,'2026-08-01 22:52:07','2026-08-01 22:52:07',NULL),(2,1,'Cross-Docking','cross-docking','Necesitás agilizar la distribución y transferir mercadería con mínimo almacenamiento.','Transferencia directa de mercadería con mínimo almacenamiento para acelerar los tiempos de tránsito.','Consolidamos y desconsolidamos cargas directamente en nuestras plataformas de transferencia. Los productos entrantes se despachan de forma inmediata hacia sus destinos finales, reduciendo costos de almacenamiento y optimizando los tiempos de tránsito.','Reducción en los costos de almacenamiento y manipulación.\nDisminución del tiempo total del ciclo de entrega.\nOptimización del flujo de stock en centros urbanos.','refresh-cw',NULL,1,1,1,'2026-08-01 22:52:07','2026-08-01 22:52:07',NULL),(3,2,'Almacenamiento','almacenamiento','Necesitás un lugar confiable para recibir, clasificar y preparar tu mercadería antes del despacho.','Recepción, clasificación y almacenamiento de productos, con preparación y despacho de envíos.','Recepcionamos, clasificamos y almacenamos los productos de cada cliente en nuestros depósitos, para luego realizar la preparación y el despacho de los envíos según la demanda.','Recepción y clasificación ordenada de mercadería.\nPreparación de pedidos antes del despacho.\nCoordinación directa con el área de distribución.','warehouse',NULL,2,1,1,'2026-08-01 22:52:07','2026-08-01 22:52:07',NULL),(4,2,'Distribución','distribucion','Tenés que llegar a muchos puntos de entrega distintos, con tiempos y costos que tengan sentido.','Red de distribución versátil y flexible, con servicios de calidad a precios competitivos.','Contamos con una red de distribución versátil y flexible que permite brindar un servicio de calidad a precios competitivos, adaptándonos a los puntos de entrega y tiempos que necesita cada operación.','Red de distribución flexible.\nAdaptación a múltiples puntos de entrega.\nCoordinación con almacenamiento y transporte.','route',NULL,3,1,1,'2026-08-01 22:52:07','2026-08-01 22:52:07',NULL),(5,1,'Cargas completas','cargas-completas','Necesitás mover un volumen grande de mercadería en un solo viaje, sin compartir unidad con otra carga.','Transporte de cargas completas, coordinado según el volumen y el tipo de mercadería.','Coordinamos el traslado de cargas completas de una forma personalizada, evaluando el tipo de mercadería, el destino y los tiempos requeridos para cada operación.','Traslado dedicado por operación.\nCoordinación personalizada de horarios.\nSeguimiento satelital de la unidad.','container',NULL,4,0,1,'2026-08-01 22:52:07','2026-08-01 22:52:07',NULL),(6,2,'Servicios puerta a puerta','servicios-puerta-a-puerta','Necesitás que el envío llegue directamente a destino, sin intermediarios ni pasos adicionales.','Servicio integral de envíos puerta a puerta.','Brindamos un servicio de envío puerta a puerta, ocupándonos del traslado completo de la mercadería desde el punto de origen hasta el destino final indicado por el cliente.','Traslado directo a destino.\nMenos pasos y coordinación simplificada.\nInformación del estado del envío.','door-open',NULL,5,0,1,'2026-08-01 22:52:07','2026-08-01 22:52:07',NULL),(7,2,'Gestión de compras y retiros','gestion-de-compras-y-retiros','Necesitás que alguien se encargue de retirar la mercadería comprada y coordinar su traslado.','Gestión de compra y retiro de mercadería para su posterior traslado.','Nos encargamos de la gestión de compra y el retiro de la mercadería en el punto de origen, coordinando el traslado posterior según las necesidades del cliente.','Gestión y retiro coordinado.\nMenos gestiones a cargo del cliente.\nSeguimiento del proceso completo.','clipboard-check',NULL,6,0,1,'2026-08-01 22:52:07','2026-08-01 22:52:07',NULL),(8,3,'Transporte y gestión aduanera','transporte-y-gestion-aduanera','Tu operación de importación o exportación necesita transporte y gestión aduanera coordinados.','Transporte y gestión aduanera para operaciones de importación y exportación.','Ofrecemos servicio de transporte y gestión aduanera, tanto para operaciones de importación como de exportación, dentro del alcance confirmado de nuestra operación actual.','Transporte asociado a operaciones de comercio exterior.\nGestión aduanera de importación y exportación.\nCoordinación con el resto de la cadena logística.','ship',NULL,7,0,1,'2026-08-01 22:52:07','2026-08-01 22:52:07',NULL);
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `type` varchar(30) NOT NULL DEFAULT 'text',
  `group` varchar(60) NOT NULL DEFAULT 'general',
  `label` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'contact_email','info@nygtransporte.com.ar','text','contacto','Correo de contacto','2026-08-01 22:52:07','2026-08-01 22:52:07'),(2,'contact_phone_display','+54 9 11 7063 9810','text','contacto','Teléfono visible (A CONFIRMAR: difiere del número usado en el enlace tel: del sitio actual)','2026-08-01 22:52:07','2026-08-01 22:52:07'),(3,'whatsapp_number','5491178560714','text','contacto','WhatsApp (formato internacional, sin signos)','2026-08-01 22:52:07','2026-08-01 22:52:07'),(4,'address','José Cubas 3999, Devoto, Cap. Fed.','text','contacto','Dirección de oficina','2026-08-01 22:52:07','2026-08-02 22:19:04'),(5,'business_hours','','text','contacto','Horario de atención (pendiente de confirmar, no publicado por NYG)','2026-08-01 22:52:07','2026-08-01 22:52:07'),(6,'facebook_url','https://www.facebook.com/nygtransporteok/','text','redes','Facebook','2026-08-01 22:52:07','2026-08-01 22:52:07'),(7,'instagram_url','https://www.instagram.com/nyg_transporte/','text','redes','Instagram','2026-08-01 22:52:07','2026-08-01 22:52:07'),(8,'rnpsp','1117','text','institucional','N° de registro R.N.P.S.P','2026-08-01 22:52:07','2026-08-01 22:52:07'),(9,'operating_since','2018','text','institucional','Operando desde','2026-08-01 22:52:07','2026-08-01 22:52:07'),(10,'hero_tagline','Soluciones de logística integral','text','home','Etiqueta superior del hero','2026-08-01 22:52:07','2026-08-01 22:52:07'),(11,'hero_title','Logística bajo control. De principio a fin.','text','home','Título del hero','2026-08-01 22:52:07','2026-08-01 22:52:07'),(12,'hero_text','Coordinamos transporte, almacenamiento y distribución con seguimiento, atención personalizada y soluciones adaptadas a cada operación.','textarea','home','Texto del hero','2026-08-01 22:52:07','2026-08-01 22:52:07'),(13,'brand_logo_url','https://d8j0ntlcm91z4.cloudfront.net/user_3Gn0d8P6RXU669yyC14C6pUmlZr/hf_20260801_220647_4a5a91cb-6694-4ae6-958a-31709d360285.svg','text','marca','Isotipo (recreación provisoria del logo — reemplazar por el archivo oficial)','2026-08-01 22:52:07','2026-08-01 22:52:07'),(14,'hero_slide_1_image','https://d8j0ntlcm91z4.cloudfront.net/user_3Gn0d8P6RXU669yyC14C6pUmlZr/hf_20260801_220649_c3789dd6-387b-43ca-8d3d-a71e2798e4fc.png','text','home','Slide 1 — Imagen (flota, ilustrativa)','2026-08-01 22:52:07','2026-08-01 22:52:07'),(15,'hero_slide_1_tagline','Soluciones de logística integral','text','home','Slide 1 — Etiqueta','2026-08-01 22:52:07','2026-08-01 22:52:07'),(16,'hero_slide_1_title','Logística bajo control. De principio a fin.','text','home','Slide 1 — Título','2026-08-01 22:52:07','2026-08-01 22:52:07'),(17,'hero_slide_1_text','Coordinamos transporte, almacenamiento y distribución con seguimiento, atención personalizada y soluciones adaptadas a cada operación.','textarea','home','Slide 1 — Texto','2026-08-01 22:52:07','2026-08-01 22:52:07'),(18,'hero_slide_2_image','https://d8j0ntlcm91z4.cloudfront.net/user_3Gn0d8P6RXU669yyC14C6pUmlZr/hf_20260801_220651_c4d07235-3302-47c2-ae08-446f2c67b66c.png','text','home','Slide 2 — Imagen (unidad, ilustrativa)','2026-08-01 22:52:07','2026-08-01 22:52:07'),(19,'hero_slide_2_tagline','Flota preparada para cada carga','text','home','Slide 2 — Etiqueta','2026-08-01 22:52:07','2026-08-01 22:52:07'),(20,'hero_slide_2_title','La unidad correcta para cada operación.','text','home','Slide 2 — Título','2026-08-01 22:52:07','2026-08-01 22:52:07'),(21,'hero_slide_2_text','Desde cargas completas hasta transporte refrigerado: coordinamos la unidad y el equipo adecuados para cada tipo de mercadería.','textarea','home','Slide 2 — Texto','2026-08-01 22:52:07','2026-08-01 22:52:07'),(22,'hero_slide_3_image','/images/mapa_argentina_red.jpg','text','home','Slide 3 — Imagen (tecnología, ilustrativa)','2026-08-01 22:52:07','2026-08-02 23:16:40'),(23,'hero_slide_3_tagline','Tecnología','text','home','Slide 3 — Etiqueta','2026-08-01 22:52:07','2026-08-01 22:52:07'),(24,'hero_slide_3_title','Cada envío visible. Cada decisión respaldada.','text','home','Slide 3 — Título','2026-08-01 22:52:07','2026-08-01 22:52:07'),(25,'hero_slide_3_text','Seguimiento satelital con recupero, visible en tiempo real, para que sepas siempre en qué etapa está tu operación.','textarea','home','Slide 3 — Texto','2026-08-01 22:52:07','2026-08-01 22:52:07'),(26,'social_action_text','Ofrecemos fletes sin cargo a entidades benéficas, previa confirmación de la operación.','textarea','home','Texto de acción social','2026-08-01 22:52:07','2026-08-01 22:52:07'),(27,'cookie_banner_enabled','1','boolean','legales','Mostrar aviso de cookies','2026-08-01 22:52:07','2026-08-01 22:52:07');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Administrador NYG','admin@nygtransporte.com.ar','2026-08-01 22:52:07','$2y$12$VMMfOe0N3T3c2bz59w4SWenH11CvijR1nuuZFK3sO6olV.mCfR/vm',1,NULL,'2026-08-01 22:52:07','2026-08-01 22:52:07');
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

-- Dump completed on 2026-08-31 17:09:00
