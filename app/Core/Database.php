<?php
// app/Core/Database.php

namespace App\Core;

// PHP'nin veritabanı işlemleri için kullandığı PDO sınıfını kullanacağımızı belirtiyoruz.
use PDO;
use PDOException;

class Database {
    private static $instance = null;
    private $pdo;

    // Sınıf dışından new Database() ile nesne oluşturulmasını engelliyoruz (private).
    private function __construct() {
        // config.php dosyasındaki ayarları alıyoruz.
        $config = require __DIR__ . '/../../config.php';
        $db_config = $config['database'];

        // DSN (Data Source Name) string'ini oluşturuyoruz.
        $dsn = "mysql:host={$db_config['host']};dbname={$db_config['dbname']};charset={$db_config['charset']}";

        // PDO bağlantı seçenekleri
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Hataları istisna olarak yakala
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Sonuçları anahtar-değer dizisi olarak al
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            // PDO nesnesini oluşturarak bağlantıyı kuruyoruz.
            $this->pdo = new PDO($dsn, $db_config['user'], $db_config['password'], $options);
        } catch (PDOException $e) {
            // Bağlantı başarısız olursa, hatayı göster ve programı durdur.
            // (Gerçek bir projede burada loglama yapılır ve kullanıcı dostu bir hata sayfası gösterilir)
            die("Veritabanına bağlanılamadı: " . $e->getMessage());
        }
    }

    /**
     * Singleton deseni için tek bir 'instance' (örnek) döndüren metod.
     * Eğer daha önce bağlantı kurulmadıysa kurar, kurulduysa mevcut olanı döndürür.
     */
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Diğer sınıfların PDO bağlantı nesnesine erişmesi için bir metod.
     */
    public function getConnection() {
        return $this->pdo;
    }
}