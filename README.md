# Stajyer Başvuru Sistemi

Bu proje, bir şirket bünyesinde stajyer başvuru süreçlerini yönetmek amacıyla geliştirilmiş bir web uygulamasıdır. Saf PHP kullanılarak, MVC (Model-View-Controller) mimarisi temel alınarak sıfırdan oluşturulmuştur. Adayların online başvuru yapmasına ve yöneticilerin bu başvuruları kolayca takip edip yönetmesine olanak tanır.

---

## ✨ Özellikler

### Adaylar İçin
- **Kullanıcı Dostu Başvuru Formu:** Sade ve anlaşılır bir arayüz ile kolayca başvuru yapma imkanı.
- **Detaylı Bilgi Girişi:** Kişisel bilgiler, eğitim geçmişi ve ön yazı gibi alanlar.
- **PDF Belge Yükleme:** Zorunlu staj belgesi gibi ek dosyaları PDF formatında sisteme yükleme.

### Yöneticiler İçin
- **Güvenli Yönetici Paneli:** Sabit şifre ile korunan yönetici giriş ekranı.
- **Gelişmiş Dashboard:** Gelen tüm başvuruları listeleyen, modern ve kullanışlı bir arayüz.
- **Arama ve Filtreleme:** Başvuruları ad, e-posta veya başvuru durumuna (Bekliyor, Onaylandı, Reddedildi) göre anında filtreleme.
- **Sayfalama (Pagination):** Çok sayıda başvuru olduğunda sayfalar arasında kolayca gezinme.
- **Detaylı İnceleme:** Her başvurunun tüm detaylarını (ön yazı, iletişim bilgileri vb.) görüntüleme ve yüklenen PDF belgesini indirme.
- **Durum Yönetimi:** Başvuruların durumunu tek tıkla "Onayla" veya "Reddet" olarak güncelleme.
- **Anlık Geri Bildirim:** Yapılan her işlem sonrası (örn: "Durum başarıyla güncellendi!") kullanıcı dostu bildirimler.

---

## 🛠️ Kullanılan Teknolojiler

- **Backend:** PHP 8+ (Framework'süz, saf PHP)
- **Frontend:** HTML5, CSS3, Bootstrap 5
- **Veritabanı:** MySQL
- **Mimari:** MVC (Model-View-Controller)
- **Web Sunucusu:** Apache (XAMPP ile geliştirilmiştir)

---

## 🚀 Kurulum ve Çalıştırma

Bu projeyi yerel makinenizde çalıştırmak için aşağıdaki adımları izleyin.

### 1. Ön Gereksinimler

Bilgisayarınızda XAMPP, WAMP veya MAMP gibi Apache, MySQL ve PHP içeren bir yerel sunucu paketinin kurulu olması gerekmektedir.

### 2. Projeyi Kurma

```bash
# Projeyi klonlayın
git clone https://github.com/kullanici-adiniz/proje-repo-adi.git

# Proje klasörünü htdocs içine taşıyın
# Örnek: C:/xampp/htdocs/stajyer-basvuru-sistemi
```

### 3. Veritabanı Ayarları

1. phpMyAdmin'i açın.
2. `stajyer_db` adında yeni bir veritabanı oluşturun (Karşılaştırma: utf8mb4_general_ci).
3. Oluşturduğunuz veritabanını seçip **SQL** sekmesine gidin ve aşağıdaki kodu çalıştırarak tabloları oluşturun:

```sql
CREATE TABLE `basvurular` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad_soyad` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefon` varchar(20) DEFAULT NULL,
  `universite` varchar(255) DEFAULT NULL,
  `bolum` varchar(255) DEFAULT NULL,
  `on_yazi` text DEFAULT NULL,
  `staj_belgesi_yolu` varchar(255) DEFAULT NULL,
  `durum` enum('Bekliyor','Onaylandı','Reddedildi') NOT NULL DEFAULT 'Bekliyor',
  `basvuru_tarihi` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `yoneticiler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ldap_kullanici_adi` varchar(255) NOT NULL,
  `ad_soyad` varchar(255) NOT NULL,
  `rol` enum('IK','Yonetici') NOT NULL DEFAULT 'Yonetici',
  `son_giris_tarihi` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ldap_kullanici_adi` (`ldap_kullanici_adi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

4. Proje ana dizinindeki `config.php` dosyasını açın ve `database` dizisi altındaki `user` ve `password` bilgilerini kendi yerel MySQL ayarlarınızla güncelleyin.

### 4. Çalıştırma

Tarayıcınızda `http://localhost/proje-klasor-adi/public/` adresine gidin. (Burada proje-klasor-adi, htdocs içine koyduğunuz klasörün adıdır.)

---

## 📖 Kullanım

### Yönetici Girişi

- Adres: `http://localhost/proje-klasor-adi/public/login`
- Kullanıcı Adı: **admin**
- Şifre: **Staj.2025!**

### Aday Başvurusu

Ana sayfadaki "Başvuru Yap" butonunu kullanarak veya doğrudan `http://localhost/proje-klasor-adi/public/basvuru` adresine giderek başvuru formuna ulaşılabilir.

---

## 📂 Proje Yapısı

```
├── app/                  # Uygulamanın çekirdek mantığı
│   ├── Controllers/      # İstekleri karşılayan sınıflar
│   ├── Models/           # Veritabanı işlemlerini yürüten sınıflar
│   ├── Views/            # HTML arayüz dosyaları (Görünümler)
│   │   ├── admin/
│   │   └── partials/
│   └── Core/             # Router, Database gibi temel sistem sınıfları
├── public/               # Dışarıya açık klasör (Document Root)
│   ├── .htaccess         # URL yönlendirme kuralları
│   └── index.php         # Tüm istekleri karşılayan ana dosya (Front Controller)
├── uploads/              # Yüklenen dosyaların saklandığı klasör
├── config.php            # Veritabanı gibi yapılandırma ayarları
├── init.php              # Uygulamayı başlatan, sınıfları yükleyen dosya
└── README.md             # Bu dosya
```

---

## 📄 Lisans

Bu proje MIT Lisansı ile lisanslanmıştır. Detaylar için LICENSE dosyasına göz atın.
