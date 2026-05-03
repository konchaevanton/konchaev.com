<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Lab 11 - Konchaev</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        .task { border: 1px solid #ccc; padding: 15px; margin: 15px 0; border-radius: 5px; background: #f9f9f9; }
        .success { color: green; font-weight: bold; }
        .info { color: blue; }
    </style>
</head>
<body>
    <h1>Лабораторная №11 - Работа с файлами</h1>
    <p class="info">Если видите ошибки, удалите старые папки/файлы из папки сайта и обновите страницу.</p>

<?php
// ===== ЧАСТЬ 1: РАБОТА С ФАЙЛАМИ =====

echo "<h2>Часть 1</h2>";

// 1. Создайте файл 'test.txt' и запишите в него фразу 'Привет, мир!'
$file = fopen("test.txt", "w");
fwrite($file, "Привет, мир!");
fclose($file);
echo "<div class='task'>1. Файл test.txt создан. <span class='success'>✔</span></div>";

// 2. Считайте данные из файла 'test.txt' и выведите их на экран
echo "<div class='task'>2. Содержимое test.txt: ";
$f_read = fopen("test.txt", "r");
echo fgets($f_read);
fclose($f_read);
echo " <span class='success'>✔</span></div>";

// 3. Переименуйте файл 'test.txt' в 'mir.txt'
rename("test.txt", "mir.txt");
echo "<div class='task'>3. test.txt переименован в mir.txt. <span class='success'>✔</span></div>";

// 4. Создайте папку 'folder' и переместите файл 'mir.txt' в эту папку
mkdir("folder");
rename("mir.txt", "folder/mir.txt");
echo "<div class='task'>4. Создана папка 'folder', файл перемещен внутрь. <span class='success'>✔</span></div>";

// 5. Создайте копию файла 'mir.txt' и назовите ее 'world.txt'
copy("folder/mir.txt", "folder/world.txt");
echo "<div class='task'>5. Создана копия world.txt внутри папки. <span class='success'>✔</span></div>";

// 6. Определите размер файла 'world.txt'
$bytes = filesize("folder/world.txt");
$mb = $bytes / (1024 * 1024);
$gb = $bytes / (1024 * 1024 * 1024);

echo "<div class='task'>6. Размер world.txt: <br>";
echo "Байты: $bytes bytes<br>";
echo "Мегабайты: " . number_format($mb, 10) . " MB<br>";
echo "Гигабайты: " . number_format($gb, 10) . " GB";
echo " <span class='success'>✔</span></div>";

// 7. Удалите файл 'world.txt'
unlink("folder/world.txt");
echo "<div class='task'>7. world.txt удален. <span class='success'>✔</span></div>";

// 8. Проверьте существование файлов 'world.txt' и 'mir.txt'
$existWorld = file_exists("folder/world.txt") ? "Существует" : "Удален";
$existMir = file_exists("folder/mir.txt") ? "Существует" : "Удален";

echo "<div class='task'>8. Проверка существования:<br>";
echo "world.txt: $existWorld <br>";
echo "mir.txt: $existMir";
echo " <span class='success'>✔</span></div>";


// ===== ЧАСТЬ 2: РАБОТА С ПАПКАМИ =====

echo "<h2>Часть 2</h2>";

// 1. Создайте папку 'test'
mkdir("test");
echo "<div class='task'>1. Папка test создана. <span class='success'>✔</span></div>";

// 2. Переименуйте папку 'test' на 'www'
rename("test", "www");
echo "<div class='task'>2. Папка переименована в www. <span class='success'>✔</span></div>";

// 3. Удалите папку 'www'
rmdir("www");
echo "<div class='task'>3. Папка www удалена. <span class='success'>✔</span></div>";

// 4. Дан массив со строками. Создайте в папке 'test' папки по названиям
$folders = ["docs", "images", "logs"];
mkdir("test"); // Создаем заново для задания

foreach ($folders as $dir_name) {
    mkdir("test/" . $dir_name);
}
echo "<div class='task'>4. В папке test созданы подпапки: " . implode(", ", $folders) . ". <span class='success'>✔</span></div>";

// 5. Выведите все файлы с расширением jpg из текущей папки
// Для теста создадим один jpg файл (чтобы было что найти)
touch("test_image.jpg");

$jpgFiles = glob("*.jpg");
echo "<div class='task'>5. Файлы .jpg в текущей папке:<br>";
if (count($jpgFiles) > 0) {
    foreach ($jpgFiles as $jpg) {
        echo "- $jpg<br>";
    }
} else {
    echo "Не найдено.";
}
echo " <span class='success'>✔</span></div>";

?>
</body>
</html>
