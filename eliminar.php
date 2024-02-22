<?php

require 'productos.php';

$res = new Productos();
$codigo = filter_input(INPUT_GET, 'codigo');
$res->delete_productos($codigo);

header("Location:index.php");
