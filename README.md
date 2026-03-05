# Actividad 4 Inyeccion SQL y Mitigación

# SQL Injection Demo (PHP + MySQL + XAMPP)

Laboratorio de demostración para entender:
- Un formulario **vulnerable** a SQL Injection (concatenación de entrada en SQL)
- Un formulario **seguro** usando **Prepared Statements**

> ⚠️ Solo para uso educativo en entorno local.

---

## Requisitos
- XAMPP (Apache + MySQL + PHP)
- Navegador web
- (Opcional) Visual Studio Code

---

## 1. Instalación del proyecto
1. Instalar XAMPP e iniciar:
   - **Apache**
   - **MySQL**

2. Copiar la carpeta del proyecto en:
   - `C:\xampp\htdocs\sqli_demo`

3. Verificar que PHP funciona abriendo:
   - `http://localhost/sqli_demo/vulnerable.php`
  
   <img width="886" height="336" alt="image" src="https://github.com/user-attachments/assets/e2e1a463-459e-4fa0-a071-739b68d49ff5" />


---

## 2. Crear la base de datos
### Opción rápida (phpMyAdmin)
1. Abrir `http://localhost/phpmyadmin`
2. Crear la base de datos: `lab_sqli`
3. Seleccionar `lab_sqli` → pestaña **SQL**
4. Ejecutar el script `database.sql`

---

## 3. Configuración de conexión
En `db.php` se usa lo típico de XAMPP:

- Host: `localhost`
- User: `root`
- Password: *(vacío)*
- DB: `lab_sqli`

---

## 4. Probar el formulario vulnerable (SQL Injection)
Abrir:
- `http://localhost/sqli_demo/vulnerable.php`

### Caso normal
Escribe:
- `lcrojas`

Debe devolver solo ese usuario.

<img width="887" height="445" alt="image" src="https://github.com/user-attachments/assets/62c4dfdc-7e3d-489c-abd2-a3a568d22e52" />


### Caso SQL Injection
Escribir:
- `' OR '1'='1`

**Resultado esperado:** retorna **todas las filas** porque la condición del `WHERE` se vuelve siempre verdadera.

<img width="909" height="500" alt="image" src="https://github.com/user-attachments/assets/397d3655-ed2a-4557-a9f7-be9634480743" />


---

## 5. Probar el formulario seguro (mitigación)
Abrir:
- `http://localhost/sqli_demo/seguro.php`

Repitir:
- `' OR '1'='1`

**Resultado esperado:** NO debe retornar todos los usuarios, porque el valor se trata como dato literal
gracias a las **consultas preparadas** (Prepared Statements).

<img width="929" height="372" alt="image" src="https://github.com/user-attachments/assets/a3fb9875-0ff8-40c2-ade6-73482ae86049" />


---

## ¿Por qué usar Prepared Statements?
Porque separan **código SQL** de **datos del usuario**:
- El SQL se prepara con placeholders (ej. `?`)
- Los valores se envían aparte como parámetros
- MySQL no interpreta esos valores como parte del SQL

---

## Estructura del proyecto
- `db.php` → conexión a MySQL
- `vulnerable.php` → ejemplo vulnerable (concatenación)
- `seguro.php` → ejemplo mitigado (prepared statements)
- `database.sql` → script para crear tabla y datos
