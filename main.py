#!/usr/bin/env/python
# -*- coding: utf-8 -*-

import re

keys = [
    "Depuracion Rollbacks",
    "Posicionamiento Rollbacks",
    "INICIO LOG CADENA BATCH",
    "- Almacenamiento de la Tabla de Mensajes",
    "Eliminacion de archivos de impresion",
    "Almacenamiento de archivo Spool del D�a anterior",
    "Actualizaci�n Fecha de Tratamiento",
    "Restauraci�n Estado de Tareas en Curso",
    "Habilita tratamiento NOTAVI",
    "DEPURA TRATAMIENTOS AGUAKAN FINALIZADOS",
    "Control e Integraci�n de Consignaci�n de Caja Off-line",
    "Impresi�n de las Anomal�as de Consignaci�n de Caja Off-line",
    "Impresi�n integration de consignaci�n",
    "Impresi�n integration de consignaci�n",
    " Atribuci�n de Pagos",
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

list = []
with open('BATCH.Log', 'r') as file:
  for line in file.readlines():
    line = line.strip()
    if line in keys:
        print(line)


