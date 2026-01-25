# El MUS CULITO
Este sistema es una solución integral para la gestión de gimnasios, diseñada bajo el patrón de arquitectura MVC (Modelo-Vista-Controlador). Su objetivo es automatizar desde el registro de atletas y empleados hasta el control estricto de accesos y finanzas.

## Estructura del Proyecto

```
El_mus_culito/
│
├── config/                 # Configuración del sistema
│   └── Database.php        # Clase de conexión PDO a MySQL
│
├── core/                   # Archivos base del sistema
│   └── Router.php          # (Opcional) Manejador de rutas
│
├── public/                 # Única carpeta accesible desde la web (Seguridad)
│   ├── css/                # Estilos (.css)│ 
│   ├── img/                # Imágenes y logos
│   └── index.php           # Punto de entrada de la aplicación
│
├── src/                    # Código fuente principal (Lógica POO)
│   ├── Controllers/        # Reciben las peticiones y deciden qué hacer
│   │   ├── UserController.php
│   │   ├── MembershipController.php
│   │   └── PaymentController.php
│   │
│   ├── Models/             # Clases que representan tus tablas (Tus "Objetos")
│   │   ├── Person.php
│   │   ├── User.php
│   │   ├── Membership.php
│   │   └── Payment.php
│   │
│   └── Services/           # Lógica de negocio (Cálculos complejos)
│       ├── MembershipService.php # (Aquí vive el isAccessAllowed)
│       └── ReportService.php
│
├── views/                  # Archivos HTML y PHP de interfaz
│   ├── layout/             # Partes comunes (header.php, footer.php)
│   ├── user/               # Vistas para gestión de usuarios
│   ├── dashboard/          # Panel principal
│   └── errors/             # Páginas de 404 o acceso denegado
│
├── .env                    # Variables sensibles (DB_USER, DB_PASS)
└── .htaccess               # Configuración del servidor Apache
```

## Comando para encender Apache
sudo systemctl enable --now apache2 

## Revizar errores
sudo tail -f /var/log/apache2/error.log

## Reiniciar el servidor
 sudo systemctl restart apache2

 ## Update COmposer.JSON
 composer dump-autoload


## Paleta de color
Verde Neón / Lima (#DFFF00): Usado para botones de llamada a la acción (CTA), estados activos y acentos importantes. Aporta vitalidad.

Negro Carbón (#121212): Color de fondo principal para el modo oscuro, proporcionando un aspecto premium y moderno.

Gris Oscuro (#1E1E1E): Utilizado para tarjetas, contenedores y la barra lateral para crear jerarquía visual.

Blanco Puro (#FFFFFF): Para textos principales y títulos, garantizando la máxima legibilidad.

Gris Suave (#A0A0A0): Para textos secundarios, descripciones y placeholders en formularios.

## IMG
🖼️ Referencias de Imágenes
Utilizo imágenes de alta calidad de bancos gratuitos como Unsplash, que encajan con la estética de gimnasio profesional. Aquí tienes las referencias visuales para las pantallas:

Home Page (Hero Section): Hombre entrenando intensamente en gimnasio oscuro
Login / Sign Up Background: Interior de gimnasio moderno con luces de neón
About Us Section: Grupo de personas en clase de entrenamiento funcional
Client Management (Avatares): Retrato de persona atlética
¿Te gustaría que apliquemos estos colores de forma más intensa en alguna sección específica o prefieres que avancemos con el diseño del formulario para añadir clientes?