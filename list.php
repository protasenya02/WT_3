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
                    <li <?php if ($_GET['id'] == 2) echo 'class="active"';?>><a class="nav_link" href="list.php?id=2">Список товаров</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>

<!------------------------------Table-------------------------->
<section>
    <div class="container">
        <div class="list_inner">
            <table>
                <thead>
                     <tr>
                        <th>Имена товаров</th>
                        <th>id</th>
                        <th>Название</th>
                        <th>Цена</th>
                        <th>Описание</th>
                        <th>Цена со скидкой 15%</th>
                    </tr>
                <thead>
                <?php
                if (($fp = fopen("list.csv", "r")) !== FALSE) {

                    $counter = 1;

                     while(($data = fgetcsv($fp, 0, ";")) !== FALSE){

                         $discount = (float) ($data[2] * (15 / 100));
                         $data[] =  round($discount,2);

                         foreach ($data as $key => $value):
                                  if ($key == 1) {
                ?>
                           <tr><th ><a href="list.php?id=2&value=<?=$counter?>"><?=$data[$key]?></a></th>
                <?php
                             }
                        endforeach;

                             if($_GET['value'] == $counter) {
                                 foreach ($data as $key => $value) {
                                 ?>
                              <td><?=$data[$key]?></td>
                <?php
                                 }
                             }
                         $counter++;
                    }
                }
                ?>
            </table>
        </div>
    </div>
</section>
</body>
</html>