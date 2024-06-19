// Notificacion Crear Cuenta - Registro
function notiCamposVaciosRegistro(){
    Swal.fire({
        title: "No puedes Iniciar Sesión",
        text: "Todos los campos son obligatorios",
        icon: "info"
    });
}

function notiErrorRegistro(){
    Swal.fire({
        title: "Registro Fallido",
        text: "Ha ocurrido un error, intentelo nuevamente",
        icon: "error"
        });
}

function notiEmailYaExiste(){
    Swal.fire({
        title: "No puedes Registrarte",
        text: "El email ya exite",
        icon: "error"
        });
}

function notiRegistroExitoso(){
    Swal.fire({
        icon: "success",
        title: "Registro Exitoso",
        text: "Inicia Sesion, Tu DashBoard te espera!",
        timer: 4000
    })
}




// Notificacion Iniciar Sesion

function notiLoginAutorizado(){
    Swal.fire({
        icon: "success",
        title: "Acceso autorizado",
        text: "Tu panel de control te espera!",
        timer: 4000
    });
}

function notiCamposVaciosLogin(){
    Swal.fire({
        title: "No puedes Iniciar Sesión",
        text: "Todos los campos son obligatorios",
        icon: "info"
    });

}

function notiNoExisteEmailLogin(){
    Swal.fire({
        title: "No puedes Iniciar Sesión",
        text: "El email no existe, verifique e intente nuevamente",
        icon: "error"
    });
}

function notiCredencialesInvalidasLogin(){
    Swal.fire({
        title: "Inicio de Sesión Denegado",
        text: "Credenciales invalidas",
        icon: "error"
    });
}





// Notificaciones Crear Contacto
function notiCamposVaciosContacto(){
    Swal.fire({
        title: "Todos los campos son obligatorios",
        text: "A excepcion de direccion y foto",
        icon: "info"
    });
}


function notiErrorCargarFotoContacto(){
    Swal.fire({
        title: "Error al cargar la foto",
        text: "Ocurrio un error al cargar la foto",
        icon: "info"
    });
}

function notiSoloPNGoJPGContacto(){
    Swal.fire({
        title: "Foto Denegada",
        text: "Solo son permitidas las imagenes en JPG y PNG",
        icon: "info"
    });
}

function notiErrorProcesoCrearContacto(){
    Swal.fire({
        title: "Error al Agregar el Contacto",
        text: "Ha ocurrido un error en el proceso, intentelo nuevamente",
        icon: "error"
    });
}

function notiContactoAgregado(){
    Swal.fire({
        icon: "success",
        title: "Contacto Agregado",
        text: "El contacto fue agregado correctamente!",
        timer: 4000
    });
}



// Notificaciones Al Crear Grupo
function notiCamposVaciosGrupo(){
    Swal.fire({
        title: "Todos los campos son obligatorios",
        text: "A excepcion de la foto",
        icon: "info"
    });
}


function notiErrorCargarFotoGrupo(){
    Swal.fire({
        title: "Error al cargar la foto",
        text: "Ocurrio un error al cargar la foto",
        icon: "info"
    });
}

function notiSoloPNGoJPGGrupo(){
    Swal.fire({
        title: "Foto de Grupo Denegada",
        text: "Solo son permitidas las imagenes en JPG y PNG",
        icon: "info"
    });
}

function notiErrorCrearGrupo(){
    Swal.fire({
        title: "Error al Crear el Grupo",
        text: "Ha ocurrido un error en el proceso, intentelo nuevamente",
        icon: "error"
    });
}

function notiGrupoCreado(){
    Swal.fire({
        icon: "success",
        title: "Grupo Creado",
        text: "El grupo fue creado correctamente!",
        timer: 4000
    });
}



//Notificaciones al eleminar Contacto

function notiContactoEliminado(){
    Swal.fire({
        title: "Eliminado!",
        text: "El contacto fue eliminado.",
        icon: "success",
        timer: 2000
    });

}

function notiErrorEliminarContacto(){

    Swal.fire({
        title: "Error al eliminar!",
        text: "El contacto no fue eliminado.",
        icon: "error"
    });

}


// Notificaciones al editarContacto
function notiNoHayCambiosEditarContacto(){

    Swal.fire({
        title: "Solicitud denegada",
        text: "No hubo ninguna modificacion en el Contacto",
        icon: "info"
    });

}

function notiErrorCargarFotoEditarContacto(){

    Swal.fire({
        title: "No se pudo cargar la foto",
        text: "Ha ocurrido un error al cargar la foto, intentelo nuevamente",
        icon: "error"
    });

}

function notiSoloPNGoJPGEditarContacto(){

    Swal.fire({
        title: "Foto de Contacto Denegada",
        text: "Solo son permitidas las imagenes en JPG y PNG",
        icon: "info"
    });

}

function notiContactoEditado(){
    Swal.fire({
        icon: "success",
        title: "Contacto Modificado",
        text: "El contacto fue modificado correctamente!",
        timer: 3000
    });
}

function notiErrorAlEditarContacto(){

    Swal.fire({
        title: "Error al modificar Contacto",
        text: "Ha ocurrido un error en el proceso, intentelo nuevamente",
        icon: "error"
    });

}

function notiCamposVaciosEditarContacto(){

    Swal.fire({
        title: "Todos los campos son obligatorios",
        text: "A excepcion de la direccion, grupo y foto",
        icon: "info"
    });

}

// Notificaciones Eliminar Grupo

function notiGrupoEliminado(){

    Swal.fire({
        icon: "success",
        title: "Grupo Elimado Correctamente",
        text: "Los contantos del grupo, ahora son libres"
    });

}

function notiErrorEliminarGrupo(){

    Swal.fire({
        title: "Error al eliminar el Grupo",
        text: "Ha ocurrido un error en el proceso, intentelo nuevamente",
        icon: "error"
    });

}


// Notificacion Editar Grupo
function notiNoHayCambiosEditarGrupo(){

    Swal.fire({
        title: "Solicitud denegada",
        text: "No se detectaron cambios. No se realizo ninguna modificacion en el grupo.",
        icon: "info"
    });

}

function notiErrorCargarFotoEditarGrupo(){

    Swal.fire({
        title: "Error al cargar la foto",
        text: "Ocurrio un error al intentar cargar la foto. Por favor, intentelo nuevamente.",
        icon: "error"
    });

}

function notiSoloPNGoJPGEditarGrupo(){

    Swal.fire({
        title: "Foto de grupo denegada",
        text: "Solo se permiten imagenes en formato JPG y PNG.",
        icon: "info"
    });

}

function notiGrupoEditado(){
    Swal.fire({
        icon: "success",
        title: "Grupo modificado",
        text: "El grupo fue modificado correctamente.",
        timer: 3000
    });
}

function notiErrorAlEditarGrupo(){

    Swal.fire({
        title: "Error al modificar el grupo",
        text: "Ocurrió un error en el proceso. Por favor, intentelo nuevamente.",
        icon: "error"
    });

}

function notiCamposVaciosEditarGrupo(){

    Swal.fire({
        title: "Nombre del grupo vacio",
        text: "El nombre del grupo no puede estar en blanco. Por favor, ingrese un nombre.",
        icon: "info"
    });

}

