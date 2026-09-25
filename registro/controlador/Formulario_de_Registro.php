<?php

include "../modelo/conexion.php";

// Incluir la librería de Excel
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


// Verificamos que el formulario haya sido enviado por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $Apellido_Paterno    = $_POST['Apellido_Paterno'] ?? '';
    $Apellido_Materno    = $_POST['Apellido_Materno'] ?? '';
    $Nombre              = $_POST['Nombre'] ?? '';
    $RFC                 = $_POST['RFC'] ?? '';
    $CURP                = $_POST['CURP'] ?? '';
    $Fecha_de_Nacimiento = $_POST['Fecha_de_Nacimiento'] ?? '';
    $Escolaridad         = $_POST['Escolaridad'] ?? '';
    $Estado_Civil        = $_POST['Estado_Civil'] ?? '';
    $Colonia             = $_POST['Colonia'] ?? '';
    $Calle               = $_POST['Calle'] ?? '';
    $Municipio           = $_POST['Municipio'] ?? '';
    $Codigo_Postal       = $_POST['Codigo_Postal'] ?? '';
    $Telefono            = $_POST['Telefono'] ?? '';


    // Consulta INSERT
    $insertar ="INSERT INTO registro_personal (

        Apellido_Paterno,
        Apellido_Materno,
        Nombre,
        RFC,
        CURP,
        Fecha_de_Nacimiento,
        Escolaridad,
        Estado_Civil,
        Colonia,
        Calle,
        Municipio,
        Codigo_Postal,
        Telefono
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
}
    // Preparar consulta
    $stmt = mysqli_prepare($conexion, $insertar);

    if (!$stmt) {
        die("Error al preparar la consulta: " . mysqli_error($conexion));
    }
//aqui comienza lo de Excel

// Array con la fila que se agregará a Excel
$datos_formulario = [
    $Apellido_Paterno,
    $Apellido_Materno,
    $Nombre,
    $RFC,
    $CURP,
    $Fecha_de_Nacimiento,
    $Escolaridad,
    $Estado_Civil,
    $Colonia,
    $Calle,
    $Municipio,
    $Codigo_Postal,
    $Telefono
];

// Nombre del archivo de Excel
$archivo_excel = 'registros_guardados.xlsx';

// 2. Si el archivo Excel ya existe, lo abre; si no existe, lo crea con encabezados
if (file_exists($archivo_excel)) {
    $spreadsheet = IOFactory::load($archivo_excel);
    $sheet = $spreadsheet->getActiveSheet();
} else {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle('Registros');
    
    // Encabezados en la primera fila
    $encabezados = [
        'Apellido Paterno', 'Apellido Materno', 'Nombre', 'RFC', 'CURP',
        'Fecha Nacimiento', 'Escolaridad', 'Estado Civil', 'Colonia',
        'Calle', 'Municipio', 'Código Postal', 'Teléfono'
    ];
    $sheet->fromArray([$encabezados], NULL, 'A1');
}

// 3. Buscar la última fila libre y colocar los nuevos datos
$siguiente_fila = $sheet->getHighestRow() + 1;
$sheet->fromArray([$datos_formulario], NULL, 'A' . $siguiente_fila);

// 4. Guardar los cambios en el archivo
$writer = new Xlsx($spreadsheet);
$writer->save($archivo_excel);

// 5. Redireccionar o mandar aviso al usuario
echo "<script>
        alert('¡Información guardada correctamente en el archivo de Excel!');
        window.history.back();
      </script>";

      
        // 1. Guardamos el ID en la sesión para que el formulario laboral sepa de quién es
        $_SESSION['id_empleado_actual'] = mysqli_insert_id($conexion);

        mysqli_stmt_close($stmt);
        mysqli_close($conexion);




    // Los 13 campos son cadenas
    mysqli_stmt_bind_param(
        $stmt,
        "sssssssssssss",
        $Apellido_Paterno,
        $Apellido_Materno,
        $Nombre,
        $RFC,
        $CURP,
        $Fecha_de_Nacimiento,
        $Escolaridad,
        $Estado_Civil,
        $Colonia,
        $Calle,
        $Municipio,
        $Codigo_Postal,
        $Telefono
    );

    // ... Código anterior del INSERT y ejecución ...

    if (mysqli_stmt_execute($stmt)) {
        echo"Registro Guardado Exitosamente";
    }else{
        die("ERROR MYSQL: " . mysqli_stmt_error($stmt));

    }
        
        // 1. Guardamos el ID en la sesión para que el formulario laboral sepa de quién es
        $_SESSION['id_empleado_actual'] = mysqli_insert_id($conexion);

        mysqli_stmt_close($stmt);
        mysqli_close($conexion);

        // 2. REDIRECCIÓN AUTOMÁTICA AL FORMULARIO LABORAL
        echo "
        <script>
            alert('Datos personales guardados correctamente. Pasemos al registro laboral.');
            window.location.href = '../vista/Registro laboral.html';
        </script>
        ";
        exit();



        
         
   


       
        

    
?>


