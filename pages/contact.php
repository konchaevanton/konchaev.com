<?php include '../includes/header.php'; ?>

<main>
    <h1>Контакты</h1>
    <form method="post">
        <input type="text" name="name" placeholder="Имя"><br>
        <input type="email" name="email" placeholder="Email"><br>
        <textarea name="message"></textarea><br>
        <button type="submit">Отправить</button>
    </form>
</main>

<?php include '../includes/footer.php'; ?>
