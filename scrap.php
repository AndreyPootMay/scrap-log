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
    "Carga de Lectura interfaz MOTOROLA",
    "Carga de Lectura Interfaz SBL",
    "Carga de Lectura Interfaz Viena",
    "Impresi�n Anomal�as de Lectura",
    "Estimaci�n Lecturas",
    "Descargo Lecturas",
    "C�lculo de Consumo",
    "Reorganization tablas temporales",
    "Invalidaci�n del Lote de Facturaci�n",
    "C�lculo Facturas",
    "Impresi�n Listado de Facturas",
    "Validaci�n Lote de Facturaci�n",
    "Generaci�n Spool de Facturas",
    "Depuraci�n de Datos Temporales",
    "Refrescado Info para CAC",
    "Impresi�n Resumen del Lote de Facturaci�n",
    "Actualizaci�n de clientes con deuda vencida para el c�lculo de saldos",
    "2da. Actualizaci�n de Saldos",
    "Actualizaci�n del estado del cliente en la gesti�n de la deuda",
    "Generaci�n de Notificaciones de Corte",
    "Generaci�n Ordenes de Corte",
    "Generaci�n de asuntos sobre el codigo de observaci�n de lectura",
    "Actualizaci�n de Asuntos en Curso",
    "Impresi�n de Cartas de Cambio de medidor",
    "Impresi�n de Cartas de Instalaci�n de Medidor",
    "Impresi�n de Cartas de Nuevo Servicio",
    "Impresi�n de Cartas de Reclamo 1 y 2",
    "Impresi�n de Cartas de Reclamo 1 y 2  SOLIDARIDAD",
    "Impresi�n de Cartas de Aviso de destronque",
    "Impresi�n de Corte de Drenaje",
    "Impresi�n Ordenes de Trabajo",
    "Impresi�n Lista de Corte",
    "Actualizaci�n de Asuntos en Curso",
    "SMS0",
    "SMS1",
    "SMS2",
    "IVR0",
    "IVR1",
    "IVR2",
    "IVR3",
    "IVR4",
    "Terminacion de contactos y asuntos",
    "Reconexi�n autom�tica",
    "Generaci�n Bip",
    "Extracci�n Contable",
    "Analisis de recuperacion",
    "Actualizaci�n de Datos Contacto",
    "Cuentas Incobrables",
    "Cifras de Control",
    "Fin Tratamientos Diarios X7",
];

$auxSeed = '';

$titleSeed = '';
try {
    //opening the file if exists
    if ($file = fopen("BATCH.Log", "r")) {
        while(!feof($file)) {
            $line = fgets($file);
            $line = utf8_decode(trim($line));
            
            foreach ($keys as $key) {
                if ($auxSeed == 'Date debut' || $auxSeed == 'Date fin') {
    
                    $datetime = explode(' ', $line);
    
                    if ($auxSeed == 'Date debut') {
                        $array[$titleSeed]['Date_debut']['Fecha'] = $datetime[0];
                        $array[$titleSeed]['Date_debut']['Hora'] = $datetime[1];
                    }
        
                    if ($auxSeed == 'Date fin') {
                        $array[$titleSeed]['Date_fin']['Fecha'] = $datetime[0];
                        $array[$titleSeed]['Date_fin']['Hora'] = $datetime[1];
                    }
                }
    
                if ($line == utf8_decode(trim($key))) { // Título del json
                    $array[] = $line; 
                    $titleSeed = str_replace(" ", "_", $line);
                }
    
                $auxSeed = $line;
            } 
        }
    
        fclose($file);
    } else {
        return false;
    }
} catch (\Throwable $th) {
    return false;
}

$filePath = 'BATCH.json';

// Quiting numeric indexes in the array to solve the dynamics only 
foreach ($array as $key => $value) {
    if (is_int($key)) {
        unset($array[$key]);
    }
}

if (!file_put_contents($filePath, json_encode($array))) {
    var_dump("Error when BATCH.Log parsing");
}

// Open the json and change the date format
try {
    $fhandle = fopen($filePath,"r");
    $content = fread($fhandle,filesize($filePath));
    $content = str_replace("\/", "/", $content);

    $fhandle = fopen($filePath,"w");
    fwrite($fhandle,$content);
    fclose($fhandle);
} catch (\Throwable $th) {
    throw $th;
}

print_r("File successfully created: {$filePath}\n");