const logo = document.getElementById('iconoMenu');
const barraLateral = document.querySelector(".barraLateral");
const spans = document.querySelectorAll("span");

const main = document.querySelector("main");

logo.addEventListener("click", () => {

    barraLateral.classList.toggle("miniBarraLateral");
    main.classList.toggle("min-main");
    
    spans.forEach((span) => {
        span.classList.toggle("oculto");
    });

});




const menuResponsivo = document.querySelector(".menuResponsivo");

menuResponsivo.addEventListener("click", () => {
    barraLateral.classList.toggle("maxBarraLateral");

    if(barraLateral.classList.contains("maxBarraLateral")) {
        menuResponsivo.children[0].style.display = "none";
        menuResponsivo.children[1].style.display = "block";
    }
    else {
        menuResponsivo.children[0].style.display = "block";
        menuResponsivo.children[1].style.display = "none";
    }

    if(window.innerWidth <= 320) {
        barraLateral.classList.add("miniBarraLateral");
        main.classList.add("min-main");
        spans.forEach((span) => {
            span.classList.add("oculto");
        })
    }
});


// ------------------ Obtener Fecha --------------------
function updateDateTime() {
    const now = new Date();
    const monthNames = ["enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"];
    
    // Formatear la fecha
    const day = now.getDate();
    const month = monthNames[now.getMonth()];
    const year = now.getFullYear();
    const formattedDate = `${day} de ${month} del ${year}`;

    // Formatear la hora en 12 horas con AM/PM
    let hours = now.getHours();
    const minutes = String(now.getMinutes()).padStart(2, '0');
    const ampm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12;
    hours = hours ? hours : 12; // La hora '0' debe ser '12'
    const formattedTime = `${hours}:${minutes} ${ampm}`;

    // Insertar la fecha y hora en el HTML
    document.getElementById('fecha').textContent = formattedDate;
    document.getElementById('hora').textContent = formattedTime;
}

// Actualizar la fecha y hora inmediatamente
updateDateTime();

// Actualizar la hora cada minuto
setInterval(updateDateTime, 60000);





// Función para buscar en una tabla específica
function setupTableSearch(inputSelector, tableSelector) {
    document.addEventListener('DOMContentLoaded', (event) => {
        const searchInput = document.querySelector(inputSelector);
        const tableRows = document.querySelectorAll(tableSelector + ' tbody tr');

        searchInput.addEventListener('input', () => {
            const searchText = searchInput.value.toLowerCase();
            
            tableRows.forEach(row => {
                const rowData = row.textContent.toLowerCase();
                const match = rowData.indexOf(searchText) !== -1;
                row.style.display = match ? '' : 'none';
            });

            // Re-apply striping after filtering
            let visibleRows = Array.from(tableRows).filter(row => row.style.display !== 'none');
            visibleRows.forEach((row, index) => {
                row.style.backgroundColor = index % 2 === 0 ? 'var(--gris1)' : 'var(--blanco)';
            });
        });
    });
}

// Configurar búsqueda para contactos
setupTableSearch('.misContactos .buscador input', '.misContactos .tabla table');

// Configurar búsqueda para grupos
setupTableSearch('.misGrupos .buscador input', '.misGrupos .tabla table');

// Configurar búsqueda para Filtrados Contactos
setupTableSearch('.contactosFiltrado .buscador input', '.contactosFiltrado .tabla table');



//Mostrar foto cargada - Agregar Contacto
function mostrarFotoSeleccionadaContacto(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('fotoMostrada').src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]); // Convierte la imagen a una URL de datos
    }
}

//Mostrar foto cargada - Crear Grupo
function mostrarFotoSeleccionadaGrupo(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('fotoMostradaGrupo').src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]); // Convierte la imagen a una URL de datos
    }
}

//Mostrar foto cargada - Editar Contacto
function mostrarFotoEditarContacto(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('fotoEditarContacto').src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]); // Convierte la imagen a una URL de datos
    }
}


//Mostrar foto cargada - Editar Grupo
function mostrarFotoEditarGrupo(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('fotoDelGrupo').src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]); // Convierte la imagen a una URL de datos
    }
}









// MOSTRAR OCULTAR CAJAS DIVS
const cajaBienvenida = document.getElementById("bienvenida");
const cajaCalendario = document.getElementById("calendario");
const cajaContador = document.getElementById("contador");
const cajaMisContactos = document.getElementById("misContactos");
const cajaSubMenuContactos = document.getElementById("cajaSubMenuContactos");

const cajaMisGrupos = document.getElementById("misGrupos");
const cajaCrearContacto = document.getElementById("crearContacto");
const cajaCrearGrupo = document.getElementById("crearGrupo");
const cajaMiCuenta = document.getElementById("miCuenta");
const cajaContactosFiltrado = document.getElementById("contactosFiltrado");

const cajaEditarContacto = document.getElementById("editarContacto");
const cajaEditarGrupo = document.getElementById("editarGrupo");


//Botones


const bbotonCrearContacto = document.getElementById("botonCrearContacto");
const bbotonCrearGrupo = document.getElementById("botonCrearGrupo");

const bbotonDashboard = document.getElementById("botonDashboard");
const bbotonMisContactos = document.getElementById("botonMisContactos");
const bbotonMisGrupos = document.getElementById("botonMisGrupos");
const bbotonMiCuenta = document.getElementById("botonMiCuenta");


function botonCrearContacto(){

    cajaBienvenida.style.display = 'none';
    cajaCalendario.style.display = 'none';
    cajaContador.style.display = 'none';
    cajaMisContactos.style.display = 'none';
    cajaMisGrupos.style.display = 'none';

    cajaCrearContacto.style.display = 'block';

    cajaCrearGrupo.style.display = 'none';
    cajaMiCuenta.style.display = 'none';
    cajaContactosFiltrado.style.display = 'none';
    cajaEditarContacto.style.display = 'none';
    cajaEditarGrupo.style.display = 'none';

}

function botonCrearGrupo(){

    cajaBienvenida.style.display = 'none';
    cajaCalendario.style.display = 'none';
    cajaContador.style.display = 'none';
    cajaMisContactos.style.display = 'none';
    cajaMisGrupos.style.display = 'none';
    cajaCrearContacto.style.display = 'none';

    cajaCrearGrupo.style.display = 'block';

    cajaMiCuenta.style.display = 'none';
    cajaContactosFiltrado.style.display = 'none';
    cajaEditarContacto.style.display = 'none';
    cajaEditarGrupo.style.display = 'none';
    
}

function botonDashboard(){

    cajaBienvenida.style.display = 'block';
    cajaCalendario.style.display = 'flex';
    cajaContador.style.display = 'flex';
    cajaMisContactos.style.display = 'block';
    cajaMisGrupos.style.display = 'block';

    cajaCrearContacto.style.display = 'none';

    cajaCrearGrupo.style.display = 'none';
    cajaMiCuenta.style.display = 'none';
    cajaContactosFiltrado.style.display = 'none';
    cajaEditarContacto.style.display = 'none';
    cajaEditarGrupo.style.display = 'none';

}

function botonMisContactos(){

    cajaBienvenida.style.display = 'none';
    cajaCalendario.style.display = 'none';
    cajaContador.style.display = 'none';

    cajaMisContactos.style.display = 'block';

    cajaMisGrupos.style.display = 'none';
    cajaCrearContacto.style.display = 'none';
    cajaCrearGrupo.style.display = 'none';
    cajaMiCuenta.style.display = 'none';
    cajaContactosFiltrado.style.display = 'none';
    cajaEditarContacto.style.display = 'none';
    cajaEditarGrupo.style.display = 'none';

}

function botonSubMenuContactos() {
    var icono = document.getElementById("iconoVerTodosGrupos");
    var cajaSubMenu = document.getElementById("cajaSubMenuContactos");

    // Alternar la visibilidad del menú
    var isVisible = cajaSubMenu.style.display === "block";
    if (!isVisible) {
        cajaSubMenu.style.display = "block";
        icono.setAttribute("name", "chevron-up");
        localStorage.setItem("menuVisible", "true");
    } else {
        cajaSubMenu.style.display = "none";
        icono.setAttribute("name", "chevron-down");
        localStorage.setItem("menuVisible", "false");
    }
}

// Restaurar el estado del mmenu y del ícono al cargar la pagina
window.onload = function() {
    var icono = document.getElementById("iconoVerTodosGrupos");
    var cajaSubMenu = document.getElementById("cajaSubMenuContactos");
    var menuVisible = localStorage.getItem("menuVisible") === "true";

    if (menuVisible) {
        cajaSubMenu.style.display = "block";
        icono.setAttribute("name", "chevron-up");
    } else {
        cajaSubMenu.style.display = "none";
        icono.setAttribute("name", "chevron-down");
    }
};



function inicializarMenu() {
    var cajaSubMenu = document.getElementById("cajaSubMenuContactos");
    var menuVisible = localStorage.getItem("menuVisible");

    if (menuVisible === "true") {
        cajaSubMenu.style.display = "block";
    } else {
        cajaSubMenu.style.display = "none";
    }
}

document.addEventListener("DOMContentLoaded", inicializarMenu);




function botonMisGrupos(){

    cajaBienvenida.style.display = 'none';
    cajaCalendario.style.display = 'none';
    cajaContador.style.display = 'none';
    cajaMisContactos.style.display = 'none';

    cajaMisGrupos.style.display = 'block';

    cajaCrearContacto.style.display = 'none';
    cajaCrearGrupo.style.display = 'none';
    cajaMiCuenta.style.display = 'none';
    cajaContactosFiltrado.style.display = 'none';
    cajaEditarContacto.style.display = 'none';
    cajaEditarGrupo.style.display = 'none';

}

function botonMiCuenta(){

    cajaBienvenida.style.display = 'none';
    cajaCalendario.style.display = 'none';
    cajaContador.style.display = 'none';
    cajaMisContactos.style.display = 'none';
    cajaMisGrupos.style.display = 'none';
    cajaCrearContacto.style.display = 'none';
    cajaCrearGrupo.style.display = 'none';

    cajaMiCuenta.style.display = 'block';

    cajaContactosFiltrado.style.display = 'none';
    cajaEditarContacto.style.display = 'none';
    cajaEditarGrupo.style.display = 'none';

}


function mostrarContactoFiltrado() {

    cajaBienvenida.style.display = 'none';
    cajaCalendario.style.display = 'none';
    cajaContador.style.display = 'none';

    cajaMisContactos.style.display = 'none';

    cajaMisGrupos.style.display = 'none';
    cajaCrearContacto.style.display = 'none';
    cajaCrearGrupo.style.display = 'none';
    cajaMiCuenta.style.display = 'none';
    cajaContactosFiltrado.style.display = 'block';
    cajaEditarContacto.style.display = 'none';
    cajaEditarGrupo.style.display = 'none';

}


//Funcion Editar Contacto
function editarContacto(idContacto, nombresContacto, apellidosContacto, celularContacto, emailContacto, direccionContacto, idGrupoContacto, rutaFotoContacto, fotoContacto){

    cajaBienvenida.style.display = 'none';
    cajaCalendario.style.display = 'none';
    cajaContador.style.display = 'none';
    cajaMisContactos.style.display = 'none';
    cajaMisGrupos.style.display = 'none';
    cajaCrearContacto.style.display = 'none';
    cajaCrearGrupo.style.display = 'none';
    cajaMiCuenta.style.display = 'none';
    cajaContactosFiltrado.style.display = 'none';

    cajaEditarContacto.style.display = 'block';
    cajaEditarGrupo.style.display = 'none';

    document.getElementById("editarIdContacto").value = idContacto;
    document.getElementById("editarNombresContacto").value = nombresContacto;
    document.getElementById("editarApellidosContacto").value = apellidosContacto;
    document.getElementById("editarCelularContacto").value = celularContacto;
    document.getElementById("editarEmailContacto").value = emailContacto;
    document.getElementById("editarDireccionContacto").value = direccionContacto;
    document.getElementById("editarIdGrupoContacto").value = idGrupoContacto;
    document.getElementById("editarFotoContacto").value = fotoContacto;




    // Seleccionar el grupo en el selector
    var selectorGrupo = document.getElementById("selectorGrupo");
    var grupoEncontrado = false;

    // Iterar sobre las opciones del selector
    for (var i = 0; i < selectorGrupo.options.length; i++) {
        if (selectorGrupo.options[i].value == idGrupoContacto) {
            selectorGrupo.options[i].selected = true;
            grupoEncontrado = true;
            break;
        }
    }

    // Si no se encontró el grupo, seleccionar la opción con valor 0
    if (!grupoEncontrado) {
        selectorGrupo.value = "0";
    }


    //Controlar Los Botones
    if(fotoContacto == ""){

        document.getElementById("fotoEditarContacto").src = rutaFotoContacto;
        document.getElementById("botonAgregarFoto").value = 'Agregar Foto';


    } else {

        document.getElementById("fotoEditarContacto").src = rutaFotoContacto;
        document.getElementById("botonAgregarFoto").value = 'Cambiar Foto';

    }

}

//Eliminar Contacto
function eliminarContacto(idContacto){
    Swal.fire({
        title: "¿Desea eliminar este Contacto?",
        text: "Esta acción es irreversible",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, Eliminar!",
        cancelButtonText: "No Eliminar"
      }).then((result) => {
        if (result.isConfirmed) {

            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '../../acciones/contactos/procesar_eliminar.php';

            // Crear input oculto para enviar el ID del contacto
            const inputId = document.createElement('input');
            inputId.type = 'hidden';
            inputId.name = 'idContacto';
            inputId.value = idContacto;

            // Adjuntar input al formulario
            form.appendChild(inputId);

            // Adjuntar formulario al documento y enviarlo
            document.body.appendChild(form);
            form.submit();

        }
      });

}


//Editar Grupo
function editarGrupo(idGrupo, nombreGrupo, descripcionGrupo, fotoGrupo, rutaFotoGrupo){

    cajaBienvenida.style.display = 'none';
    cajaCalendario.style.display = 'none';
    cajaContador.style.display = 'none';
    cajaMisContactos.style.display = 'none';
    cajaMisGrupos.style.display = 'none';
    cajaCrearContacto.style.display = 'none';
    cajaCrearGrupo.style.display = 'none';
    cajaMiCuenta.style.display = 'none';
    cajaContactosFiltrado.style.display = 'none';

    cajaEditarContacto.style.display = 'none';
    cajaEditarGrupo.style.display = 'block';

    document.getElementById("idGrupo").value = idGrupo;
    document.getElementById("nombreGrupo").value = nombreGrupo;
    document.getElementById("descripcionGrupo").value = descripcionGrupo;
    document.getElementById("rutaGrupo").value = fotoGrupo;

    if(fotoGrupo == ""){

        document.getElementById("agregarFotoGrupo").value = "Agregar Foto";
        document.getElementById("fotoDelGrupo").src = rutaFotoGrupo;

    } else {

        document.getElementById("agregarFotoGrupo").value = "Cambiar Foto";
        document.getElementById("fotoDelGrupo").src = rutaFotoGrupo;

    }


}


//EliminarGrupo
function eliminarGrupo(idGrupo){

    Swal.fire({
        title: "¿Desea eliminar este Grupo?",
        text: "Los contactos de este, quedaran sin grupo",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, Eliminar!",
        cancelButtonText: "No Eliminar"
      }).then((result) => {
        if (result.isConfirmed) {

            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '../../acciones/grupos/procesar_eliminar.php';

            // Crear input oculto para enviar el ID del contacto
            const inputId = document.createElement('input');
            inputId.type = 'hidden';
            inputId.name = 'idGrupo';
            inputId.value = idGrupo;

            // Adjuntar input al formulario
            form.appendChild(inputId);

            // Adjuntar formulario al documento y enviarlo
            document.body.appendChild(form);
            form.submit();

        }
      });

}


// Salir de mi Cuenta
function salirDeMiCuenta(nombreUsuario){
    Swal.fire({
        title: nombreUsuario,
        text: "¿Deseas cerrar Sesión?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, cerrar sesión",
        cancelButtonText: "No"
      }).then((result) => {
        if (result.isConfirmed) {
          
            window.location.href = '../../acciones/usuarios/cerrar_sesion.php';

        }
    });
}