-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 16, 2024 at 12:19 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `RealStateDB`
--

-- --------------------------------------------------------

--
-- Table structure for table `amenities`
--

CREATE TABLE `amenities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amenitis_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `amenities`
--

INSERT INTO `amenities` (`id`, `amenitis_name`, `created_at`, `updated_at`) VALUES
(1, 'Air Conditioning', NULL, NULL),
(2, 'Cleaning Service', NULL, NULL),
(3, 'Dishwasher', NULL, NULL),
(4, 'Hardwood Flows', NULL, NULL),
(5, 'Swimming Pool', NULL, NULL),
(6, 'Outdoor Shower', NULL, NULL),
(7, 'Microwave', NULL, NULL),
(8, 'Pet Friendly', NULL, NULL),
(9, 'Basketball Court', NULL, NULL),
(10, 'Refrigerator', NULL, NULL),
(11, 'Gym', NULL, NULL),
(12, 'Clubhouse', NULL, NULL),
(13, '24/7 Security', NULL, NULL),
(14, 'Power Backup', NULL, NULL),
(15, 'Jogging Track', NULL, NULL),
(16, 'High-speed elevators', NULL, NULL),
(17, 'Conference rooms', NULL, '2024-02-14 07:15:28'),
(18, 'Cafeteria', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `banner` varchar(255) NOT NULL,
  `heading` text NOT NULL,
  `subheading` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `banner`, `heading`, `subheading`, `created_at`, `updated_at`) VALUES
(1, 'frontend/assets/images/1789612012967415.jpg', 'Create Lasting Wealth Through Sprinix', 'Amet consectetur adipisicing elit sed do eiusmod.', '2024-01-31 06:59:26', '2024-01-31 07:46:53');

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `category_name`, `category_slug`, `created_at`, `updated_at`) VALUES
(1, 'Home improvement', 'home-improvement', '2024-01-24 02:28:44', '2024-01-24 02:28:44'),
(2, 'Tips and advice', 'tips-and-advice', '2024-01-24 02:28:47', '2024-01-24 02:28:47'),
(3, 'Architecture', 'architecture', '2024-01-24 02:28:51', '2024-01-24 02:28:51'),
(4, 'Interior', 'interior', '2024-01-24 02:28:58', '2024-01-24 02:28:58'),
(5, 'Real Estate', 'real-estate', '2024-01-24 02:29:03', '2024-01-24 02:31:57');

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blogcat_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `post_title` varchar(255) DEFAULT NULL,
  `post_slug` varchar(255) DEFAULT NULL,
  `post_image` varchar(255) DEFAULT NULL,
  `short_descp` text DEFAULT NULL,
  `long_descp` text DEFAULT NULL,
  `post_tags` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`id`, `blogcat_id`, `user_id`, `post_title`, `post_slug`, `post_image`, `short_descp`, `long_descp`, `post_tags`, `created_at`, `updated_at`) VALUES
(1, 5, 1, '5 Essential Tips for Transforming Your Home into a Stylish Sanctuary', '5-essential-tips-for-transforming-your-home-into-a-stylish-sanctuary', 'upload/post_images/1790952283308948.jpg', 'Discover expert tips for transforming your home into a stylish sanctuary. From timeless architecture to functional interior design, elevate your living spaces with these essential insights.', '<p><strong>Introduction:</strong> In the realm of real estate and home improvement, the aspiration to create a space that reflects your personality and style while also being functional is paramount. From architectural nuances to interior design elements, every detail plays a crucial role in shaping the ambiance of your home. In this blog post, we\'ll delve into five essential tips for transforming your humble abode into a stylish sanctuary.</p>\r\n<p><strong>1. Embrace Timeless Architecture:</strong> Architecture forms the backbone of any home\'s aesthetic appeal. Embracing timeless architectural elements ensures that your home exudes elegance and sophistication for years to come. Consider incorporating features like arched doorways, vaulted ceilings, or exposed beams to add character and charm to your living spaces.</p>\r\n<p><strong>Image Prompt:</strong> <em>An image showcasing a beautifully crafted arched doorway leading into a sunlit room, accentuated by the interplay of light and shadow.</em></p>\r\n<p><strong>2. Curate a Harmonious Color Palette:</strong> Color plays a pivotal role in setting the tone and mood of your home. Opt for a harmonious color palette that reflects your personal taste while creating a sense of cohesion throughout your living spaces. Experiment with complementary hues, muted tones, and pops of color to add visual interest and depth to your interiors.</p>\r\n<p><strong>Image Prompt:</strong> <em>An image depicting a well-curated living room adorned with soft neutral tones, accented by vibrant throw pillows and artwork, creating a welcoming and inviting atmosphere.</em></p>\r\n<p><strong>3. Focus on Functional Interior Design:</strong> Interior design should seamlessly blend form with function to enhance the livability of your home. Prioritize functional layouts and furniture arrangements that optimize space utilization and promote ease of movement. Invest in multifunctional furniture pieces and storage solutions to keep clutter at bay and maintain a sense of organization.</p>\r\n<p><strong>Image Prompt:</strong> <em>An image showcasing a modern kitchen with sleek cabinetry and integrated storage solutions, showcasing the marriage of style and functionality in contemporary interior design.</em></p>\r\n<p><strong>4. Infuse Texture and Contrast:</strong> Texture and contrast add layers of visual interest and tactile appeal to your interiors, elevating the overall design scheme. Incorporate a variety of textures such as plush rugs, tactile fabrics, and natural materials like wood and stone to create depth and dimension. Contrast soft textures with hard surfaces to strike a balance and create dynamic visual impact.</p>\r\n<p><strong>Image Prompt:</strong> <em>An image featuring a cozy reading nook adorned with plush throws, textured pillows, and a rustic wooden accent wall, creating a cozy retreat within the home.</em></p>\r\n<p><strong>5. Personalize with Signature Accents:</strong> Infuse your home with personality and character by incorporating signature accents and personal touches. Display cherished artworks, heirlooms, and mementos that tell your unique story and evoke fond memories. Integrate elements of your hobbies, interests, and travels into the decor to imbue your living spaces with authenticity and charm.</p>\r\n<p><strong>Image Prompt:</strong> <em>An image showcasing a gallery wall adorned with an eclectic mix of framed artworks, photographs, and vintage finds, adding personality and character to a blank wall.</em></p>', 'RealState', '2024-02-15 04:34:28', '2024-02-15 04:34:28'),
(2, 1, 1, 'Transforming Your Home: 5 Home Improvement Ideas to Elevate Your Living Space', 'transforming-your-home:-5-home-improvement-ideas-to-elevate-your-living-space', 'upload/post_images/1790953273987694.jpg', 'Revitalize your home with these 5 home improvement ideas! From fresh paint to outdoor oasis creation, elevate your living space effortl', '<p>Are you looking to breathe new life into your home? Whether you\'re preparing to sell or simply want to enhance your living space, home improvement projects can revitalize your environment and add value to your property. From small updates to full-scale renovations, here are five home improvement ideas to inspire your next project:</p>\r\n<ol>\r\n<li>\r\n<p><strong>Fresh Paint, Fresh Perspective:</strong> A fresh coat of paint can work wonders in transforming the look and feel of your home. Choose neutral tones to create a modern, inviting atmosphere or opt for bold accent colors to make a statement. Don\'t forget to paint both the interior and exterior surfaces to achieve a cohesive and polished appearance.</p>\r\n<p><em>Image Prompt: A painter with a roller brush, applying a vibrant color to a feature wall, adding depth and personality to the room.</em></p>\r\n</li>\r\n<li>\r\n<p><strong>Upgrade Your Kitchen:</strong> The kitchen is the heart of the home, and upgrading it can significantly increase its appeal and functionality. Consider replacing outdated cabinets and countertops with modern, durable materials such as quartz or granite. Install energy-efficient appliances to reduce utility costs and add stylish fixtures to elevate the overall aesthetic.</p>\r\n<p><em>Image Prompt: A sleek, contemporary kitchen with stainless steel appliances, granite countertops, and pendant lighting, exuding elegance and sophistication.</em></p>\r\n</li>\r\n<li>\r\n<p><strong>Create an Outdoor Oasis:</strong> Extend your living space outdoors by creating a functional and inviting outdoor oasis. Install a deck or patio where you can entertain guests or relax with your family. Add landscaping features such as flower beds, shrubs, and trees to enhance curb appeal and create a tranquil atmosphere.</p>\r\n<p><em>Image Prompt: A cozy outdoor seating area with comfortable furniture, surrounded by lush greenery and illuminated by string lights, offering the perfect setting for al fresco dining.</em></p>\r\n</li>\r\n<li>\r\n<p><strong>Enhance Curb Appeal:</strong> First impressions matter, and improving your home\'s curb appeal can make a significant difference in its overall attractiveness. Replace worn-out siding, update the front door with a fresh coat of paint or a stylish new design, and add tasteful landscaping elements such as flower pots or a welcoming pathway.</p>\r\n<p><em>Image Prompt: A beautifully landscaped front yard with manicured lawns, colorful flowers, and a charming pathway leading to the front door, creating an inviting entrance.</em></p>\r\n</li>\r\n<li>\r\n<p><strong>Invest in Energy Efficiency:</strong> Upgrade your home\'s energy efficiency to reduce utility costs and minimize your environmental footprint. Install energy-efficient windows and doors to improve insulation and regulate indoor temperatures. Consider adding solar panels to generate clean, renewable energy and lower your electricity bills over time.</p>\r\n<p><em>Image Prompt: A rooftop adorned with solar panels, harnessing the power of the sun to provide sustainable energy for the home, symbolizing eco-friendly living and cost savings.</em></p>\r\n</li>\r\n</ol>\r\n<p>By implementing these home improvement ideas, you can transform your living space into a stylish and functional sanctuary that you\'ll be proud to call home. Whether you\'re planning to sell or simply want to enjoy your home to the fullest, these projects will enhance your quality of life and increase the value of your property. Get ready to embark on a journey of transformation and create the home of your dreams!</p>', 'RealState,HomeImprovement', '2024-02-15 04:33:40', '2024-02-15 04:33:40'),
(3, 3, 1, 'Exploring the Timeless Beauty of Architectural Marvels', 'exploring-the-timeless-beauty-of-architectural-marvels', 'upload/post_images/1790960703727025.jpg', 'Architecture is a living testament to human creativity and innovation, spanning centuries and continents to leave an indelible mark on the world around us.', '<p>In the realm of architecture, there exists a mesmerizing tapestry of human ingenuity and artistic expression. From ancient wonders to modern marvels, each structure tells a story of its time, reflecting the culture, aspirations, and technological prowess of its creators. Join us on a journey through the annals of architectural history as we unravel the secrets behind some of the world\'s most iconic landmarks.</p>\r\n<p><strong>Introduction (50 words):</strong></p>\r\n<p>Architecture is more than just bricks and mortar; it\'s a testament to human creativity and vision. In this blog post, we delve deep into the realm of architectural marvels, exploring the intricate designs, rich histories, and timeless beauty that define these extraordinary structures.</p>\r\n<p><strong>1. The Timeless Grandeur of Gothic Cathedrals (100 words):</strong></p>\r\n<p>Step into the ethereal world of Gothic architecture, where soaring spires, intricate stained glass windows, and imposing facades transport you to a bygone era of faith and piety. From the majestic Notre-Dame Cathedral in Paris to the awe-inspiring Cologne Cathedral in Germany, these sacred monuments stand as enduring symbols of divine worship and architectural prowess.</p>\r\n<p><em>Image Prompt: A silhouette of a Gothic cathedral against a radiant sunset sky, with intricate details illuminated by the fading light.</em></p>\r\n<p><strong>2. The Majesty of Ancient Temples and Palaces (100 words):</strong></p>\r\n<p>Travel back in time to ancient civilizations that left an indelible mark on the architectural landscape. From the mystical temples of Angkor Wat in Cambodia to the majestic pyramids of Giza in Egypt, these ancient wonders continue to captivate and inspire with their grandeur and mystique. Marvel at the intricate carvings, towering columns, and celestial alignments that speak volumes about the ingenuity of ancient builders.</p>\r\n<p><em>Image Prompt: A sun-kissed view of Angkor Wat, with its iconic silhouette reflected in the tranquil waters of the surrounding moat.</em></p>\r\n<p><strong>3. The Modern Marvels of Sky-high Skyscrapers (100 words):</strong></p>\r\n<p>Enter the realm of modern architecture, where skyscrapers pierce the heavens and redefine the urban skyline. From the sleek Burj Khalifa in Dubai to the iconic Empire State Building in New York City, these architectural giants stand as testaments to human ambition and engineering prowess. Explore the innovative designs, sustainable technologies, and futuristic concepts that shape the cities of tomorrow.</p>\r\n<p><em>Image Prompt: A panoramic view of a bustling metropolis, dominated by the shimmering glass facades of towering skyscrapers reaching towards the clouds.</em></p>\r\n<p><strong>4. The Serenity of Contemporary Masterpieces (100 words):</strong></p>\r\n<p>Discover the beauty of contemporary architecture, where form meets function in perfect harmony. From the minimalist elegance of the Guggenheim Museum in Bilbao to the avant-garde design of the Sydney Opera House, these architectural gems push the boundaries of creativity and redefine our perception of space. Experience the intersection of art, culture, and architecture in these modern-day marvels.</p>\r\n<p><em>Image Prompt: A serene shot of the Sydney Opera House, its iconic sail-like structures reflecting in the tranquil waters of Sydney Harbour.</em></p>', 'Realestate,ArchitecturalMarvels', '2024-02-15 05:03:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `state_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `state_id`, `created_at`, `updated_at`) VALUES
(1, 'Lucknow', 1, '2024-02-14 04:14:36', '2024-02-14 04:14:36'),
(2, 'Kanpur', 1, '2024-02-14 04:14:50', '2024-02-14 04:14:50'),
(3, 'Patna', 2, '2024-02-14 04:15:25', '2024-02-14 04:15:25'),
(4, 'Gaya', 2, '2024-02-14 04:15:38', '2024-02-14 04:15:38'),
(5, 'Shimla', 4, '2024-02-14 04:16:48', '2024-02-14 04:16:48'),
(6, 'Manali', 4, '2024-02-14 04:16:59', '2024-02-14 04:16:59'),
(7, 'Dehradun', 3, '2024-02-14 04:17:55', '2024-02-14 04:17:55'),
(8, 'Haridwar', 3, '2024-02-14 04:18:17', '2024-02-14 04:18:17');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `subject` text DEFAULT NULL,
  `message` text NOT NULL,
  `status` enum('reply','unreply') NOT NULL DEFAULT 'unreply',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `compares`
--

CREATE TABLE `compares` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `property_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `status` enum('read','unread') NOT NULL DEFAULT 'unread',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `username`, `email`, `phone`, `subject`, `message`, `status`, `created_at`, `updated_at`) VALUES
(5, 'demo-hmsh', 'admin@gmail.com', '7878454512', 'Subject Test', 'hyut', 'read', '2024-01-24 23:40:13', '2024-01-25 01:46:44'),
(6, 'admin', 'admin@gmail.com', '7878454512', 'Subject Test', 'Test', 'read', '2024-02-02 07:32:33', '2024-02-02 07:35:34');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'India', '2024-02-14 04:00:50', '2024-02-14 04:00:50');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `property_id` int(11) NOT NULL,
  `facility_name` varchar(255) DEFAULT NULL,
  `distance` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `property_id`, `facility_name`, `distance`, `created_at`, `updated_at`) VALUES
(1, 1, 'Gomti Riverfront Park', '2', '2024-02-15 01:22:22', '2024-02-15 01:22:22'),
(2, 1, 'Ambedkar Park', '4', '2024-02-15 01:22:22', '2024-02-15 01:22:22'),
(16, 2, 'Hazratganj Market', '0.5', '2024-02-15 01:34:44', '2024-02-15 01:34:44'),
(17, 2, 'Janeshwar Mishra Park', '5', '2024-02-15 01:34:44', '2024-02-15 01:34:44'),
(18, 3, 'Phoenix United Mall', '3', '2024-02-15 01:49:10', '2024-02-15 01:49:10'),
(19, 3, 'Indira Gandhi Pratishthan', '5', '2024-02-15 01:49:10', '2024-02-15 01:49:10'),
(20, 4, 'Fun Republic Mall', '1', '2024-02-15 01:57:46', '2024-02-15 01:57:46'),
(21, 4, 'Riverside Mall', '3', '2024-02-15 01:57:46', '2024-02-15 01:57:46');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `local_areas`
--

CREATE TABLE `local_areas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `local_areas`
--

INSERT INTO `local_areas` (`id`, `name`, `city_id`, `created_at`, `updated_at`) VALUES
(1, 'Gomti Nagar', 1, '2024-02-14 04:19:20', '2024-02-14 04:19:20'),
(2, 'Aliganj', 1, '2024-02-14 04:19:37', '2024-02-14 04:19:37'),
(3, 'Swaroop Nagar', 2, '2024-02-14 04:20:29', '2024-02-14 04:20:29'),
(4, 'Lal Bangla', 2, '2024-02-14 04:20:40', '2024-02-14 04:20:40'),
(5, 'Gaya City', 4, '2024-02-14 04:21:30', '2024-02-14 04:21:30'),
(6, 'Bodhgaya Railway Colony', 4, '2024-02-14 04:21:44', '2024-02-14 04:21:44'),
(7, 'Boring Road', 3, '2024-02-14 04:22:32', '2024-02-14 04:22:32'),
(8, 'Rajendra Nagar', 3, '2024-02-14 04:22:54', '2024-02-14 04:22:54'),
(9, 'Mall Road', 6, '2024-02-14 04:23:29', '2024-02-14 04:23:29'),
(10, 'Old Manali', 6, '2024-02-14 04:23:49', '2024-02-14 04:23:49'),
(11, 'Summer Hill', 5, '2024-02-14 04:24:30', '2024-02-14 04:24:30'),
(12, 'Bharari', 5, '2024-02-14 04:24:44', '2024-02-14 04:24:44'),
(13, 'Rajpur', 7, '2024-02-14 04:25:18', '2024-02-14 04:25:18'),
(14, 'Clement Town', 7, '2024-02-14 04:25:36', '2024-02-14 04:25:36'),
(15, 'Shivalik Nagar', 8, '2024-02-14 04:26:12', '2024-02-14 04:26:12'),
(16, 'Shyampur', 8, '2024-02-14 04:26:24', '2024-02-14 04:26:24'),
(17, 'Hazratganj', 1, '2024-02-14 07:14:23', '2024-02-14 07:14:23'),
(18, 'Indira Nagar', 1, '2024-02-14 07:37:01', '2024-02-14 07:37:01');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_12_14_080048_create_property_types_table', 1),
(6, '2023_12_14_120556_create_amenities_table', 1),
(10, '2023_12_17_123357_create_package_plans_table', 1),
(11, '2023_12_17_124409_add_credit_to_table', 1),
(12, '2023_12_18_102933_add_invoice_to_table', 1),
(13, '2023_12_18_183351_create_wishlists_table', 1),
(14, '2023_12_18_193001_create_compares_table', 1),
(15, '2023_12_18_195759_create_property_messages_table', 1),
(16, '2023_12_19_180221_create_testimonials_table', 1),
(17, '2023_12_19_183507_create_blog_categories_table', 1),
(18, '2023_12_19_190010_create_blog_posts_table', 1),
(19, '2023_12_21_062019_create_comments_table', 1),
(20, '2023_12_21_071740_create_schedules_table', 1),
(21, '2023_12_22_174540_create_smtp_settings_table', 1),
(22, '2023_12_22_182707_create_site_settings_table', 1),
(23, '2023_12_24_063134_create_permission_tables', 1),
(24, '2024_01_08_082048_create_contacts_table', 1),
(25, '2024_01_09_071337_create_term_services_table', 1),
(26, '2024_01_09_071447_create_privacy_policies_table', 1),
(33, '2024_01_31_054342_create_package_plan_settings_table', 3),
(37, '2024_01_31_093707_create_banners_table', 4),
(38, '2023_12_15_125610_create_facilities_table', 5),
(39, '2023_12_15_125714_create_multi_images_table', 5),
(40, '2024_01_15_133249_create_countries_table', 5),
(41, '2024_01_22_082055_create_states_table', 5),
(42, '2024_01_22_082243_create_cities_table', 5),
(43, '2024_01_22_082329_create_local_areas_table', 5),
(45, '2024_01_31_093708_create_properties_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `multi_images`
--

CREATE TABLE `multi_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `property_id` int(11) NOT NULL,
  `photo_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `multi_images`
--

INSERT INTO `multi_images` (`id`, `property_id`, `photo_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'upload/property/multi-image/1790946942327729.jpg', '2024-02-15 01:25:01', NULL),
(2, 1, 'upload/property/multi-image/1790946963459634.png', '2024-02-15 01:25:21', NULL),
(3, 2, 'upload/property/multi-image/1790947553725062.jpg', '2024-02-15 01:34:44', NULL),
(4, 2, 'upload/property/multi-image/1790947553921740.jpg', '2024-02-15 01:34:44', NULL),
(5, 2, 'upload/property/multi-image/1790947554112321.jpg', '2024-02-15 01:34:44', NULL),
(6, 3, 'upload/property/multi-image/1790948462027448.jpg', '2024-02-15 01:49:10', NULL),
(7, 3, 'upload/property/multi-image/1790948509144423.jpg', '2024-02-15 01:49:55', NULL),
(8, 4, 'upload/property/multi-image/1790949002893456.jpg', '2024-02-15 01:57:46', NULL),
(9, 4, 'upload/property/multi-image/1790949003098277.jpg', '2024-02-15 01:57:46', NULL),
(10, 4, 'upload/property/multi-image/1790949003295358.jpg', '2024-02-15 01:57:46', NULL),
(11, 4, 'upload/property/multi-image/1790949068994012.jpg', '2024-02-15 01:58:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `package_plans`
--

CREATE TABLE `package_plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `package_name` varchar(255) DEFAULT NULL,
  `invoice` varchar(255) DEFAULT NULL,
  `package_credits` varchar(255) DEFAULT NULL,
  `package_amount` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `package_plans`
--

INSERT INTO `package_plans` (`id`, `user_id`, `package_name`, `invoice`, `package_credits`, `package_amount`, `created_at`, `updated_at`) VALUES
(1, 2, 'Basic', 'INV60836539', '1', '0', '2024-02-15 01:27:37', NULL),
(4, 6, 'Business', 'INV91954323', '3', '20', '2024-02-15 01:41:50', NULL),
(5, 19, 'Professional', 'INV91025588', '10', '50', '2024-02-15 01:52:39', NULL),
(6, 24, 'Business', 'INV74066634', '3', '20', '2024-02-15 02:03:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `package_plan_settings`
--

CREATE TABLE `package_plan_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_name` varchar(255) NOT NULL,
  `package_credits` varchar(255) NOT NULL,
  `package_amount` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `package_plan_settings`
--

INSERT INTO `package_plan_settings` (`id`, `package_name`, `package_credits`, `package_amount`, `created_at`, `updated_at`) VALUES
(1, 'Basic', '1', '0', '2024-01-31 01:04:44', '2024-01-31 02:17:53'),
(2, 'Business', '3', '20', '2024-01-31 01:04:44', '2024-01-31 02:20:53'),
(3, 'Professional', '10', '50', '2024-01-31 01:04:44', '2024-01-31 02:24:29');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `created_at`, `updated_at`) VALUES
(1, 'property.type.menu', 'web', 'property_type', '2024-01-22 05:20:14', '2024-01-22 05:20:14'),
(2, 'property.type.all', 'web', 'property_type', '2024-01-22 05:20:38', '2024-01-22 05:20:38'),
(3, 'property.type.add', 'web', 'property_type', '2024-01-22 05:21:01', '2024-01-22 05:21:01'),
(4, 'property.type.edit', 'web', 'property_type', '2024-01-22 05:21:11', '2024-01-22 05:21:11'),
(5, 'property.type.delete', 'web', 'property_type', '2024-01-22 05:21:28', '2024-01-22 05:21:28'),
(6, 'role.permission.menu', 'web', 'role_permission', '2024-01-22 05:26:35', '2024-01-22 05:26:35'),
(7, 'permission.all', 'web', 'role_permission', '2024-01-22 05:27:08', '2024-01-22 05:27:08'),
(8, 'permission.add', 'web', 'role_permission', '2024-01-22 05:27:16', '2024-01-22 05:27:16'),
(9, 'role.all', 'web', 'role_permission', '2024-01-22 05:27:37', '2024-01-22 05:27:37'),
(10, 'role.add', 'web', 'role_permission', '2024-01-22 05:27:50', '2024-01-22 05:27:50'),
(11, 'role.permission.all', 'web', 'role_permission', '2024-01-22 05:28:12', '2024-01-22 05:28:12'),
(12, 'role.permission.add', 'web', 'role_permission', '2024-01-22 05:28:28', '2024-01-22 05:28:28'),
(13, 'admin.user.add', 'web', 'admin_user', '2024-01-22 05:31:47', '2024-01-22 05:31:47'),
(14, 'admin.user.edit', 'web', 'admin_user', '2024-01-22 05:32:38', '2024-01-22 05:32:38'),
(15, 'admin.user.delete', 'web', 'admin_user', '2024-01-22 05:32:52', '2024-01-22 05:32:52'),
(16, 'admin.user.menu', 'web', 'admin_user', '2024-01-22 05:33:09', '2024-01-22 05:33:09'),
(17, 'permission.edit', 'web', 'role_permission', '2024-01-22 05:34:38', '2024-01-22 05:34:38'),
(18, 'permission.delete', 'web', 'role_permission', '2024-01-22 05:34:49', '2024-01-22 05:34:49'),
(19, 'role.edit', 'web', 'role_permission', '2024-01-22 05:35:28', '2024-01-22 05:35:28'),
(20, 'role.delete', 'web', 'role_permission', '2024-01-22 05:35:40', '2024-01-22 05:35:40'),
(21, 'role.permission.edit', 'web', 'role_permission', '2024-01-22 05:36:09', '2024-01-22 05:36:09'),
(22, 'role.permission.delete', 'web', 'role_permission', '2024-01-22 05:42:26', '2024-01-22 05:42:26'),
(23, 'admin.user.all', 'web', 'admin_user', '2024-01-22 05:43:28', '2024-01-22 05:43:28'),
(24, 'location.menu', 'web', 'location', '2024-01-22 05:46:48', '2024-01-22 05:46:48'),
(25, 'country', 'web', 'location', '2024-01-22 05:49:46', '2024-01-22 05:49:46'),
(26, 'state', 'web', 'location', '2024-01-22 05:49:53', '2024-01-22 05:49:53'),
(27, 'city', 'web', 'location', '2024-01-22 05:50:00', '2024-01-22 05:50:00'),
(28, 'local_area', 'web', 'location', '2024-01-22 05:50:09', '2024-01-22 05:50:09'),
(29, 'add.country', 'web', 'location', '2024-01-22 05:53:11', '2024-01-22 05:53:11'),
(30, 'edit.country', 'web', 'location', '2024-01-22 05:53:27', '2024-01-22 05:53:27'),
(31, 'delete.country', 'web', 'location', '2024-01-22 05:53:54', '2024-01-22 05:53:54'),
(32, 'add.state', 'web', 'location', '2024-01-22 05:55:31', '2024-01-22 05:55:31'),
(33, 'edit.state', 'web', 'location', '2024-01-22 05:55:42', '2024-01-22 05:55:42'),
(34, 'delete.state', 'web', 'location', '2024-01-22 05:55:58', '2024-01-22 05:56:07'),
(35, 'edit.city', 'web', 'location', '2024-01-22 05:57:59', '2024-01-22 05:57:59'),
(36, 'add.city', 'web', 'location', '2024-01-22 05:58:08', '2024-01-22 05:58:08'),
(37, 'delete.city', 'web', 'location', '2024-01-22 05:58:22', '2024-01-22 05:58:22'),
(38, 'edit.local_area', 'web', 'location', '2024-01-22 06:00:28', '2024-01-22 06:00:28'),
(39, 'add.local_area', 'web', 'location', '2024-01-22 06:00:37', '2024-01-22 06:00:37'),
(40, 'delete.local_area', 'web', 'location', '2024-01-22 06:01:29', '2024-01-22 06:01:29'),
(41, 'amenitie.menu', 'web', 'amenities', '2024-01-22 06:49:05', '2024-01-22 06:49:05'),
(42, 'amenitie.all', 'web', 'amenities', '2024-01-22 06:49:25', '2024-01-22 06:49:25'),
(43, 'amenitie.add', 'web', 'amenities', '2024-01-22 06:49:59', '2024-01-22 06:49:59'),
(44, 'amenitie.edit', 'web', 'amenities', '2024-01-22 06:50:20', '2024-01-22 06:50:20'),
(45, 'amenitie.delete', 'web', 'amenities', '2024-01-22 06:50:55', '2024-01-22 06:50:55'),
(46, 'property.menu', 'web', 'property', '2024-01-22 06:52:24', '2024-01-22 06:52:24'),
(47, 'property.all', 'web', 'property', '2024-01-22 06:52:46', '2024-01-22 06:52:46'),
(48, 'property.add', 'web', 'property', '2024-01-22 06:53:02', '2024-01-22 06:53:02'),
(49, 'property.edit', 'web', 'property', '2024-01-22 06:53:24', '2024-01-22 06:53:24'),
(50, 'property.delete', 'web', 'property', '2024-01-22 06:53:57', '2024-01-22 06:53:57'),
(51, 'property.details', 'web', 'property', '2024-01-23 23:52:21', '2024-01-23 23:52:21'),
(52, 'package.history', 'web', 'history', '2024-01-24 07:06:17', '2024-01-24 07:06:17'),
(53, 'package.history.download', 'web', 'history', '2024-01-24 07:06:56', '2024-01-24 07:06:56'),
(54, 'message.all', 'web', 'message', '2024-01-24 07:08:09', '2024-01-24 07:08:09'),
(55, 'message.details', 'web', 'message', '2024-01-24 07:08:58', '2024-01-24 07:08:58'),
(56, 'schedule.all', 'web', 'schedule', '2024-01-24 07:10:16', '2024-01-24 07:10:16'),
(57, 'schedule.details', 'web', 'schedule', '2024-01-24 07:11:58', '2024-01-24 07:11:58'),
(58, 'schedule.detele', 'web', 'schedule', '2024-01-24 07:12:28', '2024-01-24 07:25:06'),
(59, 'message.delete', 'web', 'message', '2024-01-24 07:27:42', '2024-01-24 07:27:42'),
(60, 'contact.all', 'web', 'contact', '2024-01-24 07:32:38', '2024-01-24 07:32:38'),
(61, 'contact.delete', 'web', 'schedule', '2024-01-24 07:36:55', '2024-01-24 07:36:55'),
(62, 'contact.details', 'web', 'contact', '2024-01-24 07:37:04', '2024-01-24 07:37:04'),
(63, 'testimonials.menu', 'web', 'testimonials', '2024-01-24 07:38:06', '2024-01-24 07:38:06'),
(64, 'testimonials.all', 'web', 'testimonials', '2024-01-24 07:38:17', '2024-01-24 07:38:17'),
(65, 'testimonials.add', 'web', 'testimonials', '2024-01-24 07:38:28', '2024-01-24 07:38:28'),
(66, 'testimonials.edit', 'web', 'testimonials', '2024-01-24 07:38:42', '2024-01-24 07:38:42'),
(67, 'testimonials.delete', 'web', 'testimonials', '2024-01-24 07:39:15', '2024-01-24 07:39:15'),
(70, 'register.agent', 'web', 'agent', '2024-01-24 07:42:14', '2024-01-25 02:00:07'),
(72, 'agent.delete', 'web', 'agent', '2024-01-24 07:42:40', '2024-01-24 07:42:40'),
(73, 'agent.status.change', 'web', 'agent', '2024-01-24 07:43:05', '2024-01-24 07:43:05'),
(74, 'blog.menu', 'web', 'blog', '2024-01-24 07:44:21', '2024-01-24 07:44:21'),
(75, 'blog.post.add', 'web', 'blog', '2024-01-24 07:51:32', '2024-01-24 07:51:32'),
(76, 'blog.post.all', 'web', 'blog', '2024-01-24 07:51:48', '2024-01-24 07:51:48'),
(77, 'blog.category.all', 'web', 'blog', '2024-01-24 07:52:04', '2024-01-24 07:52:04'),
(78, 'blog.comment.all', 'web', 'blog', '2024-01-24 07:52:20', '2024-01-24 07:52:20'),
(79, 'blog.post.edit', 'web', 'blog', '2024-01-24 07:54:09', '2024-01-24 07:54:09'),
(80, 'blog.post.delete', 'web', 'blog', '2024-01-24 07:54:25', '2024-01-24 07:54:25'),
(81, 'blog.comment.reply', 'web', 'blog', '2024-01-24 07:55:02', '2024-01-24 07:55:02'),
(82, 'blog.category.add', 'web', 'blog', '2024-01-24 07:58:00', '2024-01-24 07:58:00'),
(83, 'blog.category.edit', 'web', 'blog', '2024-01-24 07:58:12', '2024-01-24 07:58:12'),
(84, 'blog.category.delete', 'web', 'blog', '2024-01-24 07:58:23', '2024-01-24 07:58:23'),
(85, 'setting.menu', 'web', 'setting', '2024-01-24 08:05:46', '2024-01-24 08:05:46'),
(86, 'setting.smtp', 'web', 'setting', '2024-01-24 08:06:08', '2024-01-24 08:06:08'),
(87, 'setting.site', 'web', 'setting', '2024-01-24 08:06:25', '2024-01-24 08:06:25'),
(88, 'setting.term_service', 'web', 'setting', '2024-01-24 08:06:38', '2024-01-24 08:06:38'),
(89, 'setting.privacy_policy', 'web', 'setting', '2024-01-24 08:07:00', '2024-01-24 08:07:00'),
(90, 'agent.details', 'web', 'agent', '2024-01-25 02:01:39', '2024-01-25 08:02:46'),
(91, 'register.user', 'web', 'user', '2024-01-25 02:53:27', '2024-01-25 02:53:27'),
(92, 'user.details', 'web', 'user', '2024-01-25 02:54:25', '2024-01-25 02:54:25'),
(93, 'user.delete', 'web', 'user', '2024-01-25 04:13:51', '2024-01-25 04:13:51'),
(94, 'user.status.change', 'web', 'user', '2024-01-25 04:14:13', '2024-01-25 04:14:13'),
(95, 'setting.package', 'web', 'setting', '2024-01-31 01:29:25', '2024-01-31 01:29:25'),
(96, 'edit.package', 'web', 'setting', '2024-01-31 01:30:42', '2024-01-31 01:30:42'),
(97, 'setting.banner', 'web', 'setting', '2024-01-31 07:14:56', '2024-01-31 07:14:56');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `privacy_policies`
--

CREATE TABLE `privacy_policies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `privacy_policy` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `privacy_policies`
--

INSERT INTO `privacy_policies` (`id`, `privacy_policy`, `created_at`, `updated_at`) VALUES
(1, '<h2>Privacy Policy</h2>\n            <p>Last updated: 2024-01-25</p>\n            <h3>1. Introduction</h3>\n            <p>Welcome to [Your Real Estate Website] (\'us,\' \'we,\' or \'our\'). This Privacy Policy outlines our practices regarding the collection, use, and disclosure of personal information when you use our website.</p>\n            <h3>2. Information We Collect</h3>\n            <h4>2.1 Personal Information</h4>\n            <p>We may collect personal information such as:</p>\n            <ul>\n            <li>Name</li>\n            <li>Email address</li>\n            <li>Phone number</li>\n            <li>Address</li>\n            <li>Property preferences</li>\n            </ul>\n            <h4>2.2 Usage Data</h4>\n            <p>We collect information about how you interact with our website, including:</p>\n            <ul>\n            <li>IP address</li>\n            <li>Browser type</li>\n            <li>Pages viewed</li>\n            <li>Date and time of visits</li>\n            </ul>\n            <h3>3. How We Use Your Information</h3>\n            <p>We use your personal information for various purposes, including:</p>\n            <ul>\n            <li>Providing and maintaining our services</li>\n            <li>Customizing content based on your preferences</li>\n            <li>Communicating with you</li>\n            <li>Analyzing website usage and improving our services</li>\n            </ul>\n            <h3>4. Cookies</h3>\n            <p>We use cookies and similar tracking technologies to enhance your experience on our site. You can control cookies through your browser settings.</p>\n            <h3>5. Third-Party Services</h3>\n            <p>We may use third-party services to analyze website traffic and improve our services. These services may collect information about your use of our website.</p>\n            <h3>6. Security</h3>\n            <p>We prioritize the security of your personal information. However, no method of transmission over the internet or electronic storage is 100% secure. We cannot guarantee absolute security.</p>\n            <h3>7. Your Choices</h3>\n            <p>You have the right to:</p>\n            <ul>\n            <li>Access, correct, or delete your personal information</li>\n            <li>Opt-out of receiving promotional communications</li>\n            </ul>\n            <h3>8. Children\'s Privacy</h3>\n            <p>Our services are not directed to children under the age of 13. We do not knowingly collect personal information from children.</p>\n            <h3>9. Changes to This Privacy Policy</h3>\n            <p>We may update our Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page.</p>\n            <h3>10. Contact Us</h3>\n            <p>If you have any questions about this Privacy Policy, please contact us at [Your Contact Information].</p>\n            <p>By using our website, you agree to the terms of this Privacy Policy.</p>', '2024-01-24 23:33:22', '2024-01-24 23:33:22'),
(2, '<h2>Privacy Policy</h2>\n            <p>Last updated: 2024-01-25</p>\n            <h3>1. Introduction</h3>\n            <p>Welcome to [Your Real Estate Website] (\'us,\' \'we,\' or \'our\'). This Privacy Policy outlines our practices regarding the collection, use, and disclosure of personal information when you use our website.</p>\n            <h3>2. Information We Collect</h3>\n            <h4>2.1 Personal Information</h4>\n            <p>We may collect personal information such as:</p>\n            <ul>\n            <li>Name</li>\n            <li>Email address</li>\n            <li>Phone number</li>\n            <li>Address</li>\n            <li>Property preferences</li>\n            </ul>\n            <h4>2.2 Usage Data</h4>\n            <p>We collect information about how you interact with our website, including:</p>\n            <ul>\n            <li>IP address</li>\n            <li>Browser type</li>\n            <li>Pages viewed</li>\n            <li>Date and time of visits</li>\n            </ul>\n            <h3>3. How We Use Your Information</h3>\n            <p>We use your personal information for various purposes, including:</p>\n            <ul>\n            <li>Providing and maintaining our services</li>\n            <li>Customizing content based on your preferences</li>\n            <li>Communicating with you</li>\n            <li>Analyzing website usage and improving our services</li>\n            </ul>\n            <h3>4. Cookies</h3>\n            <p>We use cookies and similar tracking technologies to enhance your experience on our site. You can control cookies through your browser settings.</p>\n            <h3>5. Third-Party Services</h3>\n            <p>We may use third-party services to analyze website traffic and improve our services. These services may collect information about your use of our website.</p>\n            <h3>6. Security</h3>\n            <p>We prioritize the security of your personal information. However, no method of transmission over the internet or electronic storage is 100% secure. We cannot guarantee absolute security.</p>\n            <h3>7. Your Choices</h3>\n            <p>You have the right to:</p>\n            <ul>\n            <li>Access, correct, or delete your personal information</li>\n            <li>Opt-out of receiving promotional communications</li>\n            </ul>\n            <h3>8. Children\'s Privacy</h3>\n            <p>Our services are not directed to children under the age of 13. We do not knowingly collect personal information from children.</p>\n            <h3>9. Changes to This Privacy Policy</h3>\n            <p>We may update our Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page.</p>\n            <h3>10. Contact Us</h3>\n            <p>If you have any questions about this Privacy Policy, please contact us at [Your Contact Information].</p>\n            <p>By using our website, you agree to the terms of this Privacy Policy.</p>', '2024-01-25 00:18:27', '2024-01-25 00:18:27');

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ptype_id` varchar(255) NOT NULL,
  `amenities_id` varchar(255) NOT NULL,
  `property_name` varchar(255) NOT NULL,
  `property_slug` varchar(255) NOT NULL,
  `property_code` varchar(255) NOT NULL,
  `property_status` varchar(255) NOT NULL,
  `lowest_price` varchar(255) DEFAULT NULL,
  `max_price` varchar(255) DEFAULT NULL,
  `property_thambnail` varchar(255) NOT NULL,
  `short_descp` text DEFAULT NULL,
  `long_descp` text DEFAULT NULL,
  `bedrooms` varchar(255) DEFAULT NULL,
  `bathrooms` varchar(255) DEFAULT NULL,
  `garage` varchar(255) DEFAULT NULL,
  `garage_size` varchar(255) DEFAULT NULL,
  `property_size` varchar(255) DEFAULT NULL,
  `property_video` varchar(255) DEFAULT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `state_id` bigint(20) UNSIGNED NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `local_area_id` bigint(20) UNSIGNED NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `neighborhood` varchar(255) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `featured` varchar(255) DEFAULT NULL,
  `hot` varchar(255) DEFAULT NULL,
  `agent_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `ptype_id`, `amenities_id`, `property_name`, `property_slug`, `property_code`, `property_status`, `lowest_price`, `max_price`, `property_thambnail`, `short_descp`, `long_descp`, `bedrooms`, `bathrooms`, `garage`, `garage_size`, `property_size`, `property_video`, `country_id`, `state_id`, `city_id`, `local_area_id`, `address`, `postal_code`, `neighborhood`, `latitude`, `longitude`, `featured`, `hot`, `agent_id`, `status`, `created_at`, `updated_at`) VALUES
(1, '3', '13,1,18,12,11,16,14,5', 'Serene Heights', 'serene-heights', 'PC001', 'buy', '6500000', NULL, 'upload/property/thambnail/1790946776017104.png', 'Discover luxury living at Serene Heights, where elegance meets comfort. These modern apartments offer breathtaking views of the cityscape and are designed for your ultimate relaxation and convenience.', '<p>Discover luxury living at Serene Heights, where elegance meets comfort. These modern apartments offer breathtaking views of the cityscape and are designed for your ultimate relaxation and convenience.</p>', '3', '2', '1', '200', '1500', 'https://youtube.com/royalapartments', 1, 1, 1, 1, 'Gomti Nagar, Lucknow, Uttar Pradesh, 226010, India', '226010', NULL, '26.8512', '80.9409', '1', '1', 1, '1', '2024-02-15 01:22:22', '2024-02-15 01:26:03'),
(2, '2', '13,18,16,14', 'Golden Plaza', 'golden-plaza', 'PC002', 'rent', '30000', NULL, 'upload/property/thambnail/1790947553524197.jpg', 'Golden Plaza offers prime commercial spaces ideal for businesses looking to thrive in Lucknow\'s bustling market.', '<p>Golden Plaza offers prime commercial spaces ideal for businesses looking to thrive in Lucknow\'s bustling market. Strategically located in the heart of the city, these offices provide excellent visibility and accessibility.</p>', '3', '2', '1', '100', '600', 'https://youtube.com/royalapartments', 1, 1, 1, 17, 'Hazratganj, Lucknow, Uttar Pradesh, 226001, India', '226001', NULL, '26.8467', '80.9462', '1', '1', 2, '1', '2024-02-15 01:34:44', NULL),
(3, '3', '13,15,5', 'Lakeview Residency', 'lakeview-residency', 'PC003', 'buy', '8500000', NULL, 'upload/property/thambnail/1790948461875682.jpg', 'Experience lakeside living at its finest at Lakeview Residency. These exquisite apartments offer panoramic views of the shimmering waters and lush green surroundings, providing a tranquil retreat from the city hustle.', '<p>Experience lakeside living at its finest at Lakeview Residency. These exquisite apartments offer panoramic views of the shimmering waters and lush green surroundings, providing a tranquil retreat from the city hustle.</p>', '3', '2', '1', '200', '1800', 'https://youtube.com/royalapartments', 1, 1, 1, 1, 'Gomti Nagar Extension, Lucknow, Uttar Pradesh, 226010, India', '226010', NULL, '26.8474', '81.0065', '1', '1', 6, '1', '2024-02-15 01:49:10', '2024-02-15 05:36:30'),
(4, '9', '13,18,17,16', 'Corporate Tower', 'corporate-tower', 'PC004', 'rent', '30000', NULL, 'upload/property/thambnail/1790949002687149.jpg', 'Elevate your business presence with Corporate Tower, a prestigious office complex offering state-of-the-art facilities and a prestigious address. Impress clients and employees alike with modern design and convenient amenities.', '<p>Elevate your business presence with Corporate Tower, a prestigious office complex offering state-of-the-art facilities and a prestigious address. Impress clients and employees alike with modern design and convenient amenities.</p>', '0', '0', '1', '200', '600', 'https://youtube.com/royalapartments', 1, 1, 1, 1, 'Vibhuti Khand, Gomti Nagar, Lucknow, Uttar Pradesh, 226010, India', '226010', NULL, '26.8573', '81.0110', '1', '1', 19, '1', '2024-02-15 01:57:46', '2024-02-15 05:36:18');

-- --------------------------------------------------------

--
-- Table structure for table `property_messages`
--

CREATE TABLE `property_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `agent_id` varchar(255) DEFAULT NULL,
  `property_id` int(11) DEFAULT NULL,
  `msg_name` varchar(255) DEFAULT NULL,
  `msg_email` varchar(255) DEFAULT NULL,
  `msg_phone` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `admin_status` enum('read','unread') NOT NULL DEFAULT 'unread',
  `agent_status` enum('read','unread') NOT NULL DEFAULT 'unread',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `property_types`
--

CREATE TABLE `property_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type_name` varchar(255) NOT NULL,
  `type_icon` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_types`
--

INSERT INTO `property_types` (`id`, `type_name`, `type_icon`, `created_at`, `updated_at`) VALUES
(1, 'Residential', 'icon-1', NULL, NULL),
(2, 'Commercial', 'icon-2', NULL, NULL),
(3, 'Apartment', 'icon-3', NULL, '2024-02-14 06:27:07'),
(4, 'Industrial', 'icon-4', NULL, NULL),
(5, 'Building Code', 'icon-5', NULL, NULL),
(6, 'Land', 'icon-6', NULL, NULL),
(7, 'Floor Area', 'icon-7', NULL, NULL),
(8, 'Communal land', 'icon-8', NULL, NULL),
(9, 'Offices', 'icon-9', NULL, NULL),
(10, 'Factory', 'icon-10', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'web', '2024-01-22 05:17:51', '2024-01-22 05:17:51'),
(2, 'Admin', 'web', '2024-01-22 05:18:08', '2024-01-22 05:18:08'),
(3, 'Manager', 'web', '2024-01-22 05:18:26', '2024-01-22 05:18:26');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(70, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 1),
(86, 1),
(87, 1),
(88, 1),
(89, 1),
(90, 1),
(91, 1),
(92, 1),
(93, 1),
(94, 1),
(95, 1),
(96, 1),
(97, 1);

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `property_id` int(11) DEFAULT NULL,
  `agent_id` varchar(255) DEFAULT NULL,
  `tour_date` varchar(255) DEFAULT NULL,
  `tour_time` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `side_header_logo` varchar(255) DEFAULT NULL,
  `footer_logo` varchar(255) DEFAULT NULL,
  `support_phone` varchar(255) DEFAULT NULL,
  `company_address` text DEFAULT NULL,
  `about` text DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `currency_symbol` varchar(5) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `open_timming` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `favicon`, `logo`, `side_header_logo`, `footer_logo`, `support_phone`, `company_address`, `about`, `company_name`, `currency_symbol`, `latitude`, `longitude`, `email`, `facebook`, `website`, `twitter`, `instagram`, `youtube`, `open_timming`, `created_at`, `updated_at`) VALUES
(1, 'upload/fevicon/fevicon.png', 'upload/logo_image/1789601951373442.png', 'upload/logo_image/1789601951406620.png', 'upload/logo_image/1789601951410822.png', '05224324142', 'Kapoorthala, Lucknow (UP), India', 'Lorem ipsum dolor amet consetetur adi pisicing elit sed eiusm tempor in cididunt ut labore dolore magna aliqua enim ad minim venitam.Quis nostrud exercita laboris nisi ut aliquip commodo.', 'Sprinix', 'Rs.', '26.884955484089716', '80.94519653000256', 'info@sprinix.com', 'https://www.facebook.com/', 'https://www.sprinix.com/', 'https://twitter.com/i/flow/login', 'https://www.instagram.com/', 'https://www.youtube.com/', 'Mon - Sat 9.00 - 18.00', '2024-01-25 01:39:23', '2024-02-15 00:59:57');

-- --------------------------------------------------------

--
-- Table structure for table `smtp_settings`
--

CREATE TABLE `smtp_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mailer` varchar(255) DEFAULT NULL,
  `host` varchar(255) DEFAULT NULL,
  `port` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `encryption` varchar(255) DEFAULT NULL,
  `from_address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `smtp_settings`
--

INSERT INTO `smtp_settings` (`id`, `mailer`, `host`, `port`, `username`, `password`, `encryption`, `from_address`, `created_at`, `updated_at`) VALUES
(1, 'smtp', 'sandbox.smtp.mailtrap.io', '2525', 'f129311ef43535', 'c7cb06dec6d7c0', 'tls', 'realstate@support.com', '2024-01-24 08:37:22', '2024-01-24 08:37:22');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `state_name` varchar(255) NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `state_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `state_name`, `country_id`, `state_image`, `created_at`, `updated_at`) VALUES
(1, 'Uttar Pradesh', 1, 'upload/state_images/1790866767264534.jpg', '2024-02-14 04:10:40', '2024-02-14 04:10:40'),
(2, 'Bihar', 1, 'upload/state_images/1790866827187381.jpg', '2024-02-14 04:11:37', '2024-02-14 04:11:37'),
(3, 'Uttarakhand', 1, 'upload/state_images/1790866892950366.jpg', '2024-02-14 04:12:40', '2024-02-14 04:12:40'),
(4, 'Himachal Pradesh', 1, 'upload/state_images/1790866966029133.jpg', '2024-02-14 04:13:49', '2024-02-14 04:13:49');

-- --------------------------------------------------------

--
-- Table structure for table `term_services`
--

CREATE TABLE `term_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `term_service` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `term_services`
--

INSERT INTO `term_services` (`id`, `term_service`, `created_at`, `updated_at`) VALUES
(1, 'This is your dummy Term of Service content. You can replace this with the actual Terms of Service text for your real estate site.', '2024-01-24 23:38:13', '2024-01-24 23:38:13');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `position`, `image`, `message`, `created_at`, `updated_at`) VALUES
(5, 'Rebeka Dawson', 'Instructor', 'upload/testimonial_image/1789067808399642.jpg', 'Our goal each day is to ensure that our residents’ needs are not only met but exceeded. To make that happen we are committed to provid ing an environment in which residents can enjoy.', NULL, NULL),
(6, 'Owen Lester', 'Manager', 'upload/testimonial_image/1789067855179285.jpg', 'Our goal each day is to ensure that our residents’ needs are not only met but exceeded. To make that happen we are committed to provid ing an environment in which residents can enjoy.', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `facebook` text DEFAULT NULL,
  `twitter` text DEFAULT NULL,
  `instagram` text DEFAULT NULL,
  `youtube` text DEFAULT NULL,
  `about` text DEFAULT NULL,
  `role` enum('admin','agent','user') NOT NULL DEFAULT 'user',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `credit` varchar(255) DEFAULT '0',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `photo`, `phone`, `address`, `facebook`, `twitter`, `instagram`, `youtube`, `about`, `role`, `status`, `credit`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Spinix', 'sprinix', 'admin@gmail.com', '2024-01-22 05:06:00', '$2y$12$le.QTQ4NHI62Mx7i1FVgQ.2vQJv97uDn6c.0.S3anHid2yJgwS6uu', '202402141115avatar-5.png', '5224324142', '8863 Jamie StravenueMayertfurt, WA 38365-1516', 'https://www.facebook.com/', 'https://twitter.com/i/flow/login', 'https://www.instagram.com/', 'https://www.youtube.com/', 'As an administrator, you hold the keys to the digital realm of our system. Your role is pivotal in ensuring the smooth operation and security of our platform. From managing user accounts and permissions to overseeing system configurations, your expertise is instrumental in maintaining a seamless experience for all users.\r\n\r\nFeel empowered to wield your administrative tools wisely and with precision. Your actions contribute to the efficiency and success of our digital ecosystem. Should you have any questions or encounter challenges, our support team is here to assist you.\r\n\r\nThank you for your dedication and commitment to excellence. Together, let\'s make our platform a thriving and secure space for everyone.\r\n\r\nBest regards,', 'admin', 'active', '0', 'r0SuQ8b1VFLqX3mRg3OHLaQEHZd0IM2kn0geg2PiHFERgjLlwUup1lrzBeV2', '2024-02-13 05:08:10', '2024-02-14 05:45:00'),
(2, 'Parks Missie', 'parksmissie', 'parksmissie@gmail.com', '2024-01-22 05:06:00', '$2y$12$mNewmJyfUWv/n1obu1Voj.5Rbzfj8qSF2GN79hmljcjsTAnehmB72', '202402141259optimized_large_thumb_stage (1).jpg', '8765432109', 'Parks Missie Properties, Hazratganj, Lucknow', 'https://www.facebook.com/', 'https://twitter.com/i/flow/login', 'https://www.instagram.com/', 'https://www.youtube.com/', 'Parks Missie Properties is a trusted name in the real estate industry of Lucknow. We offer a wide range of properties including residential, commercial, and industrial spaces. Our commitment to integrity, transparency, and customer satisfaction sets us apart in the market.', 'agent', 'active', '1', 'EB6MUfRS1MW8p06Vq8CtHGwH7UbmdDXOBFfIunDR9G4PVFzVy6XzOWgR6LW2', '2024-02-06 05:08:04', '2024-02-15 01:34:44'),
(3, 'User', 'user', 'user@gmail.com', '2024-01-22 05:06:00', '$2y$12$sfb.6TKazlAJrjKw7cjSsOpJVWpMU/KWqfUISkNO5aBB0t14x3bbq', '202402160603avatar-1.png', '3859437015', 'Lucknow, Uttar Pradesh', NULL, NULL, NULL, NULL, NULL, 'user', 'active', '0', '09xaV9t7Ml76oLGKGiwRw21HBkALSpeWYWnR26gk9aHNETYNbclw8df4GyEM', '2024-02-03 13:19:28', '2024-02-16 00:33:02'),
(4, 'Evangeline Kerluke III', 'Ivory Gerlach', 'garrison25@example.com', '2024-01-22 05:06:00', '$2y$12$iXCckNYRVplAZI7hkEivGuXjeWBOLjzQPsKLlDwucV0MR3LNVnZ/q', 'https://via.placeholder.com/60x60.png/00aaaa?text=aut', '1-314-245-9033', '587 Casey Square\nNorvalmouth, UT 68807-8326', NULL, NULL, NULL, NULL, NULL, 'admin', 'inactive', '0', 'x5eI5BZjbO', '2024-01-22 05:06:01', '2024-01-22 05:06:01'),
(5, 'Efrain Trantow', 'Megane Crist', 'moises92@example.org', '2024-01-22 05:06:01', '$2y$12$iXCckNYRVplAZI7hkEivGuXjeWBOLjzQPsKLlDwucV0MR3LNVnZ/q', 'https://via.placeholder.com/60x60.png/00cc00?text=consequuntur', '+1 (859) 940-0900', '42942 Jaskolski Mountains Suite 780\nPort Mistyborough, MS 57269-3919', NULL, NULL, NULL, NULL, NULL, 'admin', 'inactive', '0', 'VCkrg15sR0', '2024-01-22 05:06:01', '2024-01-22 05:06:01'),
(6, 'Salon Rachelle', 'salonrachelle', 'salonrachelle@gmail.com', NULL, '$2y$12$BVNZYI.OzTIau3q./.Silew1InObraMjj0sUJPd1Po04mZWCDXc8q', '202402150506Building Construction Logo template (2).png', '9876543210', 'Salon Rachelle Realty, Gomti Nagar, Lucknow', 'https://www.facebook.com/', 'https://twitter.com/i/flow/login', 'https://www.instagram.com/', 'https://www.youtube.com/', 'With over a decade of experience in the real estate market of Lucknow, Salon Rachelle Realty specializes in providing personalized service to clients looking to buy, sell, or rent properties in the city. Our team of dedicated professionals ensures smooth transactions and customer satisfaction.', 'agent', 'active', '1', NULL, '2024-02-13 23:19:24', '2024-02-15 01:49:10'),
(7, 'Melvina Bechtelar', 'Cathrine Nitzsche IV', 'rafaela.marks@example.net', '2024-01-22 05:06:01', '$2y$12$iXCckNYRVplAZI7hkEivGuXjeWBOLjzQPsKLlDwucV0MR3LNVnZ/q', 'https://via.placeholder.com/60x60.png/0088bb?text=dolore', '1-541-339-0954', '84358 Runolfsdottir Knoll\nColliertown, WA 93507-7795', NULL, NULL, NULL, NULL, NULL, 'admin', 'inactive', '0', 'vosDD3GlX3', '2024-01-22 05:06:01', '2024-01-22 05:06:01'),
(8, 'Virgie Graham', 'Soledad Green', 'fannie84@example.org', '2024-01-22 05:06:01', '$2y$12$iXCckNYRVplAZI7hkEivGuXjeWBOLjzQPsKLlDwucV0MR3LNVnZ/q', 'https://via.placeholder.com/60x60.png/0066ee?text=ut', '+1 (541) 488-2465', '779 Elody Islands Suite 768\nMadisenstad, IA 11055', NULL, NULL, NULL, NULL, NULL, 'admin', 'active', '0', 'SCX6NY66XE', '2024-01-22 05:06:01', '2024-01-22 05:06:01'),
(14, 'Abhishek', NULL, 'abhishek@gmail.com', NULL, '$2y$12$krv/w71hSV71NyJCi.KWpOLhyR0hx.A5HGl4mj.a3xnay5vftQTnq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', 'active', '0', NULL, '2024-02-03 07:18:22', '2024-02-03 07:18:22'),
(15, 'User Test', NULL, 'usertest@gmail.com', NULL, '$2y$12$AxEpSUW/KSZzc3yVytj/nuXuONPBWwBAvLRl2B5IDBll05hU/RK82', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', 'active', '0', NULL, '2024-02-02 07:44:36', '2024-02-03 07:44:36'),
(16, 'User1', 'user1', 'user1@gmail.com', NULL, '$2y$12$3KbeNaEUta6jwYVJRL9HGukuEBLHl6aaqDlNLlTdn3RDTOsbPJU.2', '202402070631comment-2.jpg', '7878454512', 'Lucknow, Uttar Pradesh', NULL, NULL, NULL, NULL, NULL, 'user', 'active', '0', NULL, '2024-02-02 23:46:40', '2024-02-07 01:01:14'),
(17, 'User3', 'User3', 'user3@gmail.com', NULL, '$2y$12$nXUl3XFSHIcLSFJlGhzDju4HWfQnwczV5ol7ITEDI4Sn83qeVRELq', '202402070638comment-3.jpg', '7878454512', 'Lucknow, Uttar Pradesh', NULL, NULL, NULL, NULL, NULL, 'user', 'active', '0', NULL, '2024-02-02 23:58:40', '2024-02-07 01:08:43'),
(18, 'user4', 'user4', 'user4@dgmail.com', NULL, '$2y$12$IEM3LAA5Yn..xiBpbeqxUOAdYkQa6zSPdXN7VBMVc.IdJi09dNMz.', '202402070655team-3.jpg', '7878454512', 'Lucknow, Uttar Pradesh', NULL, NULL, NULL, NULL, NULL, 'user', 'active', '0', NULL, '2024-02-02 23:59:31', '2024-02-07 01:25:42'),
(19, 'Avery Davis', 'averydavis', 'averydavis@gmail.com', NULL, '$2y$12$NQEfw4Rz9815W8wS4cvp5OXZw/wPy9IJoqKthKdQ2AD.SEvqL0pHK', '202402150512Building Construction Logo template (1).png', '7654321098', 'Avery Davis Realtors, Indira Nagar, Lucknow', 'https://www.facebook.com/', 'https://twitter.com/i/flow/login', 'https://www.instagram.com/', 'https://www.youtube.com/', 'Avery Davis Realtors is dedicated to helping clients find their dream properties in Lucknow. Whether you\'re looking for a cozy apartment or a spacious villa, our experienced agents will guide you through every step of the process. Your satisfaction is our priority.', 'agent', 'active', '1', NULL, '2024-02-07 00:15:47', '2024-02-15 01:57:46'),
(20, 'UserTest', 'Usertest', 'testuser@gmail.com', NULL, '$2y$12$yyZ5O39rE8FejXQqakngauE2Qf8ITXdIMNInkGE57JCuAohT5p1bq', '202402070751comment-2.jpg', '2547634434', 'fertew6t', NULL, NULL, NULL, NULL, NULL, 'user', 'active', '0', NULL, '2024-02-07 02:19:32', '2024-02-07 02:21:29'),
(21, 'User tes6', NULL, 'usertest6@gmail.com', NULL, '$2y$12$FQ8m5fLpg6YTfqMuvVKoIutavp0XiPO94tRPmAZZg4wOJbk7zqzXW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', 'active', '0', NULL, '2024-02-08 00:24:36', '2024-02-08 00:24:36'),
(22, 'User test 7', NULL, 'usertest7@gmail.com', NULL, '$2y$12$es.SPpEveo5UMGvTb6aNPePE89joy61aRKxmhzEhP6DXjXlxLyxmW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', 'active', '0', NULL, '2024-02-08 00:25:42', '2024-02-08 00:25:42'),
(23, 'user test 8', NULL, 'usertest8@gmail.com', NULL, '$2y$12$x29h1/AySYKuIyBIfnl8rOxqfypD61IGdTelp5oUumlOxfVYlcEUW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', 'active', '0', NULL, '2024-02-08 00:27:51', '2024-02-08 00:27:51'),
(24, 'Brigitte', 'brigitte', 'brigitte@gmail.com', NULL, '$2y$12$7ydpbj8O27zRN0T2SmA5yuVGB/ldCXxpd41dPETcLXE/tQ5HMpg82', '202402150517Building Construction Logo template.png', '6543210987', 'Brigitte Realty Solutions, Alambagh, Lucknow', 'https://www.facebook.com/', 'https://twitter.com/i/flow/login', 'https://www.instagram.com/', 'https://www.youtube.com/', 'Brigitte Realty Solutions offers comprehensive real estate services tailored to meet the unique needs of our clients in Lucknow. From property management to investment consultation, our team is committed to delivering exceptional results with integrity and professionalism.', 'agent', 'active', '0', NULL, '2024-02-13 06:11:13', '2024-02-15 02:03:47');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `property_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `user_id`, `property_id`, `created_at`, `updated_at`) VALUES
(13, 3, 4, '2024-02-16 00:30:16', NULL),
(14, 3, 2, '2024-02-16 00:30:17', NULL),
(15, 3, 3, '2024-02-16 02:46:16', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `amenities`
--
ALTER TABLE `amenities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cities_state_id_foreign` (`state_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `compares`
--
ALTER TABLE `compares`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `local_areas`
--
ALTER TABLE `local_areas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `local_areas_city_id_foreign` (`city_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `multi_images`
--
ALTER TABLE `multi_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_plans`
--
ALTER TABLE `package_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_plan_settings`
--
ALTER TABLE `package_plan_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `privacy_policies`
--
ALTER TABLE `privacy_policies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `properties_country_id_foreign` (`country_id`),
  ADD KEY `properties_state_id_foreign` (`state_id`),
  ADD KEY `properties_city_id_foreign` (`city_id`),
  ADD KEY `properties_local_area_id_foreign` (`local_area_id`),
  ADD KEY `properties_agent_id_foreign` (`agent_id`);

--
-- Indexes for table `property_messages`
--
ALTER TABLE `property_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_types`
--
ALTER TABLE `property_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `smtp_settings`
--
ALTER TABLE `smtp_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`),
  ADD KEY `states_country_id_foreign` (`country_id`);

--
-- Indexes for table `term_services`
--
ALTER TABLE `term_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `amenities`
--
ALTER TABLE `amenities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `compares`
--
ALTER TABLE `compares`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `local_areas`
--
ALTER TABLE `local_areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `multi_images`
--
ALTER TABLE `multi_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `package_plans`
--
ALTER TABLE `package_plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `package_plan_settings`
--
ALTER TABLE `package_plan_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `privacy_policies`
--
ALTER TABLE `privacy_policies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `property_messages`
--
ALTER TABLE `property_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `property_types`
--
ALTER TABLE `property_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `smtp_settings`
--
ALTER TABLE `smtp_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `term_services`
--
ALTER TABLE `term_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`);

--
-- Constraints for table `local_areas`
--
ALTER TABLE `local_areas`
  ADD CONSTRAINT `local_areas_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`);

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `properties_agent_id_foreign` FOREIGN KEY (`agent_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `properties_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`),
  ADD CONSTRAINT `properties_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`),
  ADD CONSTRAINT `properties_local_area_id_foreign` FOREIGN KEY (`local_area_id`) REFERENCES `local_areas` (`id`),
  ADD CONSTRAINT `properties_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`);

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `states`
--
ALTER TABLE `states`
  ADD CONSTRAINT `states_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
