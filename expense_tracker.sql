-- Expense Tracker Database Dump
-- Generated: 2026-06-25 10:01:57
-- Exported from SQLite (Laravel Project)

SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';
SET time_zone = '+00:00';

-- --------------------------------------------------------
-- Table structure for table `migrations`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE "migrations" ("id" integer primary key autoincrement not null, "migration" varchar not null, "batch" integer not null);

-- Dumping data for table `migrations`

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
('1', '0001_01_01_000000_create_users_table', '1'),
('2', '0001_01_01_000001_create_cache_table', '1'),
('3', '0001_01_01_000002_create_jobs_table', '1'),
('4', '2026_06_24_161122_create_wallets_table', '1'),
('5', '2026_06_24_161123_create_categories_table', '1'),
('6', '2026_06_24_161123_create_transactions_table', '1'),
('7', '2026_06_24_161851_create_budgets_table', '2');

-- --------------------------------------------------------
-- Table structure for table `users`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `users`;
CREATE TABLE "users" ("id" integer primary key autoincrement not null, "name" varchar not null, "email" varchar not null, "email_verified_at" datetime, "password" varchar not null, "remember_token" varchar, "created_at" datetime, "updated_at" datetime);

-- Dumping data for table `users`

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
('1', 'Demo User', 'demo@financeapp.com', NULL, '$2y$12$F1bWUqUZIyN9T1iNUKEH/eOJzyK0jlRelb2snZsdDTlaJCG0OgeoO', NULL, '2026-06-25 09:59:32', '2026-06-25 09:59:32');

-- --------------------------------------------------------
-- Table structure for table `password_reset_tokens`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE "password_reset_tokens" ("email" varchar not null, "token" varchar not null, "created_at" datetime, primary key ("email"));

-- --------------------------------------------------------
-- Table structure for table `sessions`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE "sessions" ("id" varchar not null, "user_id" integer, "ip_address" varchar, "user_agent" text, "payload" text not null, "last_activity" integer not null, primary key ("id"));

-- Dumping data for table `sessions`

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('AWxQBjzlznRin9tUy79QIQ5gxrhkuUIfo9hpQzcJ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 OPR/132.0.0.0 (Edition ms_store_gx)', 'eyJfdG9rZW4iOiIwQ1VIcE1idkhGS2ZFNm45elJick9yQ04wUUF6bUh6TFZWRW9xOWNtIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOiJ0cmFuc2FjdGlvbnMuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', '1782319558'),
('Jk24rrN38QMZrIo8RMeTFxDy09crvU3jDVQaXjtj', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJqeElYTHE5Z01qV1hRdkxNcGhuRTZqV2xmU1ozZGJQSDBTaXhyWW5ZIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOiJ0cmFuc2FjdGlvbnMuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', '1782318894'),
('OdoLtsnV3rGNgP76ie0TyRElgbykjhGr05XJ2FV7', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.8521', 'eyJfdG9rZW4iOiJ4Znp6SnJudkp1bmFZVUJSY09mWWFoTVdTT01IV1JtTm95WXdGTXFNIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOiJ0cmFuc2FjdGlvbnMuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', '1782318968'),
('NqY6zfk1pGT3998kywcUMa6Zml1LEgU1VQHaqXqO', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.8521', 'eyJfdG9rZW4iOiJrb1UyVHNoRnhZRHljek51aXQzb2FRTTFNSkRqbXFOVW1jbjRPWTFYIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOiJ0cmFuc2FjdGlvbnMuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', '1782318979'),
('wFZ6fVlZf6BX9v8LKbqCohUxLw0AZgv0KCEv0Eji', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.8521', 'eyJfdG9rZW4iOiJiNmFXMXNKZkxaQnNjRUFhNjBXUWZXUEFBVmdWNDh3amFZVTh0aUFsIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOiJ0cmFuc2FjdGlvbnMuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', '1782318993'),
('hYWvqf42XodkCltw878bz7zU78PpEFbraJzp1wB9', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 OPR/132.0.0.0 (Edition ms_store_gx)', 'eyJfdG9rZW4iOiIxWHNQbGtuMGdrQkk3eHRVajU0eVFiZEoyTlZBS1oyMWw5NFZ5NVl4IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOiJ0cmFuc2FjdGlvbnMuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', '1782378321');

-- --------------------------------------------------------
-- Table structure for table `cache`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `cache`;
CREATE TABLE "cache" ("key" varchar not null, "value" text not null, "expiration" integer not null, primary key ("key"));

-- --------------------------------------------------------
-- Table structure for table `cache_locks`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE "cache_locks" ("key" varchar not null, "owner" varchar not null, "expiration" integer not null, primary key ("key"));

-- --------------------------------------------------------
-- Table structure for table `jobs`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE "jobs" ("id" integer primary key autoincrement not null, "queue" varchar not null, "payload" text not null, "attempts" integer not null, "reserved_at" integer, "available_at" integer not null, "created_at" integer not null);

-- --------------------------------------------------------
-- Table structure for table `job_batches`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE "job_batches" ("id" varchar not null, "name" varchar not null, "total_jobs" integer not null, "pending_jobs" integer not null, "failed_jobs" integer not null, "failed_job_ids" text not null, "options" text, "cancelled_at" integer, "created_at" integer not null, "finished_at" integer, primary key ("id"));

-- --------------------------------------------------------
-- Table structure for table `failed_jobs`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE "failed_jobs" ("id" integer primary key autoincrement not null, "uuid" varchar not null, "connection" varchar not null, "queue" varchar not null, "payload" text not null, "exception" text not null, "failed_at" datetime not null default CURRENT_TIMESTAMP);

-- --------------------------------------------------------
-- Table structure for table `wallets`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `wallets`;
CREATE TABLE "wallets" ("id" integer primary key autoincrement not null, "name" varchar not null, "type" varchar not null, "balance" numeric not null default '0', "created_at" datetime, "updated_at" datetime);

-- Dumping data for table `wallets`

INSERT INTO `wallets` (`id`, `name`, `type`, `balance`, `created_at`, `updated_at`) VALUES
('1', 'Dompet Utama', 'Cash', '-300000', '2026-06-24 16:12:20', '2026-06-24 16:31:24'),
('2', 'Rekening Bank', 'Bank', '0', '2026-06-24 16:12:20', '2026-06-24 16:29:50'),
('3', 'E-wallet (Gopay/OVO)', 'E-wallet', '10', '2026-06-24 16:12:20', '2026-06-24 16:17:15');

-- --------------------------------------------------------
-- Table structure for table `categories`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `categories`;
CREATE TABLE "categories" ("id" integer primary key autoincrement not null, "name" varchar not null, "type" varchar not null, "color" varchar, "icon" varchar, "created_at" datetime, "updated_at" datetime);

-- Dumping data for table `categories`

INSERT INTO `categories` (`id`, `name`, `type`, `color`, `icon`, `created_at`, `updated_at`) VALUES
('1', 'Gaji', 'income', NULL, '💰', '2026-06-24 16:12:20', '2026-06-24 16:12:20'),
('2', 'Bonus', 'income', NULL, '🎁', '2026-06-24 16:12:20', '2026-06-24 16:12:20'),
('3', 'Investasi', 'income', NULL, '📈', '2026-06-24 16:12:20', '2026-06-24 16:12:20'),
('4', 'Makanan & Minuman', 'expense', NULL, '🍔', '2026-06-24 16:12:20', '2026-06-24 16:12:20'),
('5', 'Transportasi', 'expense', NULL, '🚗', '2026-06-24 16:12:20', '2026-06-24 16:12:20'),
('6', 'Pendidikan', 'expense', NULL, '📚', '2026-06-24 16:12:20', '2026-06-24 16:12:20'),
('7', 'Tagihan bulanan', 'expense', NULL, '🧾', '2026-06-24 16:12:20', '2026-06-24 16:12:20'),
('8', 'Hiburan', 'expense', NULL, '🎬', '2026-06-24 16:12:20', '2026-06-24 16:12:20'),
('9', 'Belanja', 'expense', NULL, '🛍️', '2026-06-24 16:12:20', '2026-06-24 16:12:20');

-- --------------------------------------------------------
-- Table structure for table `transactions`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE "transactions" ("id" integer primary key autoincrement not null, "type" varchar not null, "amount" numeric not null, "transaction_date" date not null, "description" text, "wallet_id" integer not null, "to_wallet_id" integer, "category_id" integer, "created_at" datetime, "updated_at" datetime, foreign key("wallet_id") references "wallets"("id") on delete cascade, foreign key("to_wallet_id") references "wallets"("id") on delete cascade, foreign key("category_id") references "categories"("id") on delete set null);

-- Dumping data for table `transactions`

INSERT INTO `transactions` (`id`, `type`, `amount`, `transaction_date`, `description`, `wallet_id`, `to_wallet_id`, `category_id`, `created_at`, `updated_at`) VALUES
('1', 'income', '10', '2026-06-24', NULL, '3', NULL, '8', '2026-06-24 16:17:15', '2026-06-24 16:17:15'),
('4', 'income', '10', '2026-06-24', NULL, '2', NULL, '1', '2026-06-24 16:21:46', '2026-06-24 16:21:46'),
('5', 'expense', '10', '2026-06-24', NULL, '2', NULL, '4', '2026-06-24 16:28:48', '2026-06-24 16:28:48'),
('6', 'expense', '200000', '2026-06-24', NULL, '1', NULL, '6', '2026-06-24 16:30:59', '2026-06-24 16:30:59'),
('7', 'expense', '100000', '2026-06-24', NULL, '1', NULL, '8', '2026-06-24 16:31:24', '2026-06-24 16:31:24');

-- --------------------------------------------------------
-- Table structure for table `budgets`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `budgets`;
CREATE TABLE "budgets" ("id" integer primary key autoincrement not null, "category_id" integer not null, "amount" numeric not null, "month" varchar not null, "created_at" datetime, "updated_at" datetime, foreign key("category_id") references "categories"("id") on delete cascade);

