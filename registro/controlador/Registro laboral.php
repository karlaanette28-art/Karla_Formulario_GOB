<?php

include "../modelo/conexion.php";

// =====================================
// RECIBIR DATOS
// =====================================

$ID_Empleado            = $_POST['ID_Empleado'] ?? '';
$Genero                 = trim($_POST['Genero'] ?? '');
$ISSEMYM                = trim($_POST['ISSEMYM'] ?? '');
$Clave_ISSEMYM          = trim($_POST['Clave_ISSEMYM'] ?? '');
$ID_Unidad_Org          = $_POST['ID_Unidad_Org'] ?? '';
$Unidad_Org              = trim($_POST['Unidad_Org'] ?? '');
$Direccion              = trim($_POST['Direccion'] ?? '');
$ID_de_Plaza             = $_POST['ID_de_Plaza'] ?? '';
$Tipo_de_Plaza           = trim($_POST['Tipo_de_Plaza'] ?? '');
$Tipo_de_Servicio_Publico = trim($_POST['Tipo_de_Servicio_Publico'] ?? '');
$ID_Puesto               = $_POST['ID_Puesto'] ?? '';
$CCT                     = trim($_POST['CCT'] ?? '');
$Lugar_de_Trabajo        = trim($_POST['Lugar_de_Trabajo'] ?? '');
$Fecha_de_Ingreso_al_GEM = $_POST['Fecha_de_Ingreso_al_GEM'] ?? '';
$Fecha_de_Paga           = $_POST['Fecha_de_Paga'] ?? '';


// =====================================
// CONVERTIR CAMPOS NUMÉRICOS VACÍOS A NULL
// =====================================

$ID_Empleado = ($ID_Empleado === '') ? null : (int)$ID_Empleado;

$ID_Unidad_Org = ($ID_Unidad_Org === '')
    ? null
    : (int)$ID_Unidad_Org;

$ID_de_Plaza = ($ID_de_Plaza === '')
    ? null
    : (int)$ID_de_Plaza;

$ID_Puesto = ($ID_Puesto === '')
    ? null
    : (int)$ID_Puesto;


// =====================================
// CONVERTIR FECHAS VACÍAS A NULL
// =====================================

if ($Fecha_de_Ingreso_al_GEM === '') {
    $Fecha_de_Ingreso_al_GEM = null;
}

if ($Fecha_de_Paga === '') {
    $Fecha_de_Paga = null;
}


// =====================================
// CONSULTA INSERT
// =====================================

//=====================================
// CONSULTA INSERT (REVISADA)
// =====================================
$insertar = "INSERT INTO laboral (
    ID_Empleado,
    Genero,
    ISSEMYM,
    Clave_ISSEMYM,
    ID_Unidad_Org,
    Unidad_Org,
    Direccion,
    ID_de_Plaza,
    Tipo_de_Plaza,
    Tipo_de_Servicio_Publico,
    ID_Puesto,
    CCT,
    Lugar_de_Trabajo,
    Fecha_de_Ingreso_al_GEM,
    Fecha_de_Paga
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Preparar consulta
$stmt = mysqli_prepare($conexion, $insertar);

if (!$stmt) {
    // Si la sintaxis de SQL está mal arriba, aquí te dirá exactamente qué palabra falló
    die("Error de sintaxis en la consulta SQL: " . mysqli_error($conexion));
}
// =====================================
// ASIGNAR PARAMETROS
// =====================================
//
// i = entero
// s = texto
//
// Orden:
// ID_Empleado              i
// Genero                   s
// ISSEMYM                  s
// Clave_ISSEMYM            s
// ID_Unidad_Org            i
// Unidad_Org               s
// Direccion                s
// ID_de_Plaza              i
// Tipo_de_Plaza            s
// Tipo_de_Servicio_Publico s
// ID_Puesto                i
// CCT                      s
// Lugar_de_Trabajo         s
// Fecha_de_Ingreso_al_GEM  s
// Fecha_de_Paga            s
//

mysqli_stmt_bind_param(
    $stmt,
    "isssissississss",
    $ID_Empleado,
    $Genero,
    $ISSEMYM,
    $Clave_ISSEMYM,
    $ID_Unidad_Org,
    $Unidad_Org,
    $Direccion,
    $ID_de_Plaza,
    $Tipo_de_Plaza,
    $Tipo_de_Servicio_Publico,
    $ID_Puesto,
    $CCT,
    $Lugar_de_Trabajo,
    $Fecha_de_Ingreso_al_GEM,
    $Fecha_de_Paga
);


// =====================================
// EJECUTAR
// =====================================

if (mysqli_stmt_execute($stmt)) {

    echo "
    <script>
        alert('¡Registro laboral agregado correctamente!');
        window.location.href = '../vista/Registro laboral.html';
    </script>
    ";

} else {

    // Cambiamos la función incorrecta por mysqli_error para que te diga el fallo real
    $error = mysqli_error($conexion);

    echo "
    <script>
        alert('Error al guardar el registro: " . addslashes($error) . "');
        window.history.back();
    </script>
    ";
}


// =====================================
// CERRAR
// =====================================

mysqli_stmt_close($stmt);
mysqli_close($conexion);

?>