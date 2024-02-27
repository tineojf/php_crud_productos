<?php

require 'Conexion.php';

class Productos extends Conexion {

    public function Productos() {
        parent::__construct();
    }

    public function get_productos() {
        $sql = "select * from productos";
        $sentencia = $this->conexion_db->prepare($sql);
        $sentencia->execute();
        $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        $sentencia->closeCursor();
        return $resultado;
    }

    public function get_producto_id($id) {
        $sql = "select * from productos where id = :id limit 1";
        $sentencia = $this->conexion_db->prepare($sql);
        $sentencia->bindParam(':id', $id);
        $sentencia->execute();
        $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
        $sentencia->closeCursor();
        return $resultado;
    }

    public function get_producto_name($name) {
        $search = '%' . $name . '%';
        $sql = "select * from productos where nombre like :search";
        $sentencia = $this->conexion_db->prepare($sql);
        $sentencia->bindParam(':search', $search);
        $sentencia->execute();
        $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        $sentencia->closeCursor();
        return $resultado;
    }

    public function post_productos($id, $nombre, $categoria, $precio, $stock) {
        $sql = "select * from productos where id = :id";
        $resultado = $this->conexion_db->prepare($sql);
        $resultado->bindParam(':id', $id);
        $resultado->execute();

        if ($resultado->fetchColumn() == 0) {
            $sql = "insert into productos (id, nombre, categoria, precio, stock) values (:id, :nombre, :categoria, :precio, :stock)";
            $sentencia = $this->conexion_db->prepare($sql);
            $sentencia->bindParam(':id', $id);
            $sentencia->bindParam(':nombre', $nombre);
            $sentencia->bindParam(':categoria', $categoria);
            $sentencia->bindParam(':precio', $precio);
            $sentencia->bindParam(':stock', $stock);
            $sentencia->execute();
            $sentencia->closeCursor();

            echo "<p>El producto se ha agregado correctamente.</p>";
            header("Location: index.php");
            exit();
        } else {
            echo "<script>alert('El codigo ya existe')</script>";
        }
    }

    public function delete_productos($id) {
        $sql = "delete from productos where id = :id";
        $sentencia = $this->conexion_db->prepare($sql);
        $sentencia->bindParam(':id', $id);
        $sentencia->execute();
        $sentencia->closeCursor();
    }

    public function put_producto_id($id, $nombre, $categoria, $precio, $stock) {
        $sql = "update productos set nombre = :nombre, categoria = :categoria, precio = :precio, stock = :stock where id = :id";
        $sentencia = $this->conexion_db->prepare($sql);
        $sentencia->bindParam(':id', $id);
        $sentencia->bindParam(':nombre', $nombre);
        $sentencia->bindParam(':categoria', $categoria);
        $sentencia->bindParam(':precio', $precio);
        $sentencia->bindParam(':stock', $stock);
        $sentencia->execute();
        $sentencia->closeCursor();
    }
}
