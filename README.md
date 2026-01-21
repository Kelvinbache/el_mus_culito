# El MUS CULITO

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
│   ├── css/                # Estilos (.css)
│   ├── js/                 # Scripts (.js)
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