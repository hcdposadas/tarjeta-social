<?php
require 'vendor/autoload.php';

//$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load("tickets.xlsx");

$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

$spreadsheet = $reader->load( "tickets.xlsx" );

$sheetData = $spreadsheet->getActiveSheet()->toArray();

unset( $sheetData[0] );
$myfile = fopen( "PruebaAltasTarjeta.txt", "w" );

$fechaProceso = date( "Ymd" );
$espacio308   = str_repeat( ' ', 308 );
$denominacion = 'AltasHcdPosadas               ';
$espacio37    = str_repeat( ' ', 37 );

$header = "630046332        " . $fechaProceso . $espacio308 . $denominacion . $espacio37;
fwrite( $myfile, $header );


foreach ( $sheetData as $item => $value ) {
	$numeroUsuario  = str_pad( 0, 7, "0", STR_PAD_LEFT );
	$numeroTarjeta  = str_pad( 0, 16, "0", STR_PAD_LEFT );
	$codigoProducto = "S";
	$tipoCuenta     = '01';
	$numeroLegajo   = str_pad( 5059, 8, "0", STR_PAD_LEFT );


	$ventiunCeros        = str_pad( 0, 21, "0", STR_PAD_LEFT );
	$grupoAfinidad       = '000';
	$cuarentaysieteCeros = str_pad( 0, 47, "0", STR_PAD_LEFT );
	$filler8             = str_pad( "0", 8, "0", STR_PAD_LEFT );

	$codigoCierre     = "4";
	$dosCeros         = "00";
	$distriucion      = "D1";
	$tresCeros        = "000";
	$no               = "N";
	$codigoMotivoBaja = "  ";
	$usoEntidad       = str_repeat( ' ', 8 );
	$duracionTarjeta  = "36";
	$codInt           = "  ";
	$cantidadCuotas   = "01";
	$marcaRenovacion  = "SI";
	$filler4          = "    ";
	$estadoSituacion  = "01";
	$filler1          = " ";

	//	datos del agente
	$apellido        = "";
	$nombre          = "";
	$calle           = "";
	$puerta          = "";
	$piso            = "";
	$departamento    = "";
	$cp              = "";
	$codigoProvincia = 15;
	$localidad       = str_pad( "POSADAS", 25, " ", STR_PAD_LEFT );
	$telefono        = "";
	$codigoDocumento = "";
	$numeroDocumento = "";
	$fechaNacimiento = "";
	$estadoCivil     = "";
	$genero          = "";
	$email           = "";
	//	datos del agente

	$codigoRechazo = str_repeat( ' ', 20 );

	$detalle = '6301463001' . $numeroUsuario . $numeroTarjeta . $codigoProducto . $tipoCuenta . $numeroLegajo .
	           $apellido . $nombre . $calle . $puerta . $piso . $departamento . $cp . $codigoProvincia . $localidad . $telefono . $codigoDocumento . $numeroDocumento .
	           $ventiunCeros . $grupoAfinidad . $cuarentaysieteCeros . $filler8 . $fechaNacimiento . $estadoCivil . $genero .
	           $codigoCierre . $dosCeros . $distriucion .
	           $tresCeros . $no . $codigoMotivoBaja . $usoEntidad . $duracionTarjeta . $codInt . $cantidadCuotas . $marcaRenovacion .
	           $filler4 . $estadoSituacion . $filler1 . $email . $codigoRechazo;

	print_r( $item );
	print_r( $value );

	fwrite( $myfile, $detalle );
	break;
}
$cantidadRegistros = str_pad( count( $sheetData ), 10, "0", STR_PAD_LEFT );
$espacio375        = str_repeat( ' ', 375 );
$trailer           = '6399463' . $cantidadRegistros . $fechaProceso . $espacio375;
fwrite( $myfile, $trailer );

