<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Валидация формы</title>
</head>
<body>

    <h2>Форма валидации</h2>

    <!-- Форма для ввода имени, email и телефона -->
    <form action="" method="POST">
        <label for="name">Имя:</label><br>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="phone">Номер телефона:</label><br>
        <input type="text" id="phone" name="phone" required><br><br>

        <input type="submit" value="Отправить">
    </form>

    <!-- PHP-скрипт для обработки формы -->
    <?php
    // Проверяем, существует ли ключ 'REQUEST_METHOD' и является ли он 'POST'
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        // Получение данных из формы
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $phone = $_POST['phone'] ?? '';
    
        // Функция валидации
        function validateForm($name, $email, $phone) {
            if (empty($name)) {
                return "Ошибка: Поле 'Имя' не должно быть пустым.";
            }
            if (strlen($name) < 3 || strlen($name) > 50) {
                return "Ошибка: Длина имени должна быть от 3 до 50 символов.";
            }
    
            if (empty($email)) {
                return "Ошибка: Поле 'Email' не должно быть пустым.";
            }
            if (strlen($email) > 100) {
                return "Ошибка: Email не должен превышать 100 символов.";
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return "Ошибка: Некорректный формат email.";
            }
    
            if (empty($phone)) {
                return "Ошибка: Поле 'Номер телефона' не должно быть пустым.";
            }
            if (strlen($phone) != 10) {
                return "Ошибка: Номер телефона должен содержать 10 цифр.";
            }
            if (!ctype_digit($phone)) {
                return "Ошибка: Номер телефона должен состоять только из цифр.";
            }
    
            return "Форма успешно валидирована!";
        }
    
        // Вызов функции валидации и вывод результата
        $result = validateForm($name, $email, $phone);
        echo "<p>$result</p>";
    } else {
        echo "Форма не была отправлена.";
    }
    ?>
    


</body>
</html>
