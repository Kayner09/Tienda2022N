<?php

use LDAP\Result;

include("Plantillas/Encabezado.php");
include("Admin/BDD/Conexion.php");

session_start();
$validar = true;

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $usr = $_POST['usr'];
    $pwd = $_POST['pwd'];

    $sql = "select * from clientes where usr='$usr' and pwd='$pwd';";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $idf = 0;
        $row = $result->fetch_assoc();

        $subtotal = $_SESSION['VALORES']["SUBTOTAL"];
        $IVA = $_SESSION['VALORES']["IVA"];
        $aPAGAR = $_SESSION['VALORES']["APAGAR"];
        $id = $row['id'];

        $sql = "insert into facturas values (null,CURDATE(),$subtotal,$IVA,$aPAGAR,$id)";

        if ($conn->query($sql)) {
            $idf = $conn->insert_id;
        }else{
            $validar=false;
        }
        foreach ($_SESSION["Carrito"] as $elemento) {
            $idp = $elemento["id"];
            $precio = $elemento["precio"];
            $cantidad = $elemento["cantidad"];
            $importe = $elemento["importe"];
            $sql="insert into detalles value (null, $cantidad,$precio,$importe,$idp,$idf);";
            
        }




        if ($validar) {
            echo "<script>alert('Bienvenido, compra realizada');</script>";
        } else {
            echo "<script>alert('Intente nuevamente');</script>";
        }
    } else {
        echo "<script>alert('Datos incorrectos, Intente nuevamente');</script>";
    }
}

?>

<div class="container">
    <div class="row">

        <div class="container">
            <form method="POST">

                <fieldset class="form-group row">
                    <legend class="col-form-legend col-sm-1-12">Bienvenido, Ingrese sus datos para poder continuar </legend>

                </fieldset>

                <div class="form-group row">

                    <label for="inputName" class="col-sm-1-12 col-form-label">Ingrese su Usuario.</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="usr" id="inputName" placeholder="">
                    </div>
                </div>

                <div class="form-group row">

                    <label for="inputName" class="col-sm-1-12 col-form-label">Ingrese su Clave</label>
                    <div class="col-md-3">
                        <input type="password" class="form-control" name="pwd" id="inputName" placeholder="">
                    </div>
                </div>

                <br>
                <div class="form-group row">
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">Confirmar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include("Plantillas/pie.php"); ?>