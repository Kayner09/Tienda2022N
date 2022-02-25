<?php

require('Admin/fpdf/fpdf.php');
session_start();
include("Admin/BDD/Conexion.php");
$Fpdf = new FPDF();
$Fpdf->AddPage();
$Fpdf->SetFont("Arial","B",40);
$Fpdf->Image("img/almacen.png",170,5,25,25,"PNG");
$Fpdf->SetX(150);
$Fpdf->Sety(15);
$textypos = 5;

$Fpdf->Cell(5,$textypos,"FACTURA");
$Fpdf->SetFont('Arial','B',10);  

$Fpdf->setY(30);$Fpdf->setX(10);
$Fpdf->Cell(5,$textypos,"TIENDA ONLINE");
$Fpdf->setY(35);$Fpdf->setX(10);
$Fpdf->Cell(5,$textypos,"Telefono:222222");
$Fpdf->setY(40);$Fpdf->setX(10);
$Fpdf->Cell(5,$textypos,"Correo:tiendaoline@gmail.com");

// Agregamos los datos del cliente
$sql="Select * from clientes;";
$result=$conn->query($sql);
$row = $result->fetch_assoc();
$Fpdf->SetFont('Arial','I',10);
$Fpdf->setY(50);$Fpdf->setX(100);
$Fpdf->Ln(5);
$Fpdf->Cell(30,10,"Nombre:");
    $Fpdf->Cell(60,10,$row["nombre"]);
 
    $Fpdf->Cell(30,10,"Apellido:");
    $Fpdf->Cell(60,10,$row["apellido"]);
    $Fpdf->Ln(5);
    $Fpdf->Cell(30,10,"Cedula:");
    $Fpdf->Cell(60,10,$row["cedula"]);
    

    $Fpdf->Cell(30,10,"Fecha:");
    $fechaActual = date('d-m-Y');
    $Fpdf->Cell(60,10,$fechaActual);
    $Fpdf->Ln();
    $Fpdf->Ln();


// Agregamos los datos del cliente
$Fpdf->SetFont('Arial','B',10);    
$Fpdf->setY(30);$Fpdf->setX(135);
$Fpdf->Cell(5,$textypos,"FACTURA #12345");
$Fpdf->setY(35);$Fpdf->setX(135);
$Fpdf->Cell(5,$textypos,"Vencimiento: 30/MARZO/2022");
$Fpdf->setY(40);$Fpdf->setX(135);
$Fpdf->Cell(5,$textypos,"Direccion: VIDA NUEVA");


// subtitulo
$Fpdf->SetFont('Arial','B',10);
$Fpdf->SetX(30);
$Fpdf->setY(80);$Fpdf->setX(80);
$textypos = 5;
$Fpdf->Cell(60,$textypos,"DETALLE FACTURA");
$Fpdf->Ln();
$Fpdf->Ln();
$Fpdf->Ln();

// factura elements
$Fpdf->Cell(30,10,"Producto",true);
$Fpdf->Cell(80,10,"Cantidad",true);
$Fpdf->Cell(20,10,"V.U",true);
$Fpdf->Cell(20,10,"V.Total",true);
$Fpdf->Ln();
foreach ($_SESSION["Carrito"] as $elemento) {
    $id = $elemento["nombre"];
    $cantidad = $elemento["cantidad"];
    $precio = $elemento["precio"];
    $importe = $elemento["importe"];
    
        $Fpdf->Cell(30,10,$id,true);
        $Fpdf->Cell(80,10,$cantidad,true);
        $Fpdf->Cell(20,10,$precio,true);
        $Fpdf->Cell(20,10,$importe,true);
        $Fpdf->Ln();
    
}

$Fpdf->Ln();
$Fpdf->SetFillColor(224,235,255);
$Fpdf->SetTextColor(0);
$Fpdf->SetFont("Arial","B",16);
$Fpdf->SetDrawColor(89, 154, 184);


//$Fpdf->SetLineWidth(.3);
        $subtotal = 0;
        $iva = 0;
        $aPagar = 0;
        foreach ($_SESSION["Carrito"] as $elemento) {
            $subtotal += $elemento["importe"];
        }
        $iva = $subtotal * 0.12;
        $apagar = $subtotal + $iva;
        $Fpdf->Cell(110,10,"SUBTOTAL:",true,);
        $Fpdf->Cell(40,10,$subtotal,true,);
        $Fpdf->Ln();
        $Fpdf->Cell(110,10,"IVA",true);
        $Fpdf->Cell(40,10,$iva,true);
        $Fpdf->Ln();
        $Fpdf->Cell(110,10,"TOTAL",true);
        $Fpdf->Cell(40,10,$apagar,true);

$Fpdf->Output();

