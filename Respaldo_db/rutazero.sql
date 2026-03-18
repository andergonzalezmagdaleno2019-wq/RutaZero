-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-03-2026 a las 23:38:40
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `rutazero`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-boost.roster.scan', 'a:2:{s:6:\"roster\";O:21:\"Laravel\\Roster\\Roster\":3:{s:13:\"\0*\0approaches\";O:29:\"Illuminate\\Support\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}s:11:\"\0*\0packages\";O:32:\"Laravel\\Roster\\PackageCollection\":2:{s:8:\"\0*\0items\";a:8:{i:0;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:5:\"^12.0\";s:10:\"\0*\0package\";E:37:\"Laravel\\Roster\\Enums\\Packages:LARAVEL\";s:14:\"\0*\0packageName\";s:17:\"laravel/framework\";s:10:\"\0*\0version\";s:7:\"12.46.0\";s:6:\"\0*\0dev\";b:0;}i:1;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:6:\"v0.3.8\";s:10:\"\0*\0package\";E:37:\"Laravel\\Roster\\Enums\\Packages:PROMPTS\";s:14:\"\0*\0packageName\";s:15:\"laravel/prompts\";s:10:\"\0*\0version\";s:5:\"0.3.8\";s:6:\"\0*\0dev\";b:0;}i:2;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:4:\"^4.0\";s:10:\"\0*\0package\";E:37:\"Laravel\\Roster\\Enums\\Packages:SANCTUM\";s:14:\"\0*\0packageName\";s:15:\"laravel/sanctum\";s:10:\"\0*\0version\";s:5:\"4.3.0\";s:6:\"\0*\0dev\";b:0;}i:3;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:6:\"v0.5.2\";s:10:\"\0*\0package\";E:33:\"Laravel\\Roster\\Enums\\Packages:MCP\";s:14:\"\0*\0packageName\";s:11:\"laravel/mcp\";s:10:\"\0*\0version\";s:5:\"0.5.2\";s:6:\"\0*\0dev\";b:1;}i:4;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:5:\"^1.24\";s:10:\"\0*\0package\";E:34:\"Laravel\\Roster\\Enums\\Packages:PINT\";s:14:\"\0*\0packageName\";s:12:\"laravel/pint\";s:10:\"\0*\0version\";s:6:\"1.27.0\";s:6:\"\0*\0dev\";b:1;}i:5;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:5:\"^1.41\";s:10:\"\0*\0package\";E:34:\"Laravel\\Roster\\Enums\\Packages:SAIL\";s:14:\"\0*\0packageName\";s:12:\"laravel/sail\";s:10:\"\0*\0version\";s:6:\"1.52.0\";s:6:\"\0*\0dev\";b:1;}i:6;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:4:\"^3.8\";s:10:\"\0*\0package\";E:34:\"Laravel\\Roster\\Enums\\Packages:PEST\";s:14:\"\0*\0packageName\";s:12:\"pestphp/pest\";s:10:\"\0*\0version\";s:5:\"3.8.4\";s:6:\"\0*\0dev\";b:1;}i:7;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:7:\"11.5.33\";s:10:\"\0*\0package\";E:37:\"Laravel\\Roster\\Enums\\Packages:PHPUNIT\";s:14:\"\0*\0packageName\";s:15:\"phpunit/phpunit\";s:10:\"\0*\0version\";s:7:\"11.5.33\";s:6:\"\0*\0dev\";b:1;}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}s:21:\"\0*\0nodePackageManager\";E:43:\"Laravel\\Roster\\Enums\\NodePackageManager:NPM\";}s:9:\"timestamp\";i:1771545653;}', 1771632053);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos`
--

CREATE TABLE `contactos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre_completo` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `asunto` varchar(255) DEFAULT NULL,
  `mensaje` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `imagen_url` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`id`, `nombre`, `descripcion`, `imagen_url`, `created_at`, `updated_at`) VALUES
(16, 'Honda', 'Potencia y fiabilidad japonesa.', 'assets/img/equipos/1771695990_honda.jpeg', '2026-01-13 00:59:19', '2026-02-21 21:46:30'),
(17, 'Kawasaki', 'Domina el asfalto con adrenalina.', 'assets/img/equipos/1771696008_kawasaki.jpeg', '2026-01-13 00:59:19', '2026-02-21 21:46:48'),
(18, 'Suzuki', 'Innovación en cada detalle.', 'assets/img/equipos/1771696020_suzuki.jpeg', '2026-01-13 00:59:19', '2026-02-21 21:47:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especificaciones`
--

CREATE TABLE `especificaciones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `moto_id` bigint(20) UNSIGNED NOT NULL,
  `motor` varchar(255) NOT NULL,
  `cilindrada` varchar(255) NOT NULL,
  `transmision` varchar(255) NOT NULL,
  `frenos` varchar(255) NOT NULL,
  `potencia` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `especificaciones`
--

INSERT INTO `especificaciones` (`id`, `moto_id`, `motor`, `cilindrada`, `transmision`, `frenos`, `potencia`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 6, '4 cilindros en línea, DOHC', '599 cc', '6 velocidades', 'Doble disco radial, ABS', '121 HP @ 14,250 rpm', 'La reina de las supersport. Con un motor que aúlla hasta las 14,000 RPM, esta máquina hereda la aerodinámica de la RC213V de MotoGP para ofrecer una agilidad quirúrgica en curvas.', '2026-03-19 01:32:47', '2026-03-19 01:32:47'),
(2, 7, 'Bicilíndrico en paralelo', '471cc', '6 velocidades', 'Disco lobulado, ABS', '47 HP @ 8,600 rpm', 'El equilibrio perfecto para el mundo real. Agresiva por fuera pero dócil en el manejo, es la moto ideal para quienes buscan el estilo de una superdeportiva con una entrega de potencia lineal y eficiente.', '2026-03-19 01:36:15', '2026-03-19 01:36:15'),
(3, 8, '4 cilindros en línea', '649cc', '6 v. (E-Clutch)', 'Doble disco Nissin', '94 HP @ 12,000 rpm', 'Sport-turismo en su máxima expresión. Su motor de cuatro cilindros ofrece un sonido adictivo y ahora, con la tecnología E-Clutch, permite cambios de marcha ultra suaves sin necesidad de usar el embrague.', '2026-03-19 01:37:28', '2026-03-19 01:37:28'),
(4, 9, '4 Cilindros. (Tecnología MotoGP)', '1000 cc', '6 v. Quickshifter', 'Brembo Stylema ABS', '215 HP @ 14,500 rpm', 'Nacida para el circuito. Es la Honda más potente jamás fabricada, con alerones aerodinámicos funcionales y una electrónica de vanguardia que permite exprimir sus 215 caballos con seguridad.', '2026-03-19 01:40:42', '2026-03-19 01:40:42'),
(5, 10, 'V4 a 90°, DOHC', '999 cc', '6 v. de carreras', 'Brembo de competición', '159 HP (Calle)', 'Una moto de Gran Premio con matrícula. Es, literalmente, la moto de Marc Márquez adaptada para la calle, construida con materiales exóticos y una precisión de ensamblaje artesanal única en el mundo.', '2026-03-19 01:43:46', '2026-03-19 01:43:46'),
(6, 11, 'Bicilíndrico en paralelo', '399 cc', '6 velocidades', 'Disco semi-flotante', '45 HP @ 10,000 rpm', 'Ligera, rápida y letal. Su chasis tipo multitubular y su motor con gran torque en bajas revoluciones la convierten en la referencia absoluta para dominar tanto el tráfico urbano como los días de pista.', '2026-03-19 01:44:53', '2026-03-19 01:44:53'),
(7, 12, '4 cil. en línea, High-Rev', '399 cc', '6 v. Quickshifter', 'Doble disco radial', '77 HP @ 14,500 rpm', 'Un grito de 400cc. Es la única en su clase con un motor de cuatro cilindros capaz de girar a 15,000 RPM, ofreciendo sensaciones de superbike en un paquete compacto y extremadamente divertido.', '2026-03-19 01:46:44', '2026-03-19 01:46:44'),
(8, 13, '4 cilindros en línea', '636 cc', '6 velocidades', 'Brembo Monobloc', '122 HP @ 13,000 rpm', 'La ventaja de los 636cc. Ese extra de cilindrada le otorga un empuje en medios que sus rivales no tienen, complementado con frenos Brembo y una suspensión Showa de alto rendimiento.', '2026-03-19 01:49:31', '2026-03-19 01:49:31'),
(9, 14, '4 cilindros con Ram-Air', '998 cc', '6 v. KQS', 'Brembo M50, KIBS', '203 HP @ 13,200 rpm', 'Siete veces campeona del mundo. Desarrollada junto al equipo de WorldSBK, cuenta con una refrigeración por aire forzado (Ram-Air) y una estabilidad en frenada que redefine los límites de lo posible.', '2026-03-19 01:50:32', '2026-03-19 01:50:32'),
(10, 15, '4 cil. Sobrealimentado', '998 cc', '6 v. Dog-ring', 'Brembo Stylema', '310 HP @ 14,000 rpm', 'La cúspide de la ingeniería. Gracias a su supercargador diseñado por la división aeroespacial de Kawasaki, esta moto no acelera, despega. Es una obra maestra de fibra de carbono y potencia bruta.', '2026-03-19 01:51:42', '2026-03-19 01:51:42'),
(11, 16, 'Bicilíndrico, SOHC', '248 cc', '6 velocidades', 'Disco simple Nissin', '25 HP @ 8,000 rpm', 'Estilo deportivo para el día a día. Diseñada para ofrecer una postura cómoda sin sacrificar el look agresivo de la familia GSX, es una moto confiable, económica y con un acabado premium.', '2026-03-19 01:57:38', '2026-03-19 01:57:38'),
(12, 17, 'Bicilíndrico en paralelo', '776 cc', '6 v. Quickshifter', 'Radiales 4 pistones', '82 HP @ 8,500 rpm', 'La nueva era del bicilíndrico. Su motor con calado a 270 grados ofrece un carácter único y un empuje contundente desde abajo, envuelta en un carenado moderno y aerodinámico.', '2026-03-19 01:58:21', '2026-03-19 01:58:21'),
(13, 18, '4 cilindros en línea', '750 cc', '6 velocidades', 'Brembo Monobloc', '150 HP @ 13,200 rpm', 'La medida perfecta. Ofrece la ligereza de una 600 con la potencia cercana a una 1000. Es una leyenda viva que sigue siendo la favorita de los puristas por su equilibrio mecánico.', '2026-03-19 01:59:24', '2026-03-19 01:59:24'),
(14, 19, '4 cil. con VVT (MotoGP)', '999 cc', '6 v. Bi-Quickshift', 'Motion Track Brake', '199 HP @ 13,200 rpm', 'La joya de Hamamatsu. Utiliza el sistema de distribución variable de válvulas (VVT) de MotoGP para entregar una potencia explosiva en todo el rango de revoluciones sin perder suavidad.', '2026-03-19 02:00:29', '2026-03-19 02:00:29'),
(15, 20, '4 cilindros, 16 válvulas', '1340 cc', '6 velocidades', 'Brembo Stylema, ABS', '190 HP @ 9,700 rpm', 'El halcón peregrino. La tercera generación de este ícono mantiene su estatus como la reina de la velocidad y el confort en carretera abierta, con una presencia imponente que detiene el tráfico.', '2026-03-19 02:01:31', '2026-03-19 02:01:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

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
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(6, '0001_01_01_000000_create_users_table', 1),
(7, '0001_01_01_000001_create_cache_table', 1),
(8, '0001_01_01_000002_create_jobs_table', 1),
(9, '2026_01_10_174224_add_is_admin_to_users_table', 1),
(10, '2026_01_10_205826_proyectos', 1),
(11, '2026_01_11_033724_create_motos_table', 2),
(12, '2026_01_13_002916_create_equipos_table', 3),
(13, '2026_01_13_030634_create_contactos_table', 4),
(14, '2026_01_31_003240_create_personal_access_tokens_table', 5),
(15, '2026_03_18_204056_create_especificaciones_table', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `motos`
--

CREATE TABLE `motos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `marca` varchar(255) NOT NULL,
  `modelo` varchar(255) NOT NULL,
  `cilindrada` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `motos`
--

INSERT INTO `motos` (`id`, `marca`, `modelo`, `cilindrada`, `precio`, `imagen`, `created_at`, `updated_at`) VALUES
(6, 'Honda', 'CBR600RR', 600, 13075.00, 'assets/img/modelos/1769912291_CBR600RR.webp', '2026-01-12 02:11:17', '2026-02-21 21:50:07'),
(7, 'Honda', 'CBR500R', 500, 7399.00, 'assets/img/modelos/1769910244_Honda-CBR500R.jpg', '2026-02-01 05:10:42', '2026-02-01 05:44:04'),
(8, 'Honda', 'CBR650R', 650, 9899.00, 'assets/img/modelos/1769912304_Honda CBR 650 R.jpg', '2026-02-01 05:11:24', '2026-02-01 06:18:24'),
(9, 'Honda', 'CBR1000RR-R Fireblade SP', 1000, 28900.00, 'assets/img/modelos/1769912316_honda_fireblade_01.webp', '2026-02-01 05:12:25', '2026-02-01 06:18:36'),
(10, 'Honda', 'RC213V-S', 1000, 184000.00, 'assets/img/modelos/1769912329_RC213V-S.jpg', '2026-02-01 05:15:49', '2026-02-01 06:18:49'),
(11, 'Kawasaki', 'NINJA 400', 400, 5299.00, 'assets/img/modelos/1769913999_Kawasaki-Ninja-400.jpg', '2026-02-01 05:16:49', '2026-02-01 06:46:39'),
(12, 'Kawasaki', 'Ninja ZX-4RR', 400, 9899.00, 'assets/img/modelos/1769914014_Kawasaki-Ninja-ZX-4RR.jpg', '2026-02-01 05:17:25', '2026-02-01 06:46:54'),
(13, 'Kawasaki', 'Ninja ZX-6R', 650, 11399.00, 'assets/img/modelos/1769914032_Kawasaki-zx-6r.webp', '2026-02-01 05:18:05', '2026-02-01 06:47:12'),
(14, 'Kawasaki', 'Ninja ZX-10R', 1000, 17799.00, 'assets/img/modelos/1769914046_NINJA ZX10R.jpg', '2026-02-01 05:18:38', '2026-02-01 06:47:26'),
(15, 'Kawasaki', 'Ninja H2R', 1000, 58100.00, 'assets/img/modelos/1769914060_kawasaki_h2r_1296x.webp', '2026-02-01 05:19:08', '2026-02-01 06:47:40'),
(16, 'Suzuki', 'GSX250R', 250, 5099.00, 'assets/img/modelos/1769914177_suzuki_gsx250r.webp', '2026-02-01 05:19:40', '2026-02-01 06:49:37'),
(17, 'Suzuki', 'GSX-8R', 780, 9439.00, 'assets/img/modelos/1769914196_2024-suzuki-gsx-8r.webp', '2026-02-01 05:20:59', '2026-02-01 06:49:56'),
(18, 'Suzuki', 'GSX-R750', 750, 12999.00, 'assets/img/modelos/1769914213_2011_Suzuki_GSX-R750.jpg', '2026-02-01 05:21:30', '2026-02-01 06:50:13'),
(19, 'Suzuki', 'GSX-R1000R', 1000, 18499.00, 'assets/img/modelos/1769914223_GSX R1000R.jpg', '2026-02-01 05:22:00', '2026-02-01 06:50:23'),
(20, 'Suzuki', 'Hayabusa 1300', 1300, 19099.00, 'assets/img/modelos/1769914468_hayabusa.jpeg', '2026-02-01 05:23:02', '2026-02-01 06:54:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('Ovh3G4xrnR6eggwCdkZxknInswAgy38fYvKl7amk', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36 OPR/128.0.0.0 (Edition std-2)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSFZYOWE0OUtnVkFBZWhlcnk3amlHU2FieHNLUVZVOWZCSFhiWUdTdiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo3OiJ3ZWxjb21lIjt9fQ==', 1773873409);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `is_admin`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@ejemplo.com', NULL, '$2y$12$IVicwJ7FDGsUFTGMmKRMQOoE./NOriZaPl3OvGsIEdjxAwse/h26O', 1, NULL, '2026-01-10 20:06:34', '2026-01-13 01:29:32'),
(4, 'ander alexander peña', 'ander@gmail.com', NULL, '$2y$12$T/hUaKUwzx.bzgX7xV9TIOu.zuiy1C9g8NN/Wb/tfzTbgwViPhlVG', 0, NULL, '2026-01-31 19:42:45', '2026-03-02 06:21:29');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `especificaciones`
--
ALTER TABLE `especificaciones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `especificaciones_moto_id_unique` (`moto_id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `motos`
--
ALTER TABLE `motos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `contactos`
--
ALTER TABLE `contactos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `especificaciones`
--
ALTER TABLE `especificaciones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `motos`
--
ALTER TABLE `motos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `especificaciones`
--
ALTER TABLE `especificaciones`
  ADD CONSTRAINT `especificaciones_moto_id_foreign` FOREIGN KEY (`moto_id`) REFERENCES `motos` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
