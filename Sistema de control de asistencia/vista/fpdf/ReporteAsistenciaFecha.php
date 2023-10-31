<?php

if (!empty($_GET["txtfechainicio"]) and !empty($_GET["txtfechafinal"]) and !empty($_GET["txtempleado"]) ) {
   require('./fpdf.php');
   $fechainicio=$_GET["txtfechainicio"];
   $fechafinal=$_GET["txtfechafinal"];
   $empleado=$_GET["txtempleado"];

class PDF extends FPDF
{

   // Cabecera de página
   function Header()
   {
      include '../../modelo/conexion.php';//llamamos a la conexion BD

      $consulta_info = $conexion->query(" select *from empresa ");//traemos datos de la empresa desde BD
      $dato_info = $consulta_info->fetch_object();
      $this->Image('logo.png', 250, 5, 30); //logo de la empresa,moverDerecha,moverAbajo,tamañoIMG
      $this->SetFont('Arial', 'B', 19); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(95); // Movernos a la derecha
      $this->SetTextColor(0, 0, 0); //color
      //creamos una celda o fila
      $this->Cell(110, 15, utf8_decode($dato_info->nombre), 1, 1, 'C', 0); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
      $this->Ln(3); // Salto de línea
      $this->SetTextColor(103); //color

      /* UBICACION */
      $this->Cell(180);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(96, 10, utf8_decode("Ubicación : " . $dato_info->ubicacion), 0, 0, '', 0);
      $this->Ln(5);

      /* TELEFONO */
      $this->Cell(180);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(59, 10, utf8_decode("Teléfono : ". $dato_info->telefono), 0, 0, '', 0);
      $this->Ln(10);

 

      


      /* TITULO DE LA TABLA */
      //color
      $this->SetTextColor(228, 100, 0);
      $this->Cell(100); // mover a la derecha
      $this->SetFont('Arial', 'B', 15);
      $this->Cell(100, 10, utf8_decode("REPORTE DE ASISTENCIAS POR FECHAS"), 0, 1, 'C', 0);
      $this->Ln(7);

      /* CAMPOS DE LA TABLA */
      //color
      $this->SetFillColor(125, 173, 221); //colorFondo
      $this->SetTextColor(255, 255, 255); //colorTexto
      $this->SetDrawColor(163, 163, 163); //colorBorde
      $this->SetFont('Arial', 'B', 11);
      $this->Cell(15, 10, utf8_decode('N°'), 1, 0, 'C', 1);
      $this->Cell(80, 10, utf8_decode('EMPLEADO'), 1, 0, 'C', 1);
      $this->Cell(30, 10, utf8_decode('CEDULA'), 1, 0, 'C', 1);
      $this->Cell(50, 10, utf8_decode('ENTRADA'), 1, 0, 'C', 1);
      $this->Cell(50, 10, utf8_decode('SALIDA'), 1, 0, 'C', 1);
      $this->Cell(50, 10, utf8_decode('TOTAL HORAS'), 1, 1, 'C', 1);
   }

   // Pie de página
   function Footer()
   {
      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C'); //pie de pagina(numero de pagina)

      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, cursiva, tamañoTexto
      $hoy = date('d/m/Y');
      $this->Cell(540, 10, utf8_decode($hoy), 0, 0, 'C'); // pie de pagina(fecha de pagina)
   }
}

include '../../modelo/conexion.php';

$pdf = new PDF();
$pdf->AddPage("landscape"); /* aqui entran dos para parametros (horientazion,tamaño)V->portrait H->landscape tamaño (A3.A4.A5.letter.legal) */
$pdf->AliasNbPages(); //muestra la pagina / y total de paginas

$i = 0;
$pdf->SetFont('Arial', '', 12);
$pdf->SetDrawColor(163, 163, 163); //colorBorde

if ($empleado=="todos") {
   $sql=$conexion->query(" SELECT
   asistencia.id_asistencia,
   asistencia.id_empleado,
   date_format(asistencia.entrada, '%m-%d-%Y %H:%i:%s') as 'entrada',
   date_format(asistencia.salida, '%m-%d-%Y %H:%i:%s') as 'salida',
   TIMEDIFF(asistencia.salida, asistencia.entrada) as 'totalHR',
   empleado.nombre,
   empleado.apellido,
   empleado.dni,
   cargo.nombre as 'cargo'
FROM
   asistencia
INNER JOIN empleado ON asistencia.id_empleado = empleado.id_empleado
INNER JOIN cargo ON empleado.cargo = cargo.id_cargo
WHERE entrada BETWEEN '$fechainicio' AND '$fechafinal' ORDER BY id_asistencia ASC " );

   
} else {
   $sql = $conexion->query("SELECT
   asistencia.id_asistencia,
   asistencia.id_empleado,
   date_format(asistencia.entrada, '%m-%d-%Y %H:%i:%s') as 'entrada',
   date_format(asistencia.salida, '%m-%d-%Y %H:%i:%s') as 'salida',
   TIMEDIFF(asistencia.salida, asistencia.entrada) as 'totalHR',
   empleado.nombre,
   empleado.apellido,
   empleado.dni,
   cargo.nombre as 'cargo'
FROM
   asistencia
INNER JOIN empleado ON asistencia.id_empleado = empleado.id_empleado
INNER JOIN cargo ON empleado.cargo = cargo.id_cargo
WHERE asistencia.id_empleado = $empleado AND entrada BETWEEN '$fechainicio' AND '$fechafinal' ORDER BY id_asistencia ASC");
   
}

while ($datos_reporte = $sql->fetch_object()) {
   $i = $i + 1;
   $pdf->Cell(15, 10, utf8_decode($i), 1, 0, 'C', 0);

   $nombreCompleto = $datos_reporte->nombre . " " . $datos_reporte->apellido;
   $nombreDecodificado = ($nombreCompleto !== null) ? utf8_decode($nombreCompleto) : '';
   $pdf->Cell(80, 10, $nombreDecodificado, 1, 0, 'C', 0);
   
   $dniDecodificado = ($datos_reporte->dni !== null) ? utf8_decode($datos_reporte->dni) : '';
   $pdf->Cell(30, 10, $dniDecodificado, 1, 0, 'C', 0);
   
   $entradaDecodificada = ($datos_reporte->entrada !== null) ? utf8_decode($datos_reporte->entrada) : '';
   $pdf->Cell(50, 10, $entradaDecodificada, 1, 0, 'C', 0);
   
   $salidaDecodificada = ($datos_reporte->salida !== null) ? utf8_decode($datos_reporte->salida) : '';
   $pdf->Cell(50, 10, $salidaDecodificada, 1, 0, 'C', 0);
   
   $totalHRDecodificada = ($datos_reporte->totalHR !== null) ? utf8_decode($datos_reporte->totalHR) : '';
   $pdf->Cell(50, 10, $totalHRDecodificada, 1, 1, 'C', 0);
   
  

}

$pdf->Output('Prueba2.pdf', 'I');//nombreDescarga, Visor(I->visualizar - D->descargar)
}




