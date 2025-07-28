<?php
// app/Core/Router.php

namespace App\Core;

class Router {
    // Rotaları saklayacağımız dizi. ['GET' => [...], 'POST' => [...]] yapısında olacak.
    protected $routes = [];

    // Yeni bir GET rotası tanımlamamızı sağlayacak metod.
    public function get($uri, $controllerAction) {
        $this->routes['GET'][$uri] = $controllerAction;
    }

    // Yeni bir POST rotası tanımlamamızı sağlayacak metod.
    public function post($uri, $controllerAction) {
        $this->routes['POST'][$uri] = $controllerAction;
    }

    /**
     * Gelen isteği analiz edip ilgili controller'ı çalıştıran ana metod.
     */
    public function dispatch($uri, $requestMethod) {
        
        // Gelen URI'den sorgu dizesini (?id=5 gibi) ayıklayarak sadece yolu al.
        $uri = parse_url($uri, PHP_URL_PATH);
        
        if (strlen($uri) > 1) {
            $uri = rtrim($uri, '/');
        }

        if (isset($this->routes[$requestMethod]) && array_key_exists($uri, $this->routes[$requestMethod])) {
            
            $action = $this->routes[$requestMethod][$uri];
            
            // --- YENİ EKLENEN KONTROL ---
            // Eğer rota bir fonksiyon (Closure) ise, onu doğrudan çalıştır ve işlemi bitir.
            if (is_callable($action)) {
                call_user_func($action);
                return;
            }
            
            // Eğer bir dizi ise, Controller/metot olarak devam et.
            $controllerName = $action[0];
            $methodName = $action[1];

            $controller = new $controllerName();
            $controller->$methodName();

        } else {
            http_response_code(404);
            echo "404 - Sayfa Bulunamadı";
        }
    }
}