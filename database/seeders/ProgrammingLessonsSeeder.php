<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\User;

class ProgrammingLessonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teacher = User::where('role', 'teacher')->first();
        
        $lessons = [
            [
                'title' => 'Introducción a la Programación',
                'description' => 'Conceptos básicos de programación, algoritmos y lógica computacional.',
                'content' => '<h2>¿Qué es la Programación?</h2>
                <p>La programación es el proceso de crear instrucciones para que una computadora ejecute tareas específicas. Es como escribir una receta muy detallada que la máquina puede seguir paso a paso.</p>
                
                <h3>Conceptos Fundamentales:</h3>
                <ul>
                    <li><strong>Algoritmo:</strong> Secuencia de pasos lógicos para resolver un problema</li>
                    <li><strong>Código:</strong> Instrucciones escritas en un lenguaje que la computadora entiende</li>
                    <li><strong>Bug:</strong> Error en el código que causa comportamiento inesperado</li>
                    <li><strong>Debug:</strong> Proceso de encontrar y corregir errores</li>
                </ul>
                
                <h3>Ejemplo de Algoritmo:</h3>
                <pre><code>1. Tomar dos números
2. Sumarlos
3. Mostrar el resultado</code></pre>
                
                <h3>Actividad Práctica:</h3>
                <p>Escribe un algoritmo para hacer un sándwich paso a paso.</p>',
                'points' => 10,
                'difficulty_level' => 'beginner',
                'duration_minutes' => 30,
                'resources' => ['https://scratch.mit.edu/', 'https://code.org/'],
                'order' => 1
            ],
            [
                'title' => 'Variables y Tipos de Datos',
                'description' => 'Aprende a almacenar y manipular información en tu programa.',
                'content' => '<h2>Variables: Cajas de Almacenamiento</h2>
                <p>Una variable es como una caja donde puedes guardar información. Cada caja tiene un nombre y puede contener diferentes tipos de datos.</p>
                
                <h3>Tipos de Datos Básicos:</h3>
                <ul>
                    <li><strong>Números enteros:</strong> 1, 42, -5</li>
                    <li><strong>Números decimales:</strong> 3.14, 2.5, -1.8</li>
                    <li><strong>Texto (strings):</strong> "Hola", "Programación"</li>
                    <li><strong>Booleanos:</strong> true (verdadero) o false (falso)</li>
                </ul>
                
                <h3>Ejemplos en JavaScript:</h3>
                <pre><code>let nombre = "Juan";
let edad = 25;
let altura = 1.75;
let esEstudiante = true;</code></pre>
                
                <h3>Ejercicio:</h3>
                <p>Crea variables para almacenar tu información personal: nombre, edad, ciudad y si tienes mascota.</p>',
                'points' => 15,
                'difficulty_level' => 'beginner',
                'duration_minutes' => 45,
                'resources' => ['https://developer.mozilla.org/es/docs/Web/JavaScript/Guide'],
                'order' => 2
            ],
            [
                'title' => 'Operadores Aritméticos',
                'description' => 'Realiza cálculos matemáticos en tus programas.',
                'content' => '<h2>Matemáticas en Programación</h2>
                <p>Los operadores aritméticos te permiten realizar cálculos matemáticos con números.</p>
                
                <h3>Operadores Básicos:</h3>
                <ul>
                    <li><strong>+</strong> Suma: 5 + 3 = 8</li>
                    <li><strong>-</strong> Resta: 10 - 4 = 6</li>
                    <li><strong>*</strong> Multiplicación: 6 * 7 = 42</li>
                    <li><strong>/</strong> División: 15 / 3 = 5</li>
                    <li><strong>%</strong> Módulo (residuo): 17 % 5 = 2</li>
                </ul>
                
                <h3>Ejemplos Prácticos:</h3>
                <pre><code>let precio = 100;
let descuento = 15;
let precioFinal = precio - (precio * descuento / 100);
// precioFinal = 85</code></pre>
                
                <h3>Orden de Operaciones:</h3>
                <p>Se siguen las reglas matemáticas: paréntesis, multiplicación/división, suma/resta.</p>
                
                <h3>Desafío:</h3>
                <p>Calcula el área de un círculo con radio 5. (Fórmula: π * r²)</p>',
                'points' => 15,
                'difficulty_level' => 'beginner',
                'duration_minutes' => 40,
                'resources' => ['https://www.w3schools.com/js/js_operators.asp'],
                'order' => 3
            ],
            [
                'title' => 'Estructuras Condicionales (if/else)',
                'description' => 'Toma decisiones en tu código basadas en condiciones.',
                'content' => '<h2>Tomando Decisiones</h2>
                <p>Las estructuras condicionales permiten que tu programa tome diferentes caminos según las condiciones que establezcas.</p>
                
                <h3>Estructura Básica if:</h3>
                <pre><code>if (condición) {
    // código si la condición es verdadera
}</code></pre>
                
                <h3>Estructura if-else:</h3>
                <pre><code>if (edad >= 18) {
    console.log("Eres mayor de edad");
} else {
    console.log("Eres menor de edad");
}</code></pre>
                
                <h3>Múltiples Condiciones:</h3>
                <pre><code>if (nota >= 90) {
    calificacion = "A";
} else if (nota >= 80) {
    calificacion = "B";
} else if (nota >= 70) {
    calificacion = "C";
} else {
    calificacion = "F";
}</code></pre>
                
                <h3>Operadores de Comparación:</h3>
                <ul>
                    <li><strong>==</strong> Igual a</li>
                    <li><strong>!=</strong> Diferente de</li>
                    <li><strong>></strong> Mayor que</li>
                    <li><strong><</strong> Menor que</li>
                    <li><strong>>=</strong> Mayor o igual que</li>
                    <li><strong><=</strong> Menor o igual que</li>
                </ul>',
                'points' => 20,
                'difficulty_level' => 'beginner',
                'duration_minutes' => 50,
                'resources' => ['https://www.w3schools.com/js/js_if_else.asp'],
                'order' => 4
            ],
            [
                'title' => 'Bucles (Loops)',
                'description' => 'Repite acciones automáticamente con bucles for y while.',
                'content' => '<h2>Repetición Automática</h2>
                <p>Los bucles te permiten repetir código múltiples veces sin escribirlo una y otra vez.</p>
                
                <h3>Bucle for:</h3>
                <pre><code>for (let i = 1; i <= 10; i++) {
    console.log("Número: " + i);
}</code></pre>
                
                <h3>Bucle while:</h3>
                <pre><code>let contador = 1;
while (contador <= 5) {
    console.log("Vuelta " + contador);
    contador++;
}</code></pre>
                
                <h3>Bucle foreach (para arrays):</h3>
                <pre><code>let frutas = ["manzana", "banana", "naranja"];
frutas.forEach(function(fruta) {
    console.log("Me gusta la " + fruta);
});</code></pre>
                
                <h3>Cuándo usar cada uno:</h3>
                <ul>
                    <li><strong>for:</strong> Cuando sabes cuántas veces repetir</li>
                    <li><strong>while:</strong> Cuando la repetición depende de una condición</li>
                    <li><strong>foreach:</strong> Para recorrer listas/arrays</li>
                </ul>
                
                <h3>Ejercicio:</h3>
                <p>Crea un bucle que imprima los números pares del 2 al 20.</p>',
                'points' => 25,
                'difficulty_level' => 'intermediate',
                'duration_minutes' => 60,
                'resources' => ['https://www.w3schools.com/js/js_loop_for.asp'],
                'order' => 5
            ],
            [
                'title' => 'Funciones',
                'description' => 'Organiza tu código en bloques reutilizables.',
                'content' => '<h2>Funciones: Bloques de Código Reutilizable</h2>
                <p>Una función es como una mini-máquina que recibe datos, los procesa y devuelve un resultado.</p>
                
                <h3>Declarar una Función:</h3>
                <pre><code>function saludar(nombre) {
    return "¡Hola, " + nombre + "!";
}

// Usar la función
let mensaje = saludar("Ana");
console.log(mensaje); // ¡Hola, Ana!</code></pre>
                
                <h3>Función sin Parámetros:</h3>
                <pre><code>function obtenerFechaActual() {
    return new Date().toLocaleDateString();
}</code></pre>
                
                <h3>Función con Múltiples Parámetros:</h3>
                <pre><code>function calcularArea(largo, ancho) {
    return largo * ancho;
}

let area = calcularArea(5, 3); // 15</code></pre>
                
                <h3>Funciones Flecha (ES6):</h3>
                <pre><code>const sumar = (a, b) => a + b;
const cuadrado = x => x * x;</code></pre>
                
                <h3>Ventajas de las Funciones:</h3>
                <ul>
                    <li>Reutilización de código</li>
                    <li>Organización mejor</li>
                    <li>Fácil mantenimiento</li>
                    <li>Testing más simple</li>
                </ul>',
                'points' => 30,
                'difficulty_level' => 'intermediate',
                'duration_minutes' => 70,
                'resources' => ['https://www.w3schools.com/js/js_functions.asp'],
                'order' => 6
            ],
            [
                'title' => 'Arrays (Listas)',
                'description' => 'Almacena múltiples valores en una sola variable.',
                'content' => '<h2>Arrays: Listas de Datos</h2>
                <p>Un array es como una estantería donde puedes guardar múltiples elementos ordenados.</p>
                
                <h3>Crear Arrays:</h3>
                <pre><code>let numeros = [1, 2, 3, 4, 5];
let frutas = ["manzana", "banana", "naranja"];
let mixto = [1, "texto", true, 3.14];</code></pre>
                
                <h3>Acceder a Elementos:</h3>
                <pre><code>console.log(frutas[0]); // "manzana"
console.log(frutas[1]); // "banana"
console.log(frutas.length); // 3</code></pre>
                
                <h3>Métodos Útiles:</h3>
                <pre><code>// Agregar elementos
frutas.push("uva"); // al final
frutas.unshift("kiwi"); // al inicio

// Eliminar elementos
frutas.pop(); // del final
frutas.shift(); // del inicio

// Buscar elementos
let posicion = frutas.indexOf("banana"); // 1

// Unir elementos
let texto = frutas.join(", "); // "manzana, banana, naranja"</code></pre>
                
                <h3>Recorrer Arrays:</h3>
                <pre><code>for (let i = 0; i < frutas.length; i++) {
    console.log(frutas[i]);
}

// O más moderno:
frutas.forEach(fruta => console.log(fruta));</code></pre>',
                'points' => 25,
                'difficulty_level' => 'intermediate',
                'duration_minutes' => 55,
                'resources' => ['https://www.w3schools.com/js/js_arrays.asp'],
                'order' => 7
            ],
            [
                'title' => 'Objetos',
                'description' => 'Agrupa datos relacionados usando objetos.',
                'content' => '<h2>Objetos: Agrupando Información</h2>
                <p>Un objeto es como una ficha que contiene diferentes datos relacionados sobre algo específico.</p>
                
                <h3>Crear Objetos:</h3>
                <pre><code>let persona = {
    nombre: "María",
    edad: 28,
    ciudad: "Madrid",
    esEstudiante: false
};</code></pre>
                
                <h3>Acceder a Propiedades:</h3>
                <pre><code>console.log(persona.nombre); // "María"
console.log(persona["edad"]); // 28</code></pre>
                
                <h3>Modificar Propiedades:</h3>
                <pre><code>persona.edad = 29;
persona.profesion = "Programadora";
delete persona.esEstudiante;</code></pre>
                
                <h3>Métodos en Objetos:</h3>
                <pre><code>let calculadora = {
    sumar: function(a, b) {
        return a + b;
    },
    restar: function(a, b) {
        return a - b;
    }
};

console.log(calculadora.sumar(5, 3)); // 8</code></pre>
                
                <h3>Recorrer Objetos:</h3>
                <pre><code>for (let propiedad in persona) {
    console.log(propiedad + ": " + persona[propiedad]);
}</code></pre>
                
                <h3>Ejemplo Práctico:</h3>
                <p>Crea un objeto "auto" con propiedades como marca, modelo, año y un método para mostrar información.</p>',
                'points' => 30,
                'difficulty_level' => 'intermediate',
                'duration_minutes' => 65,
                'resources' => ['https://www.w3schools.com/js/js_objects.asp'],
                'order' => 8
            ],
            [
                'title' => 'Manipulación del DOM',
                'description' => 'Interactúa con páginas web usando JavaScript.',
                'content' => '<h2>DOM: Controlando Páginas Web</h2>
                <p>El DOM (Document Object Model) te permite modificar el contenido de una página web con JavaScript.</p>
                
                <h3>Seleccionar Elementos:</h3>
                <pre><code>// Por ID
let titulo = document.getElementById("mi-titulo");

// Por clase
let botones = document.getElementsByClassName("btn");

// Por selector CSS
let primer_parrafo = document.querySelector("p");
let todos_parrafos = document.querySelectorAll("p");</code></pre>
                
                <h3>Modificar Contenido:</h3>
                <pre><code>titulo.textContent = "Nuevo título";
titulo.innerHTML = "<strong>Título en negrita</strong>";

// Cambiar estilos
titulo.style.color = "blue";
titulo.style.fontSize = "24px";</code></pre>
                
                <h3>Eventos:</h3>
                <pre><code>let boton = document.querySelector("#mi-boton");
boton.addEventListener("click", function() {
    alert("¡Botón clickeado!");
});

// Evento de formulario
document.querySelector("form").addEventListener("submit", function(e) {
    e.preventDefault(); // Evita envío automático
    console.log("Formulario enviado");
});</code></pre>
                
                <h3>Crear Elementos:</h3>
                <pre><code>let nuevoDiv = document.createElement("div");
nuevoDiv.textContent = "Nuevo contenido";
document.body.appendChild(nuevoDiv);</code></pre>
                
                <h3>Proyecto Práctico:</h3>
                <p>Crea una lista de tareas donde puedas agregar y eliminar elementos dinámicamente.</p>',
                'points' => 35,
                'difficulty_level' => 'intermediate',
                'duration_minutes' => 80,
                'resources' => ['https://www.w3schools.com/js/js_htmldom.asp'],
                'order' => 9
            ],
            [
                'title' => 'Eventos en JavaScript',
                'description' => 'Responde a interacciones del usuario.',
                'content' => '<h2>Eventos: Respondiendo a Acciones</h2>
                <p>Los eventos te permiten que tu programa responda cuando el usuario hace algo como hacer clic, escribir o mover el mouse.</p>
                
                <h3>Tipos de Eventos Comunes:</h3>
                <ul>
                    <li><strong>click:</strong> Usuario hace clic</li>
                    <li><strong>submit:</strong> Envío de formulario</li>
                    <li><strong>keydown/keyup:</strong> Presionar/soltar tecla</li>
                    <li><strong>mouseover/mouseout:</strong> Mouse entra/sale</li>
                    <li><strong>load:</strong> Página terminó de cargar</li>
                </ul>
                
                <h3>Agregar Event Listeners:</h3>
                <pre><code>// Método moderno (recomendado)
button.addEventListener("click", function() {
    console.log("¡Click!");
});

// Con función flecha
button.addEventListener("click", () => {
    console.log("¡Click con arrow function!");
});</code></pre>
                
                <h3>Objeto Event:</h3>
                <pre><code>input.addEventListener("keydown", function(event) {
    console.log("Tecla presionada: " + event.key);
    
    if (event.key === "Enter") {
        console.log("¡Presionaste Enter!");
    }
});</code></pre>
                
                <h3>Prevenir Comportamiento Por Defecto:</h3>
                <pre><code>form.addEventListener("submit", function(event) {
    event.preventDefault(); // No enviar formulario
    // Tu código personalizado aquí
});</code></pre>
                
                <h3>Ejemplo Interactivo:</h3>
                <pre><code>let contador = 0;
let display = document.getElementById("contador");

document.getElementById("incrementar").addEventListener("click", () => {
    contador++;
    display.textContent = contador;
});</code></pre>',
                'points' => 30,
                'difficulty_level' => 'intermediate',
                'duration_minutes' => 60,
                'resources' => ['https://www.w3schools.com/js/js_events.asp'],
                'order' => 10
            ],
            [
                'title' => 'Formularios y Validación',
                'description' => 'Captura y valida datos del usuario.',
                'content' => '<h2>Formularios: Capturando Datos</h2>
                <p>Los formularios son la principal forma de obtener información del usuario en aplicaciones web.</p>
                
                <h3>HTML del Formulario:</h3>
                <pre><code>&lt;form id="mi-formulario"&gt;
    &lt;input type="text" id="nombre" placeholder="Nombre" required&gt;
    &lt;input type="email" id="email" placeholder="Email" required&gt;
    &lt;input type="number" id="edad" placeholder="Edad" min="1" max="120"&gt;
    &lt;button type="submit"&gt;Enviar&lt;/button&gt;
&lt;/form&gt;</code></pre>
                
                <h3>Capturar Datos:</h3>
                <pre><code>document.getElementById("mi-formulario").addEventListener("submit", function(e) {
    e.preventDefault();
    
    let nombre = document.getElementById("nombre").value;
    let email = document.getElementById("email").value;
    let edad = document.getElementById("edad").value;
    
    console.log({nombre, email, edad});
});</code></pre>
                
                <h3>Validación Personalizada:</h3>
                <pre><code>function validarFormulario() {
    let nombre = document.getElementById("nombre").value;
    let email = document.getElementById("email").value;
    
    if (nombre.length < 2) {
        alert("El nombre debe tener al menos 2 caracteres");
        return false;
    }
    
    if (!email.includes("@")) {
        alert("Email inválido");
        return false;
    }
    
    return true;
}</code></pre>
                
                <h3>Mostrar Errores Dinámicamente:</h3>
                <pre><code>function mostrarError(campo, mensaje) {
    let errorDiv = document.createElement("div");
    errorDiv.className = "error";
    errorDiv.textContent = mensaje;
    campo.parentNode.appendChild(errorDiv);
}</code></pre>
                
                <h3>Proyecto:</h3>
                <p>Crea un formulario de registro con validación completa para nombre, email, contraseña y confirmación.</p>',
                'points' => 35,
                'difficulty_level' => 'intermediate',
                'duration_minutes' => 75,
                'resources' => ['https://www.w3schools.com/js/js_validation.asp'],
                'order' => 11
            ],
            [
                'title' => 'JSON y APIs',
                'description' => 'Intercambia datos con servicios externos.',
                'content' => '<h2>JSON: Formato de Datos</h2>
                <p>JSON (JavaScript Object Notation) es un formato ligero para intercambiar datos entre aplicaciones.</p>
                
                <h3>Sintaxis JSON:</h3>
                <pre><code>{
    "nombre": "Ana",
    "edad": 25,
    "activo": true,
    "hobbies": ["leer", "programar", "viajar"],
    "direccion": {
        "calle": "Main St",
        "numero": 123
    }
}</code></pre>
                
                <h3>Trabajar con JSON en JavaScript:</h3>
                <pre><code>// Convertir objeto a JSON
let persona = {nombre: "Juan", edad: 30};
let json = JSON.stringify(persona);

// Convertir JSON a objeto
let objetoDeNuevo = JSON.parse(json);</code></pre>
                
                <h3>Fetch API - Obtener Datos:</h3>
                <pre><code>fetch("https://api.ejemplo.com/usuarios")
    .then(response => response.json())
    .then(data => {
        console.log(data);
        // Usar los datos aquí
    })
    .catch(error => {
        console.error("Error:", error);
    });</code></pre>
                
                <h3>Enviar Datos (POST):</h3>
                <pre><code>fetch("https://api.ejemplo.com/usuarios", {
    method: "POST",
    headers: {
        "Content-Type": "application/json"
    },
    body: JSON.stringify({
        nombre: "María",
        email: "maria@email.com"
    })
})
.then(response => response.json())
.then(data => console.log(data));</code></pre>
                
                <h3>Ejemplo Práctico:</h3>
                <p>Crea una aplicación que muestre información del clima usando una API pública.</p>',
                'points' => 40,
                'difficulty_level' => 'advanced',
                'duration_minutes' => 90,
                'resources' => ['https://www.w3schools.com/js/js_json.asp'],
                'order' => 12
            ],
            [
                'title' => 'Programación Asíncrona',
                'description' => 'Maneja operaciones que toman tiempo con async/await.',
                'content' => '<h2>Programación Asíncrona</h2>
                <p>Algunas operaciones toman tiempo (como cargar datos de internet). La programación asíncrona permite que tu aplicación no se "congele" esperando.</p>
                
                <h3>Promises (Promesas):</h3>
                <pre><code>let promesa = new Promise((resolve, reject) => {
    setTimeout(() => {
        let exito = true;
        if (exito) {
            resolve("¡Operación exitosa!");
        } else {
            reject("Error en la operación");
        }
    }, 2000);
});

promesa
    .then(resultado => console.log(resultado))
    .catch(error => console.error(error));</code></pre>
                
                <h3>Async/Await (Más Moderno):</h3>
                <pre><code>async function obtenerDatos() {
    try {
        let response = await fetch("https://api.ejemplo.com/datos");
        let datos = await response.json();
        console.log(datos);
    } catch (error) {
        console.error("Error:", error);
    }
}

obtenerDatos();</code></pre>
                
                <h3>Múltiples Operaciones Asíncronas:</h3>
                <pre><code>async function obtenerTodosLosDatos() {
    try {
        // Ejecutar en paralelo
        let [usuarios, posts, comentarios] = await Promise.all([
            fetch("/api/usuarios").then(r => r.json()),
            fetch("/api/posts").then(r => r.json()),
            fetch("/api/comentarios").then(r => r.json())
        ]);
        
        return {usuarios, posts, comentarios};
    } catch (error) {
        console.error("Error obteniendo datos:", error);
    }
}</code></pre>
                
                <h3>Ejemplo Práctico:</h3>
                <pre><code>async function buscarPeliculas(titulo) {
    let loading = document.getElementById("loading");
    loading.style.display = "block";
    
    try {
        let response = await fetch(`/api/peliculas?q=${titulo}`);
        let peliculas = await response.json();
        mostrarPeliculas(peliculas);
    } finally {
        loading.style.display = "none";
    }
}</code></pre>',
                'points' => 45,
                'difficulty_level' => 'advanced',
                'duration_minutes' => 95,
                'resources' => ['https://www.w3schools.com/js/js_async.asp'],
                'order' => 13
            ],
            [
                'title' => 'Manejo de Errores',
                'description' => 'Detecta y maneja errores graciosamente.',
                'content' => '<h2>Manejo de Errores: Programación Robusta</h2>
                <p>Los errores son inevitables en programación. Lo importante es manejarlos correctamente para que tu aplicación no se rompa.</p>
                
                <h3>Try-Catch Básico:</h3>
                <pre><code>try {
    let resultado = operacionPeligrosa();
    console.log(resultado);
} catch (error) {
    console.error("Ocurrió un error:", error.message);
} finally {
    console.log("Esto siempre se ejecuta");
}</code></pre>
                
                <h3>Tipos de Errores Comunes:</h3>
                <pre><code>// Error de referencia
try {
    console.log(variableQueNoExiste);
} catch (error) {
    if (error instanceof ReferenceError) {
        console.log("Variable no definida");
    }
}

// Error de tipo
try {
    null.toString();
} catch (error) {
    if (error instanceof TypeError) {
        console.log("Error de tipo");
    }
}</code></pre>
                
                <h3>Crear Errores Personalizados:</h3>
                <pre><code>function dividir(a, b) {
    if (b === 0) {
        throw new Error("No se puede dividir por cero");
    }
    return a / b;
}

try {
    let resultado = dividir(10, 0);
} catch (error) {
    console.error("Error en división:", error.message);
}</code></pre>
                
                <h3>Manejo de Errores en Async/Await:</h3>
                <pre><code>async function cargarDatos() {
    try {
        let response = await fetch("/api/datos");
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        let datos = await response.json();
        return datos;
    } catch (error) {
        console.error("Error cargando datos:", error);
        // Mostrar mensaje amigable al usuario
        mostrarMensajeError("No se pudieron cargar los datos");
    }
}</code></pre>
                
                <h3>Mejores Prácticas:</h3>
                <ul>
                    <li>Siempre valida datos de entrada</li>
                    <li>Usa mensajes de error claros</li>
                    <li>Log errores para debugging</li>
                    <li>Muestra mensajes amigables al usuario</li>
                </ul>',
                'points' => 35,
                'difficulty_level' => 'advanced',
                'duration_minutes' => 70,
                'resources' => ['https://www.w3schools.com/js/js_errors.asp'],
                'order' => 14
            ],
            [
                'title' => 'Programación Orientada a Objetos',
                'description' => 'Organiza tu código usando clases y objetos.',
                'content' => '<h2>Programación Orientada a Objetos (POO)</h2>
                <p>La POO es una forma de organizar código que imita cómo pensamos sobre objetos en el mundo real.</p>
                
                <h3>Clases y Objetos:</h3>
                <pre><code>class Persona {
    constructor(nombre, edad) {
        this.nombre = nombre;
        this.edad = edad;
    }
    
    saludar() {
        return `Hola, soy ${this.nombre}`;
    }
    
    cumplirAnos() {
        this.edad++;
        return `Ahora tengo ${this.edad} años`;
    }
}

// Crear objetos (instancias)
let juan = new Persona("Juan", 25);
let maria = new Persona("María", 30);

console.log(juan.saludar()); // "Hola, soy Juan"</code></pre>
                
                <h3>Herencia:</h3>
                <pre><code>class Estudiante extends Persona {
    constructor(nombre, edad, carrera) {
        super(nombre, edad); // Llamar constructor padre
        this.carrera = carrera;
        this.materias = [];
    }
    
    inscribirMateria(materia) {
        this.materias.push(materia);
    }
    
    saludar() {
        return `${super.saludar()}, estudio ${this.carrera}`;
    }
}

let ana = new Estudiante("Ana", 20, "Programación");
ana.inscribirMateria("JavaScript");
console.log(ana.saludar());</code></pre>
                
                <h3>Encapsulación (Propiedades Privadas):</h3>
                <pre><code>class CuentaBancaria {
    #saldo = 0; // Propiedad privada
    
    constructor(titular) {
        this.titular = titular;
    }
    
    depositar(cantidad) {
        if (cantidad > 0) {
            this.#saldo += cantidad;
        }
    }
    
    get saldoActual() {
        return this.#saldo;
    }
}</code></pre>
                
                <h3>Métodos Estáticos:</h3>
                <pre><code>class Matematicas {
    static PI = 3.14159;
    
    static areaCirculo(radio) {
        return this.PI * radio * radio;
    }
}

console.log(Matematicas.areaCirculo(5));</code></pre>',
                'points' => 40,
                'difficulty_level' => 'advanced',
                'duration_minutes' => 85,
                'resources' => ['https://www.w3schools.com/js/js_classes.asp'],
                'order' => 15
            ],
            [
                'title' => 'Módulos en JavaScript',
                'description' => 'Organiza tu código en archivos separados.',
                'content' => '<h2>Módulos: Organizando Código</h2>
                <p>Los módulos te permiten dividir tu código en archivos separados, haciéndolo más organizado y reutilizable.</p>
                
                <h3>Exportar desde un Módulo:</h3>
                <p><strong>archivo: matematicas.js</strong></p>
                <pre><code>// Exportación nombrada
export function sumar(a, b) {
    return a + b;
}

export function restar(a, b) {
    return a - b;
}

export const PI = 3.14159;

// Exportación por defecto
export default function multiplicar(a, b) {
    return a * b;
}</code></pre>
                
                <h3>Importar en Otro Archivo:</h3>
                <p><strong>archivo: app.js</strong></p>
                <pre><code>// Importar exportaciones nombradas
import { sumar, restar, PI } from "./matematicas.js";

// Importar exportación por defecto
import multiplicar from "./matematicas.js";

// Importar todo como un objeto
import * as math from "./matematicas.js";

console.log(sumar(5, 3)); // 8
console.log(multiplicar(4, 2)); // 8
console.log(math.PI); // 3.14159</code></pre>
                
                <h3>Estructura de Proyecto:</h3>
                <pre><code>proyecto/
├── index.html
├── js/
│   ├── app.js
│   ├── utils/
│   │   ├── matematicas.js
│   │   └── validadores.js
│   └── components/
│       ├── menu.js
│       └── formulario.js</code></pre>
                
                <h3>Ejemplo Práctico - Validadores:</h3>
                <p><strong>archivo: validadores.js</strong></p>
                <pre><code>export function validarEmail(email) {
    return email.includes("@") && email.includes(".");
}

export function validarTelefono(telefono) {
    return /^\d{10}$/.test(telefono);
}

export function validarPassword(password) {
    return password.length >= 8;
}</code></pre>
                
                <h3>Usando en HTML:</h3>
                <pre><code>&lt;script type="module" src="js/app.js"&gt;&lt;/script&gt;</code></pre>',
                'points' => 35,
                'difficulty_level' => 'advanced',
                'duration_minutes' => 75,
                'resources' => ['https://www.w3schools.com/js/js_modules.asp'],
                'order' => 16
            ],
            [
                'title' => 'Expresiones Regulares',
                'description' => 'Busca y valida patrones de texto eficientemente.',
                'content' => '<h2>Expresiones Regulares (Regex)</h2>
                <p>Las expresiones regulares son patrones que te permiten buscar, validar y manipular texto de forma muy poderosa.</p>
                
                <h3>Sintaxis Básica:</h3>
                <pre><code>// Crear una regex
let patron = /hola/i; // i = insensible a mayúsculas
let patron2 = new RegExp("hola", "i");

// Probar si coincide
let texto = "Hola mundo";
console.log(patron.test(texto)); // true</code></pre>
                
                <h3>Metacaracteres Importantes:</h3>
                <ul>
                    <li><strong>.</strong> - Cualquier carácter</li>
                    <li><strong>*</strong> - Cero o más repeticiones</li>
                    <li><strong>+</strong> - Una o más repeticiones</li>
                    <li><strong>?</strong> - Cero o una repetición</li>
                    <li><strong>^</strong> - Inicio de línea</li>
                    <li><strong>$</strong> - Final de línea</li>
                </ul>
                
                <h3>Clases de Caracteres:</h3>
                <pre><code>let email = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
let telefono = /^\d{3}-\d{3}-\d{4}$/; // 123-456-7890
let password = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;</code></pre>
                
                <h3>Métodos Útiles:</h3>
                <pre><code>let texto = "El teléfono es 123-456-7890";
let patronTel = /\d{3}-\d{3}-\d{4}/;

// Buscar
console.log(texto.match(patronTel)); // ["123-456-7890"]

// Reemplazar
let nuevoTexto = texto.replace(patronTel, "XXX-XXX-XXXX");

// Dividir
let partes = "manzana,banana,uva".split(/,/);

// Buscar todas las coincidencias
let numeros = "abc123def456ghi".match(/\d+/g); // ["123", "456"]</code></pre>
                
                <h3>Validaciones Comunes:</h3>
                <pre><code>function validarFormato(valor, tipo) {
    const patrones = {
        email: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
        telefono: /^\(\d{3}\) \d{3}-\d{4}$/,
        codigoPostal: /^\d{5}(-\d{4})?$/,
        tarjetaCredito: /^\d{4}-\d{4}-\d{4}-\d{4}$/
    };
    
    return patrones[tipo].test(valor);
}</code></pre>',
                'points' => 40,
                'difficulty_level' => 'advanced',
                'duration_minutes' => 80,
                'resources' => ['https://www.w3schools.com/js/js_regexp.asp'],
                'order' => 17
            ],
            [
                'title' => 'Local Storage y Session Storage',
                'description' => 'Guarda datos en el navegador del usuario.',
                'content' => '<h2>Almacenamiento en el Navegador</h2>
                <p>Puedes guardar datos en el navegador del usuario para que persistan entre sesiones o durante la sesión actual.</p>
                
                <h3>Local Storage (Persistente):</h3>
                <pre><code>// Guardar datos
localStorage.setItem("usuario", "Juan");
localStorage.setItem("configuracion", JSON.stringify({
    tema: "oscuro",
    idioma: "es"
}));

// Recuperar datos
let usuario = localStorage.getItem("usuario");
let config = JSON.parse(localStorage.getItem("configuracion"));

// Eliminar datos
localStorage.removeItem("usuario");
localStorage.clear(); // Elimina todo</code></pre>
                
                <h3>Session Storage (Temporal):</h3>
                <pre><code>// Similar a localStorage pero se borra al cerrar la pestaña
sessionStorage.setItem("sesionActiva", "true");
let sesion = sessionStorage.getItem("sesionActiva");

sessionStorage.removeItem("sesionActiva");
sessionStorage.clear();</code></pre>
                
                <h3>Ejemplo: Sistema de Preferencias:</h3>
                <pre><code>class PreferenciasUsuario {
    static cargar() {
        const preferencias = localStorage.getItem("preferencias");
        return preferencias ? JSON.parse(preferencias) : {
            tema: "claro",
            idioma: "es",
            notificaciones: true
        };
    }
    
    static guardar(preferencias) {
        localStorage.setItem("preferencias", JSON.stringify(preferencias));
    }
    
    static aplicarTema(tema) {
        document.body.className = tema === "oscuro" ? "dark-theme" : "light-theme";
        
        let prefs = this.cargar();
        prefs.tema = tema;
        this.guardar(prefs);
    }
}

// Uso
let preferencias = PreferenciasUsuario.cargar();
PreferenciasUsuario.aplicarTema(preferencias.tema);</code></pre>
                
                <h3>Ejemplo: Carrito de Compras:</h3>
                <pre><code>class CarritoCompras {
    static agregar(producto) {
        let carrito = this.obtener();
        carrito.push(producto);
        localStorage.setItem("carrito", JSON.stringify(carrito));
    }
    
    static obtener() {
        const carrito = localStorage.getItem("carrito");
        return carrito ? JSON.parse(carrito) : [];
    }
    
    static vaciar() {
        localStorage.removeItem("carrito");
    }
    
    static total() {
        return this.obtener().reduce((sum, item) => sum + item.precio, 0);
    }
}</code></pre>
                
                <h3>Consideraciones Importantes:</h3>
                <ul>
                    <li>Límite de ~5-10MB por dominio</li>
                    <li>Solo almacena strings</li>
                    <li>Disponible solo en HTTPS en algunos navegadores</li>
                    <li>El usuario puede borrar los datos</li>
                </ul>',
                'points' => 30,
                'difficulty_level' => 'intermediate',
                'duration_minutes' => 65,
                'resources' => ['https://www.w3schools.com/html/html5_webstorage.asp'],
                'order' => 18
            ],
            [
                'title' => 'Performance y Optimización',
                'description' => 'Haz que tu código sea más rápido y eficiente.',
                'content' => '<h2>Optimización de Performance</h2>
                <p>Escribir código que funcione es solo el primer paso. También necesitas que sea rápido y eficiente.</p>
                
                <h3>Medición de Performance:</h3>
                <pre><code>// Medir tiempo de ejecución
console.time("operacion");
// ... tu código aquí ...
console.timeEnd("operacion");

// API más precisa
let inicio = performance.now();
// ... tu código ...
let fin = performance.now();
console.log(`Tiempo: ${fin - inicio} ms`);</code></pre>
                
                <h3>Optimización de Bucles:</h3>
                <pre><code>// ❌ Menos eficiente
for (let i = 0; i < array.length; i++) {
    // array.length se evalúa en cada iteración
}

// ✅ Más eficiente
let len = array.length;
for (let i = 0; i < len; i++) {
    // length se evalúa una sola vez
}

// ✅ Aún mejor para arrays
array.forEach(item => {
    // Optimizado internamente
});</code></pre>
                
                <h3>Debouncing (Limitar Frecuencia):</h3>
                <pre><code>function debounce(func, delay) {
    let timeoutId;
    return function(...args) {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(() => func.apply(this, args), delay);
    };
}

// Uso en búsqueda
let buscar = debounce(function(termino) {
    console.log("Buscando:", termino);
}, 300);

document.getElementById("busqueda").addEventListener("input", (e) => {
    buscar(e.target.value);
});</code></pre>
                
                <h3>Lazy Loading (Carga Perezosa):</h3>
                <pre><code>// Cargar datos solo cuando se necesiten
class GestorDatos {
    constructor() {
        this._datosGrandes = null;
    }
    
    async obtenerDatos() {
        if (!this._datosGrandes) {
            console.log("Cargando datos por primera vez...");
            this._datosGrandes = await fetch("/api/datos-grandes").then(r => r.json());
        }
        return this._datosGrandes;
    }
}</code></pre>
                
                <h3>Optimización del DOM:</h3>
                <pre><code>// ❌ Menos eficiente - múltiples reflows
for (let i = 0; i < 1000; i++) {
    document.body.appendChild(crearElemento(i));
}

// ✅ Más eficiente - un solo reflow
let fragmento = document.createDocumentFragment();
for (let i = 0; i < 1000; i++) {
    fragmento.appendChild(crearElemento(i));
}
document.body.appendChild(fragmento);</code></pre>
                
                <h3>Memory Management:</h3>
                <pre><code>// Limpiar event listeners
let elemento = document.getElementById("mi-boton");
let handler = () => console.log("click");

elemento.addEventListener("click", handler);

// Cuando ya no lo necesites:
elemento.removeEventListener("click", handler);

// Limpiar timers
let intervalId = setInterval(() => console.log("tick"), 1000);
// Más tarde:
clearInterval(intervalId);</code></pre>',
                'points' => 45,
                'difficulty_level' => 'advanced',
                'duration_minutes' => 90,
                'resources' => ['https://web.dev/performance/'],
                'order' => 19
            ],
            [
                'title' => 'Proyecto Final: Aplicación Completa',
                'description' => 'Integra todos los conceptos en una aplicación web funcional.',
                'content' => '<h2>Proyecto Final: Lista de Tareas Avanzada</h2>
                <p>Aplicaremos todos los conceptos aprendidos para crear una aplicación completa de gestión de tareas.</p>
                
                <h3>Características del Proyecto:</h3>
                <ul>
                    <li>✅ CRUD completo (Crear, Leer, Actualizar, Eliminar)</li>
                    <li>📱 Diseño responsive</li>
                    <li>💾 Persistencia con LocalStorage</li>
                    <li>🔍 Búsqueda y filtrado</li>
                    <li>📊 Estadísticas</li>
                    <li>🎨 Múltiples temas</li>
                    <li>📱 PWA (Progressive Web App)</li>
                </ul>
                
                <h3>Estructura del Proyecto:</h3>
                <pre><code>proyecto-final/
├── index.html
├── css/
│   ├── styles.css
│   ├── themes.css
│   └── responsive.css
├── js/
│   ├── app.js
│   ├── models/
│   │   └── Task.js
│   ├── utils/
│   │   ├── storage.js
│   │   └── validation.js
│   └── components/
│       ├── TaskList.js
│       ├── TaskForm.js
│       └── Statistics.js
└── manifest.json</code></pre>
                
                <h3>Modelo de Datos:</h3>
                <pre><code>class Task {
    constructor(title, description, priority = "medium", dueDate = null) {
        this.id = Date.now().toString();
        this.title = title;
        this.description = description;
        this.priority = priority; // low, medium, high
        this.completed = false;
        this.createdAt = new Date();
        this.dueDate = dueDate ? new Date(dueDate) : null;
        this.tags = [];
    }
    
    toggle() {
        this.completed = !this.completed;
    }
    
    isOverdue() {
        return this.dueDate && new Date() > this.dueDate && !this.completed;
    }
}</code></pre>
                
                <h3>Funcionalidades Principales:</h3>
                <pre><code>class TaskManager {
    constructor() {
        this.tasks = Storage.load("tasks") || [];
        this.currentFilter = "all";
        this.currentTheme = Storage.load("theme") || "light";
    }
    
    addTask(taskData) {
        const task = new Task(...Object.values(taskData));
        this.tasks.push(task);
        this.save();
        this.render();
    }
    
    updateTask(id, updates) {
        const task = this.tasks.find(t => t.id === id);
        if (task) {
            Object.assign(task, updates);
            this.save();
            this.render();
        }
    }
    
    deleteTask(id) {
        this.tasks = this.tasks.filter(t => t.id !== id);
        this.save();
        this.render();
    }
    
    getStatistics() {
        return {
            total: this.tasks.length,
            completed: this.tasks.filter(t => t.completed).length,
            pending: this.tasks.filter(t => !t.completed).length,
            overdue: this.tasks.filter(t => t.isOverdue()).length
        };
    }
}</code></pre>
                
                <h3>Desafíos Adicionales:</h3>
                <ul>
                    <li>🔄 Implementar drag & drop para reordenar</li>
                    <li>📱 Hacer una PWA instalable</li>
                    <li>🌙 Modo oscuro automático</li>
                    <li>📈 Gráficos de productividad</li>
                    <li>🔔 Notificaciones</li>
                    <li>📤 Export/Import de datos</li>
                </ul>',
                'points' => 100,
                'difficulty_level' => 'advanced',
                'duration_minutes' => 180,
                'resources' => ['https://web.dev/progressive-web-apps/', 'https://developer.mozilla.org/es/docs/Web/API'],
                'order' => 20
            ]
        ];

        foreach ($lessons as $lessonData) {
            Lesson::create([
                'title' => $lessonData['title'],
                'description' => $lessonData['description'],
                'content' => $lessonData['content'],
                'points' => $lessonData['points'],
                'difficulty_level' => $lessonData['difficulty_level'],
                'duration_minutes' => $lessonData['duration_minutes'],
                'resources' => $lessonData['resources'],
                'order' => $lessonData['order'],
                'teacher_id' => $teacher->id
            ]);
        }
    }
}