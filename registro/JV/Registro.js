document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("registroForm");
    const tablaCuerpo = document.querySelector(".tabla-registros tbody");
    
    // Variable para saber si estamos editando (guarda el índice del registro o null)
    let indiceEditando = null;

    // Cargar datos guardados al iniciar la página
    cargarRegistros();

    // 1. GUARDAR / MODIFICAR REGISTRO
    form.addEventListener("submit", (e) => {
        e.preventDefault();

        // Extraer los valores de los inputs en el orden exacto de las columnas de la tabla
        const inputs = form.querySelectorAll("input");
        
        // Mapeo rápido de valores (asegúrate de que el orden coincida con tus inputs del HTML)
        const nuevoRegistro = {
            apellidoPaterno: inputs[0].value,
            apellidoMaterno: inputs[1].value,
            nombre: inputs[2].value,
            rfc: inputs[4].value,
            curp: inputs[5].value,
            nacimiento: inputs[6].value,
            escolaridad: inputs[7].value,
            estadoCivil: inputs[8].value,
            colonia: inputs[9].value,
            calle: inputs[10].value,
            municipio: inputs[11].value,
            cp: inputs[12].value,
            celular: inputs[13].value,
        };

        // Validación simple de campos obligatorios vacíos
        if (!nuevoRegistro.nombre || !nuevoRegistro.idEmpleado) {
            alert("Por lo menos el Nombre y el ID de Empleado son obligatorios.");
            return;
        }

        let registros = obtenerRegistrosStorage();

        if (indiceEditando === null) {
            // Es un registro NUEVO
            registros.push(nuevoRegistro);
        } else {
            // Es una MODIFICACIÓN
            registros[indiceEditando] = nuevoRegistro;
            indiceEditando = null;
            form.querySelector('button[type="submit"]').textContent = "Guardar";
        }

        // Guardar en localStorage y actualizar tabla
        localStorage.setItem("registrosPersonas", JSON.stringify(registros));
        form.reset();
        cargarRegistros();
    });

    // Función para leer de LocalStorage
    function obtenerRegistrosStorage() {
        return JSON.parse(localStorage.getItem("registrosPersonas")) || [];
    }

    // Función para renderizar los datos en la Tabla
    function cargarRegistros() {
        let registros = obtenerRegistrosStorage();
        tablaCuerpo.innerHTML = ""; // Limpiar tabla actual

        registros.forEach((reg, index) => {
            const fila = document.createElement("tr");

            fila.innerHTML = `
                <td>${reg.idEmpleado}</td>
                <td>${reg.apellidoPaterno} ${reg.apellidoMaterno} ${reg.nombre}</td>
                <td>${reg.rfc}</td>
                <td>${reg.curp}</td>
                <td>${reg.nacimiento}</td>
                <td>${reg.escolaridad}</td>
                <td>${reg.estadoCivil}</td>
                <td>${reg.colonia} / ${reg.calle} / ${reg.municipio}</td>
                <td>${reg.cp}</td>
                <td>${reg.celular}</td>
                <td>
                    <button class="btn-editar" onclick="editarRegistro(${index})">✏️ Editar</button>
                    <button class="btn-eliminar" onclick="eliminarRegistro(${index})">🗑️ Eliminar</button>
                </td>
            `;
            tablaCuerpo.appendChild(fila);
        });
    }

    // 2. MODIFICAR (Cargar datos al formulario)
    window.editarRegistro = function(index) {
        let registros = obtenerRegistrosStorage();
        let reg = registros[index];
        const inputs = form.querySelectorAll("input");

        // Devolver los valores a los inputs del formulario
        inputs[0].value = reg.apellidoPaterno;
        inputs[1].value = reg.apellidoMaterno;
        inputs[2].value = reg.nombre;
        inputs[4].value = reg.rfc;
        inputs[5].value = reg.curp;
        inputs[6].value = reg.nacimiento;
        inputs[7].value = reg.escolaridad;
        inputs[8].value = reg.estadoCivil;
        inputs[9].value = reg.colonia;
        inputs[10].value = reg.calle;
        inputs[11].value = reg.municipio;
        inputs[12].value = reg.cp;
        inputs[13].value = reg.celular;

        indiceEditando = index;
        form.querySelector('button[type="submit"]').textContent = "Actualizar Cambios";
        window.scrollTo({ top: 0, behavior: 'smooth' }); // Subir al formulario suavemente
    };

    // 3. ELIMINAR REGISTRO
    window.eliminarRegistro = function(index) {
        if (confirm("¿Estás seguro de que deseas eliminar este registro?")) {
            let registros = obtenerRegistrosStorage();
            registros.splice(index, 1); // Quitar del arreglo
            localStorage.setItem("registrosPersonas", JSON.stringify(registros));
            cargarRegistros(); // Refrescar tabla
        }
    };
});