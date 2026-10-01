<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Результат обработки заказа</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; margin-top: 10px; }
        td { border: 1px solid #999; padding: 6px 12px; vertical-align: top; }
        td.key { background: #f0f0f0; font-weight: bold; width: 280px; }
        .error { color: red; }
    </style>
</head>
<body>

<h2>Данные заказа оборудования</h2>

<?php
function safe($value) {
    return htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
}

$directions = [
    'obshepit'   => 'Оборудование для общепита',
    'torgovoe'   => 'Торговое оборудование',
    'holodilnoe' => 'Холодильное оборудование',
    'kuhonnoe'   => 'Кухонное оборудование',
];

$groups = [
    'pliti'       => 'Плиты',
    'pechi'       => 'Печи',
    'friturnicy'  => 'Фритюрницы',
    'holodilniki' => 'Холодильники',
    'mikseri'     => 'Миксеры',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $fio        = safe($_POST['fio']        ?? '');
    $phone      = safe($_POST['phone']      ?? '');
    $email      = safe($_POST['email']      ?? '');
    $address    = safe($_POST['address']    ?? '');
    $direction  = $_POST['direction']       ?? '';
    $groupEq    = $_POST['group_eq']        ?? '';
    $itemName   = safe($_POST['item_name']  ?? '');
    $itemModel  = safe($_POST['item_model'] ?? '');
    $itemCount  = safe($_POST['item_count'] ?? '');
    $comment    = safe($_POST['comment']    ?? '');

    $directionText = $directions[$direction] ?? 'не выбрано';
    $groupText     = $groups[$groupEq]       ?? 'не выбрано';

    $errors = [];
    if ($fio === '')        $errors[] = 'Не указано ФИО.';
    if ($phone === '')      $errors[] = 'Не указан телефон.';
    if ($email === '')      $errors[] = 'Не указан E-mail.';
    if ($itemName === '')   $errors[] = 'Не указано наименование.';
    if ($itemCount === '')  $errors[] = 'Не указано количество.';

    if (!empty($errors)) {
        echo '<p class="error"><strong>Обнаружены ошибки:</strong></p><ul>';
        foreach ($errors as $e) {
            echo '<li class="error">' . $e . '</li>';
        }
        echo '</ul>';
        echo '<p><a href="form.html">← Вернуться к форме</a></p>';
        exit;
    }

    echo '<table>';
    echo '<tr><td class="key">ФИО</td><td>' . $fio . '</td></tr>';
    echo '<tr><td class="key">Телефон</td><td>' . $phone . '</td></tr>';
    echo '<tr><td class="key">E-mail</td><td>' . $email . '</td></tr>';
    echo '<tr><td class="key">Адрес</td><td>' . nl2br($address) . '</td></tr>';
    echo '<tr><td class="key">Направление</td><td>' . $directionText . '</td></tr>';
    echo '<tr><td class="key">Группа оборудования</td><td>' . $groupText . '</td></tr>';
    echo '<tr><td class="key">Наименование</td><td>' . $itemName . '</td></tr>';
    echo '<tr><td class="key">Модель</td><td>' . $itemModel . '</td></tr>';
    echo '<tr><td class="key">Количество</td><td>' . $itemCount . '</td></tr>';
    echo '<tr><td class="key">Комментарии</td><td>' . nl2br($comment) . '</td></tr>';
    echo '</table>';

} else {
    echo '<p>Форма не была отправлена. Заполните, пожалуйста, ' .
         '<a href="form.html">форму заказа</a>.</p>';
}
?>

<p><a href="form.html">← Вернуться к форме</a></p>

</body>
</html>