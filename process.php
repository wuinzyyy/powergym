<?php include 'header.php'; ?>

<h2>Результат відправки</h2>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Збираємо дані в масив
    $data = [
        "name" => htmlspecialchars($_POST['name']),
        "email" => htmlspecialchars($_POST['email']),
        "goal" => $_POST['goal'],
        "freq" => $_POST['freq'],
        "wish" => htmlspecialchars($_POST['wish']),
        "time" => date("Y-m-d H:i:s") // Фіксуємо час
    ];
    
    // Перетворюємо в JSON
    $json_data = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    
    // Формуємо ім'я файлу з датою і часом
    $filename = "survey/answer_" . date("Y_m_d_H_i_s") . ".json";
    
    // Якщо папки survey немає - створюємо її
    if (!is_dir('survey')) {
        mkdir('survey');
    }
    
    // Зберігаємо файл
    file_put_contents($filename, $json_data);
    
    echo "<p>Дякуємо, <b>" . $data['name'] . "</b>! Вашу анкету успішно збережено.</p>";
    echo "<p>Час та дата заповнення: <b>" . $data['time'] . "</b></p>";
} else {
    echo "<p style='color:red;'>Помилка відправки форми.</p>";
}
?>

<?php include 'footer.php'; ?>