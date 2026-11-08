<?php include 'header.php'; ?>

<h2>Анкета клієнта залу</h2>
<form action="process.php" method="POST">
    <p><b>Ваше ім'я:</b> <br><input type="text" name="name" required></p>
    <p><b>Ваш Email:</b> <br><input type="email" name="email" required></p>
    
    <p><b>1. Яка ваша головна мета тренувань?</b><br>
        <select name="goal">
            <option value="Схуднення">Схуднення</option>
            <option value="Набір маси">Набір м'язової маси</option>
            <option value="Підтримка форми">Підтримка форми</option>
        </select>
    </p>
    
    <p><b>2. Скільки разів на тиждень ви тренуєтесь?</b><br>
        <input type="radio" name="freq" value="1-2" required> 1-2 рази <br>
        <input type="radio" name="freq" value="3-4"> 3-4 рази <br>
        <input type="radio" name="freq" value="5+"> 5 і більше <br>
    </p>
    
    <p><b>3. Ваші побажання щодо покращення залу:</b><br>
        <textarea name="wish" rows="4" cols="40"></textarea>
    </p>
    
    <button type="submit" class="btn">Надіслати анкету</button>
</form>

<?php include 'footer.php'; ?>