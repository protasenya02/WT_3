<?php

// add new product to the file
function add_to_file(&$id, &$name, &$price, &$description) {

    $list = array($id, $name, $price, $description);
    $fp = fopen('list.csv', 'a');
    fprintf($fp, chr(0xEF).chr(0xBB).chr(0xBF));
    fputcsv($fp, $list, ';', '"');
    fclose($fp);
}

?>

<!DOCTYPE HTML>
<html lang="ru">
<head>
    <meta charset = "utf-8">
    <link rel = "stylesheet" href = "./assets/css/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@700&family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <title>Информация о товарах</title>
</head>
<body>

<!------------------------------Menu-------------------------->
<header class="header">
    <div class="container">
        <div class="header_inner">
            <div class="header_logo">Информация о товарах</div>
            <nav >
                <ul class="header_nav">
                    <li <?php if($_GET['id'] == 1) echo 'class="active"';?>><a class="nav_link" href="main.php?id=1">Добавить</a></li>
                    <li <?php if ($_GET['id'] == 2) echo 'class="active"';?>><a class="nav_link" href="list.php?id=2&value=0">Список товаров</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>

<!------------------------------Form-------------------------->
<section class="product_form">
    <div class="container">
        <form class="input_form" method="POST">
            <div class="form_inner">
                <div class="form_title">Добавьте новый товар</div>
                <input type="text" pattern="^[ 0-9]+$" name="id" placeholder="id" required>
                <input type="text" pattern="[A-Za-zА-Яа-яЁё ]+$" name="name" placeholder="Название" required>
                <input type="number" step="any" name="price" placeholder="Цена" required>
                <textarea name="description" cols="39" rows="3" placeholder="Описание" required></textarea>
                <input type="submit" name="add" value="Добавить">

                <?php

                    if (isset($_POST['add'])) {

                        $id = $_POST['id'];
                        $name = $_POST['name'];
                        $price = $_POST['price'];
                        $description = $_POST['description'];
                        add_to_file($id, $name, $price, $description);
                        header('Location: '.$_SERVER['PHP_SELF']);
                    }
                    ?>

            </div>
        </form>
    </div>
</section>
</body>
</html>