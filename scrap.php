<?php

$keys = [
    "Depuracion Rollbacks",
    "Posicionamiento Rollbacks",
    "INICIO LOG CADENA BATCH",
    "- Almacenamiento de la Tabla de Mensajes",
    "Eliminacion de archivos de impresion",
    "Almacenamiento de archivo Spool del D��a anterior",
    "Actualizaci�n Fecha de Tratamiento",
    "Restauraci�n Estado de Tareas en Curso",
    "Habilita tratamiento NOTAVI",
    "DEPURA TRATAMIENTOS AGUAKAN FINALIZADOS",
    "Control e Integraci�n de Consignaci�n de Caja Off-line",
    "Impresi�n de las Anomal�as de Consignaci�n de Caja Off-line",
    "Impresi�n integration de consignaci�n",
    "Atribuci�n de Pagos",
    "Actualizaci�n de clientes con deuda vencida para el c�lculo de saldos",
    "1era Actualizaci�n de Saldos",
    "C�lculo de descuentos por pronto pago",
    "Depuraci�n tareas con simulacion no existente",
    "Inicializaci�n de contactos tipo email",
    "Tratamiento de cobro juridico",
    "Constituci�n Lote de Facturaci�n",
    "Anulaci�n Lote de Facturaci�n",
    "Generaci�n de la Cartilla de Lectura",
    "Generaci�n de archivo interfaz SBL",
    "Generaci�n de archivo interfaz VIENA",
];

$auxSeed = '';

$titleSeed = '';
if ($file = fopen("BATCH.Log", "r")) {
    while(!feof($file)) {
        $line = fgets($file);
        $line = utf8_decode(trim($line));
        
        $dateDebut = false;
        $dateFin = false;

        foreach ($keys as $key) {
            if ($auxSeed == 'Date debut') {
                $array[$titleSeed]['Date debut'] = $line;
            }

            if ($auxSeed == 'Date fin') {
                $array[$titleSeed]['Date fin'] = $line;
            }

            if ($line == utf8_decode(trim($key))) { // Título del json
                $array[] = $line; 
                $titleSeed = $line;
            }

            $auxSeed = $line;
        } 
    }

    fclose($file);
}

var_dump($array);