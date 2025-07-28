<?php
// app/Controllers/AuthController.php

namespace App\Controllers;

class AuthController extends BaseController {

    /**
     * Yönetici giriş formunu gösterir.
     */
    public function loginPage() {
        // Session'da olası bir hata mesajı varsa alıp View'e gönderiyoruz.
        $error = $_SESSION['login_error'] ?? null;
        // Mesajı gösterdikten sonra session'dan siliyoruz ki tekrar görünmesin.
        unset($_SESSION['login_error']);

        $this->view('login', [
            'pageTitle' => 'Yönetici Girişi',
            'error' => $error
        ]);
    }

    /**
     * Formdan gelen giriş bilgilerini LDAP ile doğrular.
     */
    public function handleLogin() {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        // Sabit olarak belirlediğimiz kullanıcı adı ve şifre ile kontrol et
            if ($username === 'admin' && $password === '123456') {
                
                // Başarılı giriş! Oturum (Session) bilgilerini ayarla.
                $_SESSION['user'] = 'Admin Kullanıcısı';
                $_SESSION['is_logged_in'] = true;
                
                // Başarılı giriş sonrası yönetici paneline yönlendir.
                header('Location: /stajyer-basvuru-sistemi/public/admin/dashboard');
                exit();

            } else {
                // Başarısız giriş. Hata mesajı oluştur ve giriş sayfasına geri yönlendir.
                $_SESSION['login_error'] = 'Kullanıcı adı veya şifre hatalı.';
                header('Location: /stajyer-basvuru-sistemi/public/login');
                exit();
    }
    }
    public function logout() {
        session_unset();
        session_destroy();
        header('Location: /stajyer-basvuru-sistemi/public/login');
        exit();
    }
}