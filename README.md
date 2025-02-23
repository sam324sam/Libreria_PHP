**# 📚 Gestión de Biblioteca**

🚀 **Aplicación web en PHP para gestionar los fondos de una biblioteca escolar.**  
Organizada con el patrón MVC y utilizando bases de datos MySQL.

**## 🛠️ Tecnologías utilizadas**

- **PHP 8+**
- **MySQL**
- **HTML, CSS, JavaScript**
- **Apache/Nginx**

**## 📂 Estructura del proyecto**

```bash
/biblioteca  
│── /config          # Configuración de la base de datos  
│── /controllers     # Controladores de la aplicación  
│── /models         # Modelos de la base de datos  
│── /views          # Vistas (HTML, PHP)  
│── /public         # Archivos accesibles públicamente (CSS, JS, imágenes)  
│── /routes         # Definición de rutas  
│── /helpers        # Funciones auxiliares  
│── index.php       # Punto de entrada principal  
│── .htaccess       # Configuración de Apache  
│── README.md       # Documentación  
```

**## 🏁 Instalación y configuración**

**### 1️⃣ Clonar el repositorio**
```bash
git clone https://github.com/tu_usuario/gestion-biblioteca.git
cd gestion-biblioteca
```

**### 2️⃣ Configurar la base de datos**
- **Importar el archivo `database.sql` en MySQL.**
- **Configurar la conexión en `config/database.php`.**

**### 3️⃣ Ejecutar el servidor local**
```bash
php -S localhost:8000 -t public
```

**## 📜 Funcionalidades principales**

- ✅ **Registro e inicio de sesión de usuarios** 🔐  
- ✅ **Gestión de libros, revistas y documentos multimedia** 📖 🎥  
- ✅ **Préstamo y devolución de ejemplares** 📅  
- ✅ **Búsqueda y filtrado de documentos** 🔍  
- ✅ **Panel de administración para la gestión del sistema** ⚙️  

**## 🤝 Contribuciones**

¡Las contribuciones son bienvenidas! Para contribuir, sigue estos pasos:
1. **Haz un fork del proyecto** 🍴
2. **Crea una nueva rama (`git checkout -b feature-nueva-funcionalidad`)**
3. **Realiza los cambios y haz commit (`git commit -m 'Añadir nueva funcionalidad'`)**
4. **Sube los cambios a tu fork (`git push origin feature-nueva-funcionalidad`)**
5. **Abre un Pull Request** 🚀

**## 📄 Licencia**

Este proyecto está bajo la **licencia MIT**. Puedes usarlo y modificarlo libremente. 📜


