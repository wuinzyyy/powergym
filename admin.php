<?php
session_start();

// Дані для входу адміністратора
$admin_login = "admin";
$admin_pass = "1111";

// Обробка логіну
if (isset($_POST['login'])) {
    if ($_POST['user'] == $admin_login && $_POST['pass'] == $admin_pass) {
        $_SESSION['logged_in'] = true;
    } else {
        $error = "Невірний логін або пароль!";
    }
}

// Обробка виходу
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: admin.php");
    exit;
}

// Видалення анкети
if (isset($_GET['delete']) && isset($_SESSION['logged_in'])) {
    $file = "survey/" . basename($_GET['delete']);
    if (file_exists($file)) {
        unlink($file);
    }
    header("Location: admin.php");
    exit;
}

include 'header.php';

if (!isset($_SESSION['logged_in'])) {
    // Форма входу, якщо не авторизовані
    echo "<h2>Вхід в адмін-панель</h2>";
    if (isset($error)) echo "<p style='color:red;'>$error</p>";
    echo "<form method='POST'>
            <p>Логін: <input type='text' name='user'></p>
            <p>Пароль: <input type='password' name='pass'></p>
            <button type='submit' name='login' class='btn'>Увійти</button>
          </form>";
} else {
    // Таблиця результатів, якщо авторизовані
    echo "<h2>Відповіді користувачів</h2>";
    echo "<a href='?logout=1' class='btn' style='background-color:#e74c3c;'>Вийти з адмінки</a><br><br>";
    
    $files = glob("survey/*.json");
    if (count($files) > 0) {
        echo "<table border='1' width='100%' style='border-collapse: collapse; text-align: left;'>";
        echo "<tr style='background-color:#2c3e50; color:white;'>
                <th>Дата</th><th>Ім'я</th><th>Email</th><th>Мета</th><th>Частота</th><th>Побажання</th><th>Дія</th>
              </tr>";
        
        foreach ($files as $file) {
            $data = json_decode(file_get_contents($file), true);
            echo "<tr>";
            echo "<td>{$data['time']}</td>";
            echo "<td>{$data['name']}</td>";
            echo "<td>{$data['email']}</td>";
            echo "<td>{$data['goal']}</td>";
            echo "<td>{$data['freq']}</td>";
            echo "<td>{$data['wish']}</td>";
            echo "<td><a href='?delete=" . basename($file) . "' style='color:red; font-weight:bold;'>Видалити</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Поки немає жодної анкети.</p>";
    }
}

include 'footer.php';
?>