<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Lab 15 - Konchaev</title>
    <style>
        body { font-family: sans-serif; padding: 20px; background: #f8f9fa; }
        h1 { color: #2c3e50; border-bottom: 3px solid #3498db; padding-bottom: 10px; }
        .figure-info { background: #fff; padding: 15px; margin: 15px 0; border-left: 4px solid #3498db; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .area { color: #27ae60; font-weight: bold; font-size: 1.1em; }
        .info { color: #2980b9; }
    </style>
</head>
<body>
    <h1>Лабораторная №15 - Абстрактные классы и интерфейсы</h1>

    <?php
    // =====================================================
    // ИНТЕРФЕЙС AreaInterface
    // Задание 4: Интерфейс с методом getArea
    // =====================================================
    interface AreaInterface
    {
        public function getArea();
    }

    // =====================================================
    // АБСТРАКТНЫЙ КЛАСС Figure
    // Задание 1, 2: Абстрактный класс с абстрактным методом
    // =====================================================
    abstract class Figure
    {
        protected float $area;
        protected string $color;
        protected int $sidesCount;

        public function __construct(string $color)
        {
            $this->color = $color;
        }

        // Задание 2: Абстрактный метод infoAbout()
        abstract public function infoAbout(): string;
    }

    // =====================================================
    // КЛАСС Rectangle (Прямоугольник)
    // Задания 3, 5, 7, 8, 9, 10
    // =====================================================
    class Rectangle extends Figure implements AreaInterface
    {
        private float $a; // длина стороны a
        private float $b; // длина стороны b
        protected int $sidesCount = 4; // Задание 7

        public function __construct(string $color, float $a, float $b)
        {
            parent::__construct($color);
            $this->a = $a;
            $this->b = $b;
        }

        // Задание 9: Реализация метода getArea()
        // Формула: S = a * b
        public function getArea(): float
        {
            $this->area = $this->a * $this->b;
            return $this->area;
        }

        // Задание 10: Метод infoAbout()
        public function infoAbout(): string
        {
            return "Это класс прямоугольника. У него {$this->sidesCount} стороны.";
        }

        // Геттеры для сторон
        public function getSideA(): float
        {
            return $this->a;
        }

        public function getSideB(): float
        {
            return $this->b;
        }
    }

    // =====================================================
    // КЛАСС Square (Квадрат)
    // Задания 3, 6, 7, 8, 9, 10
    // =====================================================
    class Square extends Figure implements AreaInterface
    {
        private float $a; // длина стороны
        protected int $sidesCount = 4; // Задание 7

        public function __construct(string $color, float $a)
        {
            parent::__construct($color);
            $this->a = $a;
        }

        // Задание 9: Реализация метода getArea()
        // Формула: S = a * a
        public function getArea(): float
        {
            $this->area = $this->a * $this->a;
            return $this->area;
        }

        // Задание 10: Метод infoAbout()
        public function infoAbout(): string
        {
            return "Это класс квадрата. У него {$this->sidesCount} стороны.";
        }

        // Геттер для стороны
        public function getSide(): float
        {
            return $this->a;
        }
    }

    // =====================================================
    // КЛАСС Triangle (Треугольник)
    // Задания 3, 7, 8, 9, 10
    // =====================================================
    class Triangle extends Figure implements AreaInterface
    {
        private float $a; // сторона a
        private float $b; // сторона b
        private float $c; // сторона c
        protected int $sidesCount = 3; // Задание 7

        public function __construct(string $color, float $a, float $b, float $c)
        {
            parent::__construct($color);
            $this->a = $a;
            $this->b = $b;
            $this->c = $c;
        }

        // Задание 9: Реализация метода getArea()
        // Формула Герона: S = √(p(p-a)(p-b)(p-c)), где p = (a+b+c)/2
        public function getArea(): float
        {
            $p = ($this->a + $this->b + $this->c) / 2; // полупериметр
            $this->area = sqrt($p * ($p - $this->a) * ($p - $this->b) * ($p - $this->c));
            return $this->area;
        }

        // Задание 10: Метод infoAbout()
        public function infoAbout(): string
        {
            return "Это класс треугольника. У него {$this->sidesCount} стороны.";
        }

        // Геттеры для сторон
        public function getSideA(): float { return $this->a; }
        public function getSideB(): float { return $this->b; }
        public function getSideC(): float { return $this->c; }
    }

    // =====================================================
    // ВЫПОЛНЕНИЕ ЗАДАНИЯ 11, 12: Создание объектов и вывод
    // =====================================================

    echo "<h2>🔷 Прямоугольники (Rectangle)</h2>";

    // Задание 11: Создаем 2 объекта Rectangle
    $rect1 = new Rectangle("синий", 5, 8);
    $rect2 = new Rectangle("красный", 10, 4);

    // Задание 12: Вызываем getArea() и выводим результаты
    echo "<div class='figure-info'>";
    echo "<p class='info'>" . $rect1->infoAbout() . "</p>";
    echo "<p>Стороны: a = " . $rect1->getSideA() . ", b = " . $rect1->getSideB() . "</p>";
    echo "<p class='area'>Площадь: " . $rect1->getArea() . " кв.ед.</p>";
    echo "</div>";

    echo "<div class='figure-info'>";
    echo "<p class='info'>" . $rect2->infoAbout() . "</p>";
    echo "<p>Стороны: a = " . $rect2->getSideA() . ", b = " . $rect2->getSideB() . "</p>";
    echo "<p class='area'>Площадь: " . $rect2->getArea() . " кв.ед.</p>";
    echo "</div>";

    // =====================================================
    echo "<h2>⬜ Квадраты (Square)</h2>";

    // Задание 11: Создаем 2 объекта Square
    $square1 = new Square("зеленый", 6);
    $square2 = new Square("желтый", 10);

    // Задание 12: Вызываем getArea() и выводим результаты
    echo "<div class='figure-info'>";
    echo "<p class='info'>" . $square1->infoAbout() . "</p>";
    echo "<p>Сторона: a = " . $square1->getSide() . "</p>";
    echo "<p class='area'>Площадь: " . $square1->getArea() . " кв.ед.</p>";
    echo "</div>";

    echo "<div class='figure-info'>";
    echo "<p class='info'>" . $square2->infoAbout() . "</p>";
    echo "<p>Сторона: a = " . $square2->getSide() . "</p>";
    echo "<p class='area'>Площадь: " . $square2->getArea() . " кв.ед.</p>";
    echo "</div>";

    // =====================================================
    echo "<h2>🔺 Треугольники (Triangle)</h2>";

    // Задание 11: Создаем 2 объекта Triangle
    $triangle1 = new Triangle("фиолетовый", 3, 4, 5);
    $triangle2 = new Triangle("оранжевый", 6, 8, 10);

    // Задание 12: Вызываем getArea() и выводим результаты
    echo "<div class='figure-info'>";
    echo "<p class='info'>" . $triangle1->infoAbout() . "</p>";
    echo "<p>Стороны: a = " . $triangle1->getSideA() . ", b = " . $triangle1->getSideB() . ", c = " . $triangle1->getSideC() . "</p>";
    echo "<p class='area'>Площадь: " . number_format($triangle1->getArea(), 2) . " кв.ед.</p>";
    echo "</div>";

    echo "<div class='figure-info'>";
    echo "<p class='info'>" . $triangle2->infoAbout() . "</p>";
    echo "<p>Стороны: a = " . $triangle2->getSideA() . ", b = " . $triangle2->getSideB() . ", c = " . $triangle2->getSideC() . "</p>";
    echo "<p class='area'>Площадь: " . number_format($triangle2->getArea(), 2) . " кв.ед.</p>";
    echo "</div>";
    ?>

</body>
</html>
