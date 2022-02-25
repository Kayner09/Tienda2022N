<?php

include ("Plantillas/Encabezado.php");
$calcular=0;
session_start()

?>
<div class="container">
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>PRECIO</th>
                    <th>CANTIDAD</th>
                    <th>IMPORTE</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($_SESSION["CARRITO"] as $elemento){ 
                    
                    //print_r($elemento);
                    echo "<br><br>"; ?>
                    
            <tr>
                    <td><?php echo $elemento["id"] ?></td>
                    <td><?php echo $elemento["nombre"] ?></td>
                    <td><?php echo $elemento["precio"] ?></td>
                    <td><input type="number" id="cantidad" onchange="actualizarCantidad(<?php echo $elemento['id']?>)" value="<?php echo $elemento["cantidad"] ?>"/></td>
                    <td><?php echo $elemento["importe"] ?></td>
                    <td>
                        <form action="Carrito.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $elemento["id"]?>">
                            <button type="submit" class="btn btn-danger" name="Eliminar" value="Eliminar">Eliminar</button>
                        </form>
                    </td>
                </tr>
                <?php $calcular+=$elemento["importe"]; }?>
                <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>TOTAL</th>
                    <th> <?php echo $calcular?> </th>
                    <th></th>
                </tr>
                
            </thead>
            </tbody>
        </table>
        <h6>
            <?php if(empty($_SESSION["CARRITO"])){
                echo "</br>No hay elementos";
            }?>
        </h6>
        <?php print_r($_SESSION["CARRITO"])?>
    </div>
</div>
<script>
    function actualizarCantidad(id){
        let cantidad = document.getElementById("cantidad").value;

        const Http = new XMLHttpRequest();
        const url = "Carrito.php?id="+id+"&cantidad="+cantidad+"&Accion=Actualizar";
        Http.open("GET",url);
        Http.send();
        location.reload();
 
    }
        </script>

<?php

include ("PLantillas/Pie.php");

?>