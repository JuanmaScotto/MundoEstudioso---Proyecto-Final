// Definimos las traducciones para cada idioma
// Definimos las traducciones para cada idioma
const traducciones = {
    en: {
        inicio: "Home",
        nosotros: "About Us",
        historia: "History",
        juveniles: "Mainors Leagues",
        galeria: "Gallery",
        planteles: "Teams",
        primera: "First",
        sub18: "U-18",
        sub16: "U-16",
        login: "Login",
        signup: "Signup",
        orgulloso: "Proud of your colors",
        ubicacion: "Location of E.S.F.C",
        nosotros: "About Us"
    },
    es: {
        inicio: "Inicio",
        nosotros: "Nosotros",
        historia: "Historia",
        juveniles: "Juveniles",
        galeria: "Galería",
        planteles: "Planteles",
        primera: "Primera",
        sub18: "Sub-18",
        sub16: "Sub-16",
        login: "Login",
        signup: "Signup",
        orgulloso: "Orgulloso de tus colores",
        ubicacion: "Ubicación de E.S.F.C",
        nosotros: "NOSOTROS"
    }
};

let idiomaActual = 'es'; // Por defecto, el idioma es español

// Función para cambiar el idioma
function cambiarIdioma() {
    // Cambiar idioma
    idiomaActual = idiomaActual === 'es' ? 'en' : 'es';

    // Cambiar todos los textos según el idioma seleccionado
    document.querySelectorAll('[data-translate]').forEach((elemento) => {
        const clave = elemento.getAttribute('data-translate');
        elemento.textContent = traducciones[idiomaActual][clave];
    });

    // No cambiamos el contenido del botón, solo mantenemos el icono del mundo
}

// El resto del código que tienes en tu archivo
let menuVisible = false;
//Función que oculta o muestra el menú
function mostrarOcultarMenu(){
    if(menuVisible){
        document.getElementById("nav").classList = "";
        menuVisible = false;
    }else{
        document.getElementById("nav").classList = "responsive";
        menuVisible = true;
    }
}
function seleccionar(){
    // Oculto el menú una vez que selecciono una opción
    document.getElementById("nav").classList = "";
    menuVisible = false;
}
document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault(); 

    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;

    window.location.href = 'correcto.html?username=' + encodeURIComponent(username) + '&password=' + encodeURIComponent(password);
});