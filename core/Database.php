<?php

namespace Core;

use PDO;
use PDOException;

class Database {
    private static ?PDO $pdo = null;

    public static function getConnection(): PDO {
        if (self::$pdo === null) {
            $connection = env('DB_CONNECTION', 'sqlite');
            $database = env('DB_DATABASE', __DIR__ . '/../database/database.sqlite');

            if ($connection === 'sqlite') {
                self::$pdo = self::connectSqlite($database);
            } else {
                try {
                    $host = env('DB_HOST', '127.0.0.1');
                    $port = env('DB_PORT', '3306');
                    $dbname = env('DB_DATABASE', 'nyg_transporte');
                    $username = env('DB_USERNAME', 'root');
                    $password = env('DB_PASSWORD', '');

                    $dsn = "mysql:host={$host};port={$port};dbname={$dbname};charset=utf8mb4";
                    self::$pdo = new PDO($dsn, $username, $password, [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    ]);
                } catch (PDOException $e) {
                    // Fallback to local SQLite DB if MySQL is not running or credentials differ
                    self::$pdo = self::connectSqlite(__DIR__ . '/../database/database.sqlite');
                }
            }
        }
        return self::$pdo;
    }

    private static function connectSqlite(string $path): PDO {
        if (!\str_starts_with($path, '/') && !preg_match('/^[A-Za-z]:\\\\/', $path)) {
            $path = __DIR__ . '/../' . $path;
        }
        $dir = dirname($path);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        $pdo = new PDO("sqlite:" . $path, null, null, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
        $pdo->exec("PRAGMA foreign_keys = ON;");
        return $pdo;
    }

    public static function query(string $sql, array $params = []): \PDOStatement {
        $stmt = self::getConnection()->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public static function fetchAll(string $sql, array $params = []): array {
        return self::query($sql, $params)->fetchAll();
    }

    public static function fetchOne(string $sql, array $params = []): ?array {
        $result = self::query($sql, $params)->fetch();
        return $result ?: null;
    }

    public static function execute(string $sql, array $params = []): bool {
        return self::query($sql, $params)->rowCount() > 0;
    }

    public static function lastInsertId() {
        return self::getConnection()->lastInsertId();
    }
}
