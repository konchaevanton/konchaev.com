<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Lab 13 - Konchaev</title>
    <style>
        body { font-family: sans-serif; padding: 20px; background: #f8f9fa; }
        h1 { color: #2c3e50; }
        .task { background: #fff; padding: 15px; margin: 15px 0; border-left: 4px solid #3498db; border-radius: 4px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .task h2 { margin: 0 0 10px 0; font-size: 1.1rem; color: #2980b9; }
        .output { background: #e8f5e9; padding: 10px; border-radius: 4px; margin-top: 8px; font-family: monospace; }
        .error { background: #ffebee; color: #c62828; padding: 10px; border-radius: 4px; margin-top: 8px; }
        code { background: #eee; padding: 2px 5px; border-radius: 3px; }
    </style>
</head>
<body>
    <h1>Лабораторная №13 - Объекты (ООП)</h1>

    <?php
    // =========================================================
    // КЛАСС WORKER (Итоговая версия, покрывает задания 3-10)
    // =========================================================
    class Worker {
        public $name;   // Имя (публичное)
        public $salary; // Зарплата (публичное)
        private $age;   // Задание 7: свойство age сделано скрытым (private)

        // Задание 3: метод getName()
        public function getName() {
            return $this->name;
        }

        // Задание 4: метод getAge()
        public function getAge() {
            return $this->age;
        }

        // Задание 5: метод getSalary()
        public function getSalary() {
            return $this->salary;
        }

        // Задание 9 и 10: метод checkAge()
        // В задании 10 он сделан private и используется внутри setAge()
        private function checkAge($age) {
            return $age >= 18;
        }

        // Задания 7, 8, 10: метод setAge() с валидацией
        public function setAge($newAge) {
            // Задание 10: обращаемся к приватному checkAge()
            if ($this->checkAge($newAge)) {
                $this->age = $newAge;
            } else {
                echo "<div class='error'>❌ Вам работать в нашей компании еще рано (возраст: $newAge)</div>";
            }
        }
    }

    // =========================================================
    // ВЫПОЛНЕНИЕ ЗАДАНИЙ (Вывод на экран по пунктам)
    // =========================================================

    // --- Задание 1 ---
    echo "<div class='task'><h2>Задание 1: Создание объектов и установка свойств</h2>";
    $worker1 = new Worker();
    $worker2 = new Worker();

    // Устанавливаем свойства (age через setAge, т.к. оно private)
    $worker1->name = "Кончаев Антон";
    $worker1->salary = 120000;
    $worker1->setAge(20);

    $worker2->name = "Иванов Иван";
    $worker2->salary = 85000;
    $worker2->setAge(25);

    echo "<div class='output'>Объект 1 создан: " . $worker1->getName() . "</div>";
    echo "<div class='output'>Объект 2 создан: " . $worker2->getName() . "</div></div>";

    // --- Задание 2 ---
    echo "<div class='task'><h2>Задание 2: Сумма зарплат и возрастов</h2>";
    $sumSalary = $worker1->getSalary() + $worker2->getSalary();
    $sumAge    = $worker1->getAge() + $worker2->getAge();
    echo "<div class='output'>Сумма зарплат: $sumSalary руб.<br>Сумма возрастов: $sumAge лет</div></div>";

    // --- Задание 3 ---
    echo "<div class='task'><h2>Задание 3: Метод getName()</h2>";
    echo "<div class='output'>Имя работника 1: " . $worker1->getName() . "</div></div>";

    // --- Задание 4 ---
    echo "<div class='task'><h2>Задание 4: Метод getAge()</h2>";
    echo "<div class='output'>Возраст работника 1: " . $worker1->getAge() . " лет</div></div>";

    // --- Задание 5 ---
    echo "<div class='task'><h2>Задание 5: Метод getSalary()</h2>";
    echo "<div class='output'>Зарплата работника 1: " . $worker1->getSalary() . " руб.</div></div>";

    // --- Задание 6 ---
    echo "<div class='task'><h2>Задание 6: Сумма зарплат через метод getSalary()</h2>";
    echo "<div class='output'>Сумма: " . ($worker1->getSalary() + $worker2->getSalary()) . " руб.</div></div>";

    // --- Задание 7 ---
    echo "<div class='task'><h2>Задание 7: Свойство age сделано private, создан setAge()</h2>";
    echo "<div class='output'>✅ Свойство <code>\$age</code> объявлено как <code>private</code>.<br>Прямое обращение <code>\$worker->age</code> вызовет ошибку. Изменение возможно только через <code>setAge()</code>.</div></div>";

    // --- Задание 8 ---
    echo "<div class='task'><h2>Задание 8: Валидация возраста в setAge() (>= 18)</h2>";
    echo "<p>Попытка установить возраст 16 лет:</p>";
    $worker3 = new Worker();
    $worker3->name = "Тест";
    $worker3->salary = 50000;
    $worker3->setAge(16); // Выведет сообщение об ошибке
    echo "<p>Попытка установить возраст 20 лет:</p>";
    $worker3->setAge(20); // Успешно
    echo "<div class='output'>Установленный возраст: " . $worker3->getAge() . " лет</div></div>";

    // --- Задание 9 ---
    echo "<div class='task'><h2>Задание 9: Метод checkAge()</h2>";
    echo "<div class='output'>✅ Метод <code>checkAge($age)</code> создан. Возвращает <code>true</code>, если возраст >= 18, иначе <code>false</code>.<br>(Используется внутри класса для валидации)</div></div>";

    // --- Задание 10 ---
    echo "<div class='task'><h2>Задание 10: checkAge() сделан private, setAge() имеет к нему доступ</h2>";
    echo "<div class='output'>✅ Метод <code>checkAge()</code> изменён на <code>private</code>.<br>Публичный метод <code>setAge()</code> вызывает его для проверки перед записью.<br>Внешний код не может вызвать <code>checkAge()</code> напрямую.</div></div>";
    ?>

</body>
</html>
