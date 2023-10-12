CREATE DATABASE crud;
use  crud;

create table persona(
    id int auto_increment primary key,
    nombres varchar(100),
    apellido_paterno varchar(100),
    apellido_materno varchar(100),
    fecha_nacimiento date,
    celular varchar(12) 
);

create table promocion(
    id int auto_increment primary key,
    descripcion varchar(100),
    fecha_inicio date,
    fecha_fin date,
    id_user int(10) 
);