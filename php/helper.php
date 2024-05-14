<?php 

function editPhone($telephone){
  $telephone = trim($telephone);
  $telephone = preg_replace('/[^0-9+]/isu', '', $telephone);

  if (strpos($telephone, '8') !== 0) {
    $telephone = preg_replace('/^(?:\+7|7)/isu', '', $telephone);
    $telephone = '8' . $telephone;
  }
  return $telephone;
}

function tgTech($message) {
  //отправка сообщения в Telegramm tatech_bot
  $tgToken = '5240688586:AAFryqavrQR6DgkhOj-w81zXsf1qUosimFM';
  $chatId = '494087760';

  $url='https://api.telegram.org/bot'.$tgToken.'/sendMessage?chat_id='.$chatId.'&text='.urlencode($message);
  $curl = curl_init(); 
  curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
    CURLOPT_POST => 0,
    CURLOPT_RETURNTRANSFER => 1)
  );
  curl_exec($curl);
  curl_close($curl);
}

// Автолоадер классов 
// https://otezvikentiy.tech/articles/php-autoloader-avtozagruzka-v-php-kak-organizovat-psr-4
function autoloaderFunction(string $class): void
{
    $prefix = 'App\\'; //определяем неймспейс для нашего приложения
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) return;

    $relative_class = substr($class, $len); //определяем класс                            

    $base_dir = __DIR__ . '/src/'; //определяем директорию
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php'; //определяем полный путь до файла

    if (file_exists($file)) { //если файл существует
        require_once $file;   //подключаем
    }
}

spl_autoload_register('autoloaderFunction');


?>