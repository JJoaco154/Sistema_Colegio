create database escuela;
use escuela;

create table alumno(
    id_alumno INT AUTO_INCREMENT PRIMARY KEY,
    legajo int,
    nombre VARCHAR(50),
    apellido varchar(30),
    edad INT,
    notaFinal INT
);

create table profesor(
    id_profe INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50),
    apellido varchar(30),
    edad INT,
    materia varchar(30)
);

create table curso(
    id int AUTO_INCREMENT primary key,
    nombre varchar(30),
    id_profe int,
    foreign key (id_profe) references profesor (id_profe),
    id_alumno int,
    foreign key (id_alumno) references alumno (id_alumno)
);

DELIMITER //
create procedure insertarAlumno( in p_legajo int, in p_nombre varchar(50), in p_apellido varchar(30), in p_edad int, in p_notaFinal int, out p_id int )
begin
      declare exit handler for sqlexception
      begin
            select 'Ocurrio un error. Poroseco terminado' as Mensaje;
	  end ;
      
      insert into alumno(legajo, nombre, apellido, edad, notaFinal)
      values(p_legajo, p_nombre, p_apellido, p_edad, p_notaFinal);
      
      set p_id = last_insert_id();
end //
DELIMITER ;

drop procedure insertarAlumno;
      
DELIMITER //
create procedure insertarProfe( in p_nombre varchar(50), in p_apellido varchar(30), in p_edad int, in p_materia varchar(30), out p_id int )
begin
      declare exit handler for sqlexception
      begin
            select 'Ocurrio un error. Poroseco terminado' as Mensaje;
	  end ;
      
      insert into profesor(nombre, apellido, edad, materia)
      values(p_nombre, p_apellido, p_edad, p_materia);
      
      set p_id = last_insert_id();
end //
DELIMITER ;

DELIMITER //
create procedure insertarCurso( in p_nombre varchar(50), in p_id_alu int, in p_id_profe int )
begin
      declare exit handler for sqlexception
      begin
            select 'Ocurrio un error. Poroseco terminado' as Mensaje;
	  end ;
      
      insert into curso( nombre, id_profe, id_alumno)
      values( p_nombre, p_id_profe, p_id_alumno );
end //
DELIMITER ;

select *
from alumno;

select *
from profesor;