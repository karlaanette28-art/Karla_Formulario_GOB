<?php
// 1. Conexión a la base de datos "registros"
$conexion = mysqli_connect("localhost", "root", "", "registros");

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Configurar codificación para caracteres especiales (acentos, Ñ)
mysqli_set_charset($conexion, "utf8");

// 2. Cabeceras para forzar la descarga en formato CSV nativo de Excel
$filename = "Reporte_Formularios_" . date('Ymd_His') . ".csv";
header("Content-Type: text/csv; charset=utf-8");
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Pragma: no-cache");
header("Expires: 0");

// MANDATORIO: Agregar el BOM UTF-8 para que Excel detecte los caracteres correctamente
echo "\xEF\xBB\xBF";

// 3. Abrimos la salida de datos de PHP
$salida = fopen("php://output", "w");

// 4. TÍTULOS DE LAS COLUMNAS (Tus 28 campos en orden exacto)
fputcsv($salida, [
    'ID Empleado', 'Apellido Paterno', 'Apellido Materno', 'Nombre', 'RFC', 'CURP', 
    'Fecha de Nacimiento', 'Escolaridad', 'Estado Civil', 'Colonia', 'Calle', 'Municipio', 
    'Código Postal', 'Teléfono', 'Género', 'ISSEMYM', 'Clave ISSEMYM', 'ID Unidad Org', 
    'Unidad Org', 'Dirección', 'ID de Plaza', 'Tipo de Plaza', 'Tipo de Servicio Público', 
    'ID Puesto', 'CCT', 'Lugar de Trabajo', 'Fecha de Ingreso al GEM', 'Fecha de Paga'
], ';'); // Usamos punto y coma (;) que es el separador estándar de Excel en español

// 5. CONSULTA SQL SELECT (Une ambas tablas mediante el ID del empleado)
$query = "SELECT 
            p.ID_Empleado, p.Apellido_Paterno, p.Apellido_Materno, p.Nombre, p.RFC, p.CURP, p.Fecha_de_Nacimiento, p.Escolaridad, p.Estado_Civil, p.Colonia, p.Calle, p.Municipio, p.Codigo_Postal, p.Telefono,
            l.Genero, l.ISSEMYM, l.Clave_ISSEMYM, l.ID_Unidad_Org, l.Unidad_Org, l.Direccion, l.ID_de_Plaza, l.Tipo_de_Plaza, l.Tipo_de_Servicio_Publico, l.ID_Puesto, l.CCT, l.Lugar_de_Trabajo, l.Fecha_de_Ingreso_al_GEM, l.Fecha_de_Paga
          FROM registro_personal p
          INNER JOIN laboral l ON p.ID_Empleado = l.ID_Empleado";

$resultado = mysqli_query($conexion, $query);

// 6. Volcar los datos del formulario fila por fila
if ($resultado) {
    while ($fila = mysqli_fetch_assoc($resultado)) {
        fputcsv($salida, [
            $fila['ID_Empleado'],
            $fila['Apellido_Paterno'],
            $fila['Apellido_Materno'],
            $fila['Nombre'],
            $fila['RFC'],
            $fila['CURP'],
            $fila['Fecha_de_Nacimiento'],
            $fila['Escolaridad'],
            $fila['Estado_Civil'],
            $fila['Colonia'],
            $fila['Calle'],
            $fila['Municipio'],
            $fila['Codigo_Postal'],
            $fila['Telefono'],
            $fila['Genero'],
            $fila['ISSEMYM'],
            $fila['Clave_ISSEMYM'],
            $fila['ID_Unidad_Org'],
            $fila['Unidad_Org'],
            $fila['Direccion'],
            $fila['ID_de_Plaza'],
            $fila['Tipo_de_Plaza'],
            $fila['Tipo_de_Servicio_Publico'],
            $fila['ID_Puesto'],
            $fila['CCT'],
            $fila['Lugar_de_Trabajo'],
            $fila['Fecha_de_Ingreso_al_GEM'],
            $fila['Fecha_de_Paga']
        ], ';'); // Inserta cada empleado en una nueva fila ordenada
    }
}

// 7. Cerrar flujos y conexión
fclose($salida);
mysqli_close($conexion);
exit();
?>