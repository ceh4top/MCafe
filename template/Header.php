<?php
/**
 * Created by PhpStorm.
 * User: CEH4TOP
 * Date: 11.02.2018
 * Time: 20:45
 */
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/IMAGE/system/mcafe.png" type="image/png">
    <title><?=$title;?></title>
    <?=Html::Styles();?>
</head>
<body>
<header>
    <div class="container">
        <img class="Logo" src="/IMAGE/system/mcafe.png">
        <div class="right Menu">
            <a class="element active" data-name="Home" onclick="Go('Home');">Главная</a>
            <a class="element" data-name="Banquet" onclick="Go('Banquet');">Банкеты</a>
            <a class="element" data-name="Menu" onclick="Go('Menu');">Меню</a>
            <a class="element" data-name="Contacts" onclick="Go('Contacts');">Контакты</a>
        </div>
    </div>
</header>