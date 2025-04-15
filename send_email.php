<?php
// Замените на свои данные
$to = "kns@10trest.ru"; //  Ваш email адрес
$botToken = "7842127353:AAGQEqt_zCAaHkJrUoijxsf5hOZDR9xx_ik"; // Токен вашего Telegram-бота
$chatId = "919745232"; // ID вашего Telegram-чата

// Получаем данные из формы
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$task = $_POST['task'];

// Формируем текст сообщения для email
$subject = "Новое техзадание с сайта!";
$message = "Имя: " . $name . "\n";
$message .= "Email: " . $email . "\n";
$message .= "Телефон: " . $phone . "\n";
$message .= "Техзадание: " . $task . "\n";

// Формируем текст сообщения для Telegram
$telegramMessage = "<b>Новое техзадание с сайта!</b>\n";
$telegramMessage .= "<b>Имя:</b> " . htmlspecialchars($name) . "\n"; // Используем htmlspecialchars для безопасности
$telegramMessage .= "<b>Email:</b> " . htmlspecialchars($email) . "\n";
$telegramMessage .= "<b>Телефон:</b> " . htmlspecialchars($phone) . "\n";
$telegramMessage .= "<b>Техзадание:</b> " . htmlspecialchars($task) . "\n";

// Отправляем email
$headers = "From: " . $email . "\r\n";
$headers .= "Reply-To: " . $email . "\r\n";
$headers .= "Content-type: text/plain; charset=UTF-8\r\n"; // Важно для корректной кодировки

if (mail($to, $subject, $message, $headers)) {
    $emailResult = "Письмо успешно отправлено!";
} else {
    $emailResult = "Ошибка при отправке письма!";
}

// Отправляем сообщение в Telegram
$telegramUrl = "https://api.telegram.org/bot" . $botToken . "/sendMessage?chat_id=" . $chatId . "&parse_mode=HTML&text=" . urlencode($telegramMessage);
$telegramResult = file_get_contents($telegramUrl);

// Проверяем результат отправки в Telegram
if ($telegramResult) {
    $telegramResult = "Сообщение в Telegram успешно отправлено!";
} else {
    $telegramResult = "Ошибка при отправке сообщения в Telegram!";
}


// Возвращаем сообщение пользователю (JSON-формат)
header('Content-Type: text/html; charset=utf-8');
echo "Спасибо за ваше сообщение! Мы свяжемся с вами в ближайшее время.";


?>
