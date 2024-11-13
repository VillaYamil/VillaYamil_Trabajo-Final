README - Sistema de Toma de Asistencias

Este sistema te permite gestionar las asistencias de los alumnos, registrar notas, ver el estado de los alumnos y gestionar las materias. A continuación te explico cómo usar las funciones principales:

1. **Acceso al Login**
   - Inicia sesión con las siguientes credenciales:
     - **Nombre de usuario**: Yamil
     - **Contraseña**: 12345
   - Después de iniciar sesión, serás redirigido a la página principal.

2. **Alta de Asistencia**
   - En esta sección puedes registrar la asistencia de los alumnos a las materias.
   - Se debe seleccionar la materia y el alumno, luego marcar si está presente o ausente.
   - El registro se guarda en la base de datos para que puedas consultar más tarde.

3. **Muestra Asistencia Materia**
   - En esta página puedes ver la asistencia de los alumnos por materia.
   - Seleccionas la materia y el sistema muestra la lista de alumnos con sus respectivas asistencias (presente, ausente) y las fechas de cada clase.

4. **Formulario de Notas**
   - En este formulario puedes asignar tres notas a cada alumno para las materias.
   - Puedes ver las materias disponibles y seleccionar un alumno para ingresar sus notas.
   - Las notas se almacenan para su posterior consulta.

5. **Ver Estado Alumno**
   - Aquí podrás ver el estado de los alumnos según su asistencia y notas.
   - El sistema calcula un estado de aprobado, regular o desaprobado basado en las asistencias y notas registradas.

6. **ABM de Materia**
   - Desde esta sección puedes gestionar las materias.
   - Puedes **agregar** nuevas materias, **editar** el nombre de una materia existente, o **eliminar** una materia.
   - Las materias son esenciales para la asignación de notas y asistencias a los alumnos.

### Creación y Configuración de la Base de Datos

1. **Crear la Base de Datos**
   - Primero, abre **phpMyAdmin** en tu navegador.
   - Crea una nueva base de datos llamada `tp_asistencias_v3` (o el nombre que desees).
   - Usa la opción "Crear base de datos" y asegúrate de elegir **utf8_general_ci** como cotejamiento (collation).

2. **Importar la Estructura de la Base de Datos**
   - Una vez que hayas creado la base de datos, deberás importar las tablas necesarias.
   - Las tablas esenciales para este sistema incluyen:
     - `alumno`: Contiene los datos de los alumnos.
     - `profesor`: Contiene los datos de los profesores.
     - `materia`: Contiene los datos de las materias.
     - `asistencia`: Registra las asistencias de los alumnos.
     - `alumno_materia`: Relaciona alumnos con materias.
     - `profesor_materia`: Relaciona profesores con materias.
   - Se debe precionar en seleccionar archivo y nuevamente seleccionar el archivo tp_asistencias_v4.sql y por ultimo presionar Importar.

