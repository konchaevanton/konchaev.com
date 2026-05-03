<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Lab 12 - Konchaev</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f9f9f9; }
        .task { background: #fff; padding: 15px; margin: 15px 0; border: 1px solid #ddd; border-radius: 5px; }
        .task h2 { margin-top: 0; color: #333; font-size: 1.1rem; }
        .output { background: #f0f0f0; padding: 10px; border-radius: 4px; font-family: monospace; white-space: pre-wrap; }
        .error { color: #d32f2f; background: #ffebee; padding: 6px; border-radius: 3px; }
        .success { color: #388e3c; background: #e8f5e9; padding: 6px; border-radius: 3px; }
        form { margin-top: 10px; }
        input[type="date"] { padding: 5px; margin-right: 5px; }
        button { padding: 6px 12px; cursor: pointer; }
    </style>
</head>
<body>
    <h1>Лабораторная работа №12 - Konchaev</h1>

    <?php
    // ===== ЧАСТЬ 1: ОБРАБОТКА ИСКЛЮЧЕНИЙ =====
    echo "<h2>🔹 Часть 1: Обработка исключений</h2>";

    // Задание 1: Обработка ошибки fopen
    echo "<div class='task'><h2>1. Обработка fopen (несуществующий файл)</h2>";
    try {
        $file = @fopen("nonexistent.txt", "r");
        if (!$file) {
            throw new Exception("Не удалось открыть файл: nonexistent.txt");
        }
        fclose($file);
    } catch (Exception $e) {
        echo "<div class='error'>Исключение: " . $e->getMessage() . "</div>";
    }
    echo "</div>";

    // Задание 2: Деление на ноль -> запись в log.txt
    echo "<div class='task'><h2>2. Деление на ноль (лог в log.txt)</h2>";
    try {
        $a = 10; $b = 0;
        if ($b == 0) {
            throw new Exception("Ошибка: Деление на ноль невозможно!");
        }
        echo "<div class='success'>Результат: " . ($a / $b) . "</div>";
    } catch (Exception $e) {
        $logEntry = date('Y-m-d H:i:s') . " - " . $e->getMessage() . "\n";
        file_put_contents("log.txt", $logEntry, FILE_APPEND);
        echo "<div class='error'>" . $e->getMessage() . " (сообщение записано в log.txt)</div>";
    }
    echo "</div>";

    // Задание 3: Доступ к несуществующему ключу массива
    echo "<div class='task'><h2>3. Доступ к несуществующему элементу массива</h2>";
    $countries = ['Spain' => 'Madrid', 'Russia' => 'Moscow'];
    $searchKey = 'Germany';
    try {
        if (!array_key_exists($searchKey, $countries)) {
            throw new Exception("Ключ '$searchKey' отсутствует в массиве.");
        }
        echo "<div class='success'>Столица: " . $countries[$searchKey] . "</div>";
    } catch (Exception $e) {
        echo "<div class='error'>Исключение: " . $e->getMessage() . "</div>";
    }
    echo "</div>";

    // ===== ЧАСТЬ 2: РАБОТА С ДАТАМИ =====
    echo "<h2>🔹 Часть 2: Работа с датами</h2>";

    // Массив для русских названий дней недели
    $daysRu = ['Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'];

    // Задание 1: Timestamp для 15 марта 2025, 10:25:00
    $ts1 = mktime(10, 25, 0, 3, 15, 2025);
    echo "<div class='task'><h2>1. Timestamp для 15.03.2025 10:25:00</h2>";
    echo "<div class='output'>$ts1</div></div>";

    // Задание 2: Разница в секундах с 02.10.1990 08:05:59
    $ts2 = mktime(8, 5, 59, 10, 2, 1990);
    $diffSec = time() - $ts2;
    echo "<div class='task'><h2>2. Разница в секундах с 02.10.1990 08:05:59</h2>";
    echo "<div class='output'>$diffSec секунд</div></div>";

    // Задание 3: Текущая дата в формате Год.месяц.день Час:Минута:Секунда
    echo "<div class='task'><h2>3. Текущая дата-время</h2>";
    echo "<div class='output'>" . date('Y.m.d H:i:s') . "</div></div>";

    // Задание 4: 1 сентября текущего года
    $sept1 = mktime(0, 0, 0, 9, 1);
    echo "<div class='task'><h2>4. 1 сентября текущего года</h2>";
    echo "<div class='output'>" . date('Y.m.d', $sept1) . "</div></div>";

    // Задание 5: День недели 02.02.2000
    $dowFeb2 = date('w', mktime(0, 0, 0, 2, 2, 2000));
    echo "<div class='task'><h2>5. День недели 02.02.2000</h2>";
    echo "<div class='output'>" . $daysRu[$dowFeb2] . "</div></div>";

    // Задание 6: Массив дней недели, текущий день, день рождения 12.06.2016
    $currentDow = date('w');
    $birthDow   = date('w', mktime(0, 0, 0, 6, 12, 2016));
    echo "<div class='task'><h2>6. Дни недели (массив $week)</h2>";
    echo "<div class='output'>Текущий день: " . $daysRu[$currentDow] . "<br>";
    echo "День рождения (12.06.2016): " . $daysRu[$birthDow] . "</div></div>";

    // Задание 7: Форма для двух дат
    $d1 = $d2 = $cmpRes = "";
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['date1'], $_POST['date2'])) {
        $d1 = $_POST['date1']; $d2 = $_POST['date2'];
        $t1 = strtotime($d1); $t2 = strtotime($d2);
        if ($t1 > $t2) $cmpRes = "Большая дата: $d1";
        elseif ($t2 > $t1) $cmpRes = "Большая дата: $d2";
        else $cmpRes = "Даты равны";
    }
    echo "<div class='task'><h2>7. Сравнение двух дат</h2>";
    echo "<form method='post'>
            <input type='date' name='date1' value='$d1' required>
            <input type='date' name='date2' value='$d2' required>
            <button type='submit'>Сравнить</button>
          </form>";
    if ($cmpRes) echo "<div class='output'>$cmpRes</div>";
    echo "</div>";

    // Задание 8: Преобразование 'Год-месяц-день' -> 'день-месяц-год'
    $src = "2025-12-31";
    $dst = date('d-m-Y', strtotime($src));
    echo "<div class='task'><h2>8. Преобразование формата даты</h2>";
    echo "<div class='output'>Исходная: $src → Результат: $dst</div></div>";

    // Задание 9: Манипуляции с датой '2000.02.03'
    echo "<div class='task'><h2>9. Манипуляции с датой 2000.02.03</h2>";
    $dt = date_create('2000-02-03');
    
    date_modify($dt, '+2 days');
    echo "+2 дня: " . date_format($dt, 'd.m.Y') . "<br>";
    
    date_modify($dt, '+1 month 3 days');
    echo "+1 мес 3 дня: " . date_format($dt, 'd.m.Y') . "<br>";
    
    date_modify($dt, '+1 year');
    echo "+1 год: " . date_format($dt, 'd.m.Y') . "<br>";
    
    date_modify($dt, '-3 days');
    echo "-3 дня: " . date_format($dt, 'd.m.Y') . "<br>";
    echo "</div>";

    // Задание 10: Дней до Нового Года
    $now = new DateTime();
    $ny  = new DateTime(date('Y') . '-12-31');
    if ($now > $ny) $ny->modify('+1 year');
    $daysToNY = $now->diff($ny)->days;
    echo "<div class='task'><h2>10. Дней до Нового Года</h2>";
    echo "<div class='output'>Осталось: $daysToNY дней</div></div>";
    ?>

</body>
</html>
