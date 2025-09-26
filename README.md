🖥️ Sistema de Control de Mantenimiento de PCs.

Este proyecto es un sistema web CRUD diseñado para gestionar el mantenimiento de equipos de computo en un negocio de soporte técnico. Permite registrar usuarios, asociarlos a una PC, realizar seguimiento de mantenimientos y visualizar la información en tarjetas organizadas.

📁 Estructura del proyecto
````
control_equipos/
├── assets/           # Recursos estáticos (CSS, JS, imágenes)
├── includes/         # Archivos PHP reutilizables (conexión, funciones)
├── public/           # Archivos accesibles públicamente
├── README.md         # Este archivo
├── control_mantenimiento.sql  # Script de la base de datos
├── dashboard.php     # Panel principal de control
├── login.php         # Inicio de sesión
└── logout.php        # Cierre de sesión
````

✨ Funcionalidades principales

Gestión de usuarios: Agregar, editar, eliminar y listar clientes.

- Registro de PCs: Vincular equipos a cada usuario.
  
- Control de mantenimientos: Registrar servicios realizados en cada PC.
  
- Visualización en tarjetas: Mostrar información de manera ordenada y accesible.
  
- Autenticación de usuarios: Login y logout para acceder al sistema.


🛠️ Tecnologías utilizadas
- PHP
  
- MySQL
  
- HTML / CSS
  
- JavaScript
  
⚙️ Instalación y configuración
1. Clonar o descargar el proyecto
bash
````
git clone https://github.com/Saicroxzz/control_equipos.git
cd tu-repositorio
````
2. Base de datos
Importa el archivo control_mantenimiento.sql en tu servidor MySQL.

Configura la conexión en includes/conexion.php (si existe) o donde manejes la conexión a la BD.

3. Servidor web
Coloca los archivos en la carpeta pública de tu servidor (ej: htdocs, www).

Asegúrate de que PHP y MySQL estén funcionando.

4. Acceder al sistema
Abre tu navegador y ve a: http://localhost/tu-proyecto/login.php

Usa las credenciales por defecto o regístrate.

Credenciales
````
wiladmin@gmail.com : 123
brayantec@gmail.com : 123
````

🗃️ Base de datos
El archivo control_mantenimiento.sql contiene la estructura necesaria para:

- Tabla de usuarios
  
- Tabla de PCs
  
- Tabla de mantenimientos
  
- tabla facturas
  
- tabla tecnicos
  
- Relaciones entre ellas

👤 Usos del sistema
Administrador:

- Gestiona usuarios y PCs.

- Registra mantenimientos.

- Ve reportes en el dashboard.

Técnico:

Puede acceder a las órdenes de trabajo asignadas.

🚀 Próximas mejoras (opcional)
- Exportar reportes en PDF.
  
- Notificaciones por email
  
- Roles de usuario (admin, técnico, cliente).
  
- Interfaz responsive.

📄 Licencia
Este proyecto es de uso libre para fines educativos y comerciales.

🤝 Contribuciones
Si deseas contribuir, puedes hacer un fork del proyecto y enviar un pull request.
