<?php

session_start();
header('Content-type:application/vnd.ms-excel;charset-UTF-8');
header('Content-Disposition: attachment; filename=nombre_archivo.xls');

echo "<table border='1' cellpadding='2' cellspacing='0'
width='100'>";
echo "<tr><td>ID</td><td>CÓDIGO</td><td>NOMBRElocal</td>";

?>
<div class="container">
    <div class="row">
        <table  style="background-color:#CCE5FF" class="table table-striped  table-inverse table-responsive">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>PRECIO</th>
                    <th>CANTIDAD</th>
                    <th>IMPORTE</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($_SESSION["Carrito"] as $elemento){ 
               // print_r($elemento);
               // echo "<br>";
               ?>
                <tr>
                    <td> <?php echo $elemento["id"];?></td>
                    <td> <?php echo $elemento["nombre"];?></td>
                    <td> <?php echo $elemento["precio"];?></td>
                    <td> <?php echo $elemento["importe"];?></td>

            </tr>



                    <?php 
            }
            ?>
            </tbody>
            <tfoot>
                <tr><th colspan="4"> Subtotal</th><th><?php echo $_SESSION['VALORES']["SUBTOTAL"]?>  </th></tr>
                <tr><th colspan="4"> Iva</th><th><?php echo $_SESSION['VALORES']["IVA"]?>  </th></tr>
                <tr><th colspan="4"> Apagar</th><th><?php echo $_SESSION['VALORES']["APAGAR"]?>  </th></tr>
            </tfoot>
        </table>
        <script>
    function actualizar(id,cantidad){
       // let cantidad= document.getElementById("cantidad").value;
        let xhr= new XMLHttpRequest();
        xhr.open('GET','Carritologica.php?id='+id+"&Operacion=Actualizar&cantidad="+cantidad,false);
        xhr.send();

      /*  xhr.onreadystatechange = (e) =>{
            alert("Datos del servidor:-->"+xhr.responseText);

        }*/
        location.reload();
        
    }
</script>