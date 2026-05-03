<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Результат - Konchaev</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Результат отправки формы</h2>
        
        <?php
        // Проверяем, переданы ли обязательные поля
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $email = htmlspecialchars($_POST['email']);
            $name = htmlspecialchars($_POST['name'] ?? 'Не указано');
            
            echo "<div class='result'>";
            echo "<p>✅ Данные успешно получены!</p>";
            echo "<p><b>Имя:</b> $name</p>";
            echo "<p><b>Email:</b> $email</p>";
            
            if (!empty($_POST['gender'])) {
                $gender = htmlspecialchars($_POST['gender']);
                $genderText = ['male' => 'Мужской', 'female' => 'Женский', 'other' => 'Другой'];
                echo "<p><b>Пол:</b> " . ($genderText[$gender] ?? $gender) . "</p>";
            }
            echo "</div>";
            echo "<p><a href='index.php'>← Вернуться к форме</a></p>";
        } else {
            echo "<div class='error'>❌ Ошибка: Не переданы обязательные поля!</div>";
            echo "<p><a href='index.php'>← Вернуться назад</a></p>";
        }
        ?>
    </div>
</body>
</html>
