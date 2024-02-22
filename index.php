<!DOCTYPE html>

<?php
require 'productos.php';
$productos = new Productos();
$lista_productos = $productos->get_productos();
?>

<html>

<head>
    <meta charset="UTF-8">
    <title>Gestor de Productos</title>

    <?php include 'style.php'; ?>
</head>

<body class="container">
    <div class="div-title mt-5 mx-5">
        <h1><a href="index.php" class="a-disable">Administrar Productos</a></h1>
        <a href="agregar.php"><button class="btn btn-success">Agregar Nuevo Producto</button></a>
    </div>

    <hr>

    <form method="post">
        <div class="input-group">
            <input type="text" id="input-search" name="input-search" class="form-control"
                placeholder="Buscar un producto" autofocus>
            <button type="submit" class="btn btn-info">Buscar</button>
        </div>
    </form>

    <?php
    $search = filter_input(INPUT_POST, 'input-search');
    if (isset($search)) {
        $lista_productos = $productos->get_producto_name($search);
    }
    ?>

    <hr>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Código</th>
                <th scope="col">Producto</th>
                <th scope="col">Categoría</th>
                <th scope="col">Stock</th>
                <th scope="col">Precio</th>
                <th scope="col">Acciones</th>

            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php
            foreach ($lista_productos as $row) {
                echo "<tr>";
                echo "<th scope='row'>" . $row['id'] . "</th>";
                echo "<td>" . $row['nombre'] . "</td>";
                echo "<td>" . $row['categoria'] . "</td>";
                echo "<td>" . $row['stock'] . "</td>";
                echo "<td>" . $row['precio'] . "</td>";
                echo "<td>";
                echo "<a href='editar.php?codigo=" . $row['id'] . "' class='btn btn-warning'>Editar</a>";
                echo "<span> </span>";
                echo "<a href='eliminar.php?codigo=" . $row['id'] . "' class='btn btn-danger'>Eliminar</a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>