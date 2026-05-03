<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Lab 10 - Konchaev</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <!-- Блок Регистрации -->
        <h2>📝 Регистрация</h2>
        <form action="action.php" method="post">
            <div class="form-group"><label>Имя:</label><input type="text" name="name"></div>
            <div class="form-group"><label>Email:</label><input type="email" name="email"></div>
            <div class="form-group"><label>Пароль:</label><input type="password" name="password"></div>
            <div class="form-group">
                <label>Пол:</label>
                <select name="gender">
                    <option value="male">Мужской</option>
                    <option value="female">Женский</option>
                    <option value="other">Другой</option>
                </select>
            </div>
            <button type="submit" class="btn">Зарегистрироваться</button>
        </form>

        <hr>

        <!-- Блок Калькулятора -->
        <h2>🧮 Калькулятор</h2>
        <form action="index.php" method="post">
            <div class="form-group"><label>Число 1:</label><input type="number" name="num1" step="any" required></div>
            <div class="form-group"><label>Число 2:</label><input type="number" name="num2" step="any" required></div>
            <div style="display: flex; gap: 8px;">
                <button type="submit" name="action" value="add" class="btn-calc">+</button>
                <button type="submit" name="action" value="sub" class="btn-calc">−</button>
                <button type="submit" name="action" value="mul" class="btn-calc">×</button>
                <button type="submit" name="action" value="div" class="btn-calc">÷</button>
            </div>
        </form>

        <?php
        if (isset($_POST['action'])) {
            $n1 = (float)$_POST['num1'];
            $n2 = (float)$_POST['num2'];
            $op = $_POST['action'];
            $res = 0; $err = "";

            switch ($op) {
                case 'add': $res = $n1 + $n2; break;
                case 'sub': $res = $n1 - $n2; break;
                case 'mul': $res = $n1 * $n2; break;
                case 'div':
                    if ($n2 == 0) { $err = "❌ Ошибка: Деление на ноль!"; }
                    else { $res = $n1 / $n2; }
                    break;
            }
            if (!$err) { echo "<div class='result'>✅ Результат: <b>$res</b></div>"; }
            else { echo "<div class='error'>$err</div>"; }
        }
        ?>
        <style>
            .btn-calc { flex:1; padding:12px; background:#3498db; color:#fff; border:none; border-radius:5px; font-size:18px; cursor:pointer; }
            .btn-calc:hover { background:#2980b9; }
        </style>
    </div>
</body>
</html>
