<!DOCTYPE html>

<?php
require 'Productos.php';
$productos = new Productos();

$codigo = filter_input(INPUT_GET, 'codigo');
$producto = $productos->get_producto_id($codigo);
?>

<html>

<head>
  <meta charset="UTF-8">
  <title>Editor de Productos</title>

  <?php include 'style.php'; ?>
</head>

<body class="container">
  <div class="div-title mt-5 mx-5">
    <h1><a href="index.php" class="a-disable">Editar Nuevo Producto</a></h1>
    <a href="index.php"><button class="btn btn-success">Lista de productos</button></a>
  </div>

  <hr>

  <?php
  $id = $codigo;
  $nombre = filter_input(INPUT_POST, 'nombre');
  $categoria = filter_input(INPUT_POST, 'categoria');
  $precio = filter_input(INPUT_POST, 'precio');
  $stock = filter_input(INPUT_POST, 'stock');

  $boton = filter_input(INPUT_POST, 'actualizar');
  if (isset($boton)) {
    $productos->put_producto_id($id, $nombre, $categoria, $precio, $stock);
    header('Location: index.php');
  }
  ?>

  <form method="post">
    <div class="form-group">
      <label for="inputCode" class="form-label">Código</label>
      <input type="number" id="inputCode" name="codigo" class="form-control" placeholder="0001" min="1"
        value="<?php echo $producto['id'] ?>" disabled readonly>
    </div>

    <div class="form-group">
      <label for="inputName" class="form-label">Nombre</label>
      <input type="text" id="inputName" name="nombre" class="form-control" placeholder="Sal de Mesa"
        value="<?php echo $producto['nombre'] ?>" required>
    </div>

    <div class="form-group">
      <label for="inputCategory" class="form-label">Categoría</label>
      <input type="text" id="inputCategory" name="categoria" class="form-control" placeholder="Especias"
        value="<?php echo $producto['categoria'] ?>" required>

    </div>

    <div class="form-group row g-3">
      <div class="col-sm-6">
        <label for="inputPrice" class="form-label">Precio</label>
        <input type="number" id="inputPrice" name="precio" class="form-control" placeholder="1.00" min="1" step=".25"
          value="<?php echo $producto['precio'] ?>" required>
      </div>
      <div class="col-sm-6">
        <label for="inputStock" class="form-label">Stock</label>
        <input type="number" id="inputStock" name="stock" class="form-control" placeholder="100" min="1"
          value="<?php echo $producto['stock'] ?>" required>
      </div>
    </div>

    <div class="form-group">
      <div class="col-sm-6">
        <input type="submit" name="actualizar" class="btn btn-sm btn-primary" value="Actualizar Datos">
        <a href="index.php" class="btn btn-sm btn-danger">Cancelar</a>
      </div>
    </div>
  </form>
</body>

</html>