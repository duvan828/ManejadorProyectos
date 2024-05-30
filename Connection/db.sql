CREATE DATABASE IF NOT EXISTS proyectos;
-- DROP DATABASE proyectos;
USE proyectos;

CREATE TABLE recursos (
  idRecurso INTEGER UNSIGNED  NOT NULL   AUTO_INCREMENT,
  descripcion TEXT  NULL  ,
  valor FLOAT  NULL  ,
  unidadmedida VARCHAR(10)  NULL    ,
PRIMARY KEY(idRecurso));



CREATE TABLE personas (
  idPersona INTEGER UNSIGNED  NOT NULL   AUTO_INCREMENT,
  contraseña VARCHAR(100) NOT NULL,
  nombre VARCHAR(60)  NULL  ,
  apellido VARCHAR(60)  NULL  ,
  direccion VARCHAR(60)  NULL  ,
  telefono VARCHAR(10)  NULL  ,
  sexo CHAR  NULL  ,
  fechanacimiento DATE  NULL  ,
  profesion VARCHAR(60)  NULL    ,
PRIMARY KEY(idPersona));

INSERT personas (idPersona, contraseña, nombre) VALUES (12345, '$2a$12$9NMmp10Yi1gaAc.P1RqqXuMubKGcXGE7ludzqHVMw1Dw0rt02b4aa', 'ADMIN');

CREATE TABLE usuario (
  id INTEGER UNSIGNED  NOT NULL   AUTO_INCREMENT,
  idPersona INTEGER UNSIGNED  NOT NULL  ,
  contraseña VARCHAR(100)  NULL    ,
PRIMARY KEY(id, idPersona)  ,
INDEX usuario_FKIndex1(idPersona),
  FOREIGN KEY(idPersona)
    REFERENCES personas(idPersona)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION);



CREATE TABLE proyectos (
  idProyecto INTEGER UNSIGNED  NOT NULL   AUTO_INCREMENT,
  descripcion TEXT  NOT NULL  ,
  fecha_inicio DATE  NOT NULL  ,
  fecha_entrega DATE  NOT NULL  ,
  valor FLOAT  NOT NULL  ,
  lugar VARCHAR(60)  NOT NULL  ,
  responsable INTEGER UNSIGNED  NOT NULL  ,
  estado VARCHAR(20)  NOT NULL    ,
PRIMARY KEY(idProyecto)  ,
INDEX proyectos_FKIndex1(responsable),
  FOREIGN KEY(responsable)
    REFERENCES personas(idPersona)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION);



CREATE TABLE actividades (
  idActividad INTEGER UNSIGNED  NOT NULL   AUTO_INCREMENT,
  descripcion TEXT  NULL  ,
  fecha_inicio DATE  NULL  ,
  fecha_fin DATE  NULL  ,
  idProyecto INTEGER UNSIGNED  NOT NULL  ,
  responsable INTEGER UNSIGNED  NOT NULL  ,
  estado VARCHAR(50)  NULL  ,
  presupuesto DOUBLE  NULL    ,
PRIMARY KEY(idActividad)  ,
INDEX actividades_FKIndex1(responsable)  ,
INDEX actividades_FKIndex2(idProyecto),
  FOREIGN KEY(responsable)
    REFERENCES personas(idPersona)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(idProyecto)
    REFERENCES proyectos(idProyecto)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION);



CREATE TABLE tareas (
  idTarea INTEGER UNSIGNED  NOT NULL   AUTO_INCREMENT,
  descripcion TEXT  NULL  ,
  fecha_inicio DATE  NULL  ,
  fecha_fin DATE  NULL  ,
  idActividad INTEGER UNSIGNED  NOT NULL  ,
  estado VARCHAR(50)  NULL  ,
  presupuesto DOUBLE  NULL    ,
PRIMARY KEY(idTarea)  ,
INDEX tareas_FKIndex1(idActividad),
  FOREIGN KEY(idActividad)
    REFERENCES actividades(idActividad)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION);



CREATE TABLE tareasxrecursos (
  idTarea INTEGER UNSIGNED  NOT NULL  ,
  idRecurso INTEGER UNSIGNED  NOT NULL  ,
  cantidad INTEGER UNSIGNED  NULL    ,
PRIMARY KEY(idTarea, idRecurso)  ,
INDEX tareas_has_recursos_FKIndex1(idTarea)  ,
INDEX tareas_has_recursos_FKIndex2(idRecurso),
  FOREIGN KEY(idTarea)
    REFERENCES tareas(idTarea)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(idRecurso)
    REFERENCES recursos(idRecurso)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION);



CREATE TABLE personasxtareas (
  idPersona INTEGER UNSIGNED  NOT NULL  ,
  idTarea INTEGER UNSIGNED  NOT NULL  ,
  duracion INTEGER UNSIGNED  NULL    ,
PRIMARY KEY(idPersona, idTarea)  ,
INDEX personas_has_tareas_FKIndex1(idPersona)  ,
INDEX personas_has_tareas_FKIndex2(idTarea),
  FOREIGN KEY(idPersona)
    REFERENCES personas(idPersona)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(idTarea)
    REFERENCES tareas(idTarea)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION);



