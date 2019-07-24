# Hamo
Простой PHP класс для работы с Webhook QIWI

<p align="center">
<img src="https://img.shields.io/badge/php-v7.3-green.svg" alt="PHP version">
<img src="https://img.shields.io/badge/release-0.5%20beta-green.svg" alt="Latest Stable Version">
<img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License">
</p> 

### Подключение
```php
require_once 'Hamo.php'; // Подключаем класс
```

### Примеры использования
```php
    require_once 'Hamo.php'; // Подключаем класс
    
    $hamo = new Hamo($token); // $token - токен QIWI
    
    # Установить webhook
    $urlHook = 'http://example.ru';
    echo $hamo->setHook($urlHook,1);
    
    # Получить данные об активнoм webhook
    echo $hamo->getHook();
    
    # Удалить текущий webhook
    $json = $hamo->getHook();
    $json = json_decode($json,true);
    $hookId = $json["hookId"];
    echo $hamo->delHook($hookId);
    
    # Получение секретного ключа
    $json = $hamo->getHook();
    $json = json_decode($json,true);
    $hookId = $json["hookId"];   
    echo $hamo->getKey($hookId);
    
    # Обновление секретного ключа
    $json = $hamo->getHook();
    $json = json_decode($json,true);
    $hookId = $json["hookId"];   
    echo $hamo->newKey($hookId);
```
### Поддержка
Если у вас возникли вопросы, пишите нам Вконтакте: https://vk.com/eslavon
