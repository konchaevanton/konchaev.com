<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Lab 14 - Konchaev Blog</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background: #f5f5f5; }
        .nav { background: #333; padding: 15px; margin-bottom: 20px; border-radius: 5px; }
        .nav a { color: white; text-decoration: none; margin-right: 20px; padding: 10px 15px; background: #007bff; border-radius: 3px; }
        .nav a:hover { background: #0056b3; }
        .content { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .card { border: 1px solid #ddd; padding: 20px; margin: 15px 0; border-radius: 5px; background: #fafafa; }
        .card h3 { color: #333; margin-top: 0; }
        .card .meta { color: #666; font-size: 0.9em; margin-bottom: 10px; }
        h1 { color: #2c3e50; border-bottom: 3px solid #3498db; padding-bottom: 10px; }
    </style>
</head>
<body>
    <!-- Навигация с GET-параметрами -->
    <div class="nav">
        <a href="?page=home">Главная</a>
        <a href="?page=blog">Блог</a>
        <a href="?page=about">Об авторе</a>
    </div>

    <div class="content">
        <?php
        // Получаем параметр из URL (по умолчанию 'home')
        $currentPage = $_GET['page'] ?? 'home';

        // Создаём нужный объект в зависимости от параметра
        if ($currentPage === 'blog') {
            $pageObject = new BlogPage();
        } elseif ($currentPage === 'about') {
            $pageObject = new AboutPage();
        } else {
            $pageObject = new Page();
        }

        // Выводим контент страницы
        $pageObject->render();
        ?>
    </div>
</body>
</html>

<?php
// =====================================================
// БАЗОВЫЙ КЛАСС Page
// =====================================================
class Page
{
    private string $name = 'home';
    protected string $template = '
        <h1>Добро пожаловать в мой блог!</h1>
        <p>Это главная страница сайта <strong>Konchaev Blog</strong>.</p>
        <p>Здесь вы найдете интересные статьи о веб-разработке, 
           программировании и технологиях.</p>
        <div class="card">
            <h3>📌 Последние публикации</h3>
            <p>Перейдите в раздел "Блог", чтобы прочитать статьи.</p>
        </div>
    ';

    public function render(): void
    {
        echo $this->template;
    }
}

// =====================================================
// КЛАСС BlogPage (наследуется от Page)
// =====================================================
class BlogPage extends Page
{
    private string $name = 'blog';
    protected string $template = '
        <h1>📝 Мой Блог</h1>
        
        <div class="card">
            <h3>The Best JavaScript and CSS Libraries for 2024</h3>
            <div class="meta">Опубликовано: 3 мая 2024 | Автор: Konchaev</div>
            <p>Обзор лучших библиотек и фреймворков для веб-разработки. 
               Рассматриваем Vue.js, React, Tailwind CSS и другие популярные инструменты.</p>
        </div>

        <div class="card">
            <h3>Основы PHP: Работа с файлами</h3>
            <div class="meta">Опубликовано: 1 мая 2024 | Автор: Konchaev</div>
            <p>Изучаем функции fopen, fwrite, fclose для работы с файлами в PHP. 
               Практические примеры и лучшие практики.</p>
        </div>

        <div class="card">
            <h3>Git и GitHub для начинающих</h3>
            <div class="meta">Опубликовано: 28 апреля 2024 | Автор: Konchaev</div>
            <p>Полное руководство по системе контроля версий Git. 
               Учимся создавать репозитории, коммиты и пул-реквесты.</p>
        </div>
    ';
}

// =====================================================
// КЛАСС AboutPage (наследуется от Page)
// =====================================================
class AboutPage extends Page
{
    private string $name = 'about';
    protected string $template = '
        <h1>👤 Об авторе</h1>
        <div class="card">
            <h3>Кончаев Антон</h3>
            <p><strong>Веб-разработчик</strong></p>
            <p>Привет! Я изучаю PHP и веб-технологии. 
               Веду блог о программировании, делюсь опытом и полезными материалами.</p>
            <p><strong>Навыки:</strong></p>
            <ul>
                <li>PHP, MySQL</li>
                <li>HTML, CSS, JavaScript</li>
                <li>Git, GitHub</li>
                <li>Linux, Nginx</li>
            </ul>
            <p><em>📧 Email: konchaevanton@gmail.com</em></p>
        </div>
    ';
}
?>
