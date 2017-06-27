create database consejodb;
use consejodb;


create table alumno(
	num_control int(11) ,
	semestre int(11) ,
	nom_alumno text, 
	ape_paterno text, 
	ape_materno text, 
	id_carrera int(11),
	prom_general double);

create table carrrera (
	id_carrera int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nom_carrera text,
	nom_cordinador text
);


create table configuracion(
	id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,     
	jefeEP varchar(50),
	subDirAcadem varchar(50),
	director varchar(50), 
	img_Enc longblob 
);

create table events(
	id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	title varchar(255),
	start datetime,
	end datetime
);

create table peticion(
	id_peticion int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
	num_control int(11) ,
	fecha date ,
	peticion longtext ,
	dictamen longtext,
	id_razon int(11),
	fechaSolicitud date ,
	coment text ,
	status int(11) 
);

create table razones(
	id_razon int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nombre text
);

create table usuarios(
	cuenta varchar(11) ,
	contrasena varchar(20),
	nombre varchar(20),
	nivel int(11)
);


--*****************************************
-- *********** Agregar datos
--*****************************************


insert into carrrera (nom_carrera, nom_cordinador)
	values( 'Ing. en Gestion Empresarial', ''),
	( 'Ing. en Sistemas Computacionales', ''),
	( 'Ing. en Energias Renovables', ''),
	( 'Ing. Electronica', ''),
	( 'Ing. Civil', ''),
	( 'Ing. Industrial', ''),
	( 'Lic. en Biologia', ''),
	( 'Lic. en Informatica' , '' )

insert into usuarios 
	values( 'admin', 'j6r3uwb9', 'Administrador', 3), 
	( 'usr1', 'j6r3uwb9', 'Cord. Salvador', 1)

insert into razones(nombre)
	values('Academicos'),
	('Personales'),
	('Otros')


--*****************************************
-- *********** Procedimientos alamacenados
--*****************************************


DELIMITER $$
use consejodb $$

CREATE PROCEDURE `ActualizarDatos`(IN `_folio` VARCHAR(11), IN `_nom` TEXT, IN `_app` TEXT, IN `_apm` TEXT, IN `_ncontrol` INT(11), IN `_prom` DOUBLE, IN `_sem` INT, IN `_sol` TEXT, IN `_carr` INT)
BEGIN
    DECLARE numero varchar(11);
    SELECT peticion.num_control INTO numero FROM peticion
    WHERE peticion.id_peticion = _folio;

    Update alumno set alumno.num_control = _ncontrol, alumno.semestre = _sem, alumno.nom_alumno = _nom, alumno.ape_paterno = _app, alumno.ape_materno = _apm, alumno.id_carrera=_carr, alumno.prom_general = _prom
    where alumno.num_control = numero;

    UPDATE peticion set peticion.num_control=_ncontrol, peticion.peticion = _sol
    where peticion.id_peticion =_folio;

    SELECT id_peticion as folio from peticion where peticion.id_peticion = _folio;
End $$



CREATE PROCEDURE `ActualizarDatosFinalizado`(IN `_folio` VARCHAR(11), IN `_nom` TEXT, IN `_app` TEXT, IN `_apm` TEXT, IN `_ncontrol` INT(11), IN `_prom` DOUBLE, IN `_sem` INT, IN `_sol` LONGTEXT, IN `_carr` INT, IN `_dict` LONGTEXT, IN `_com` MEDIUMTEXT, IN `_status` INT(2))
BEGIN
    DECLARE numero varchar(11);
    SELECT peticion.num_control INTO numero FROM peticion
    WHERE peticion.id_peticion = _folio;

    Update alumno set alumno.num_control = _ncontrol, alumno.semestre = _sem, alumno.nom_alumno = _nom, alumno.ape_paterno = _app, alumno.ape_materno = _apm, alumno.id_carrera=_carr, alumno.prom_general = _prom
    where alumno.num_control = numero;

    UPDATE peticion set peticion.num_control=_ncontrol, peticion.peticion = _sol, peticion.dictamen = _dict, peticion.coment = _com, peticion.status = _status
    where peticion.id_peticion =_folio;

    SELECT id_peticion as folio from peticion where peticion.id_peticion = _folio;
End $$



CREATE PROCEDURE `BusquedaPerzonalizada`(IN `_name` VARCHAR(20), IN `_app` VARCHAR(20), IN `_apm` VARCHAR(20))
BEGIN
	SELECT *
    FROM peticion
        INNER JOIN alumno
            ON peticion.num_control = alumno.num_control
        INNER JOIN carrera
            ON alumno.id_carrera = carrera.id_carrera
    WHERE alumno.nom_alumno like concat( '%',_name,'%') AND
    alumno.ape_paterno like concat( '%',_app,'%') AND
    alumno.ape_materno like concat( '%',_apm,'%');

END $$



CREATE PROCEDURE `cancelarPeticion`(IN `_id` VARCHAR(11))
BEGIN
    UPDATE peticion set status=2 where id_peticion = _id;
END $$


CREATE PROCEDURE `CapturarDictamen`(IN `_folio` VARCHAR(11), IN `_dictam` LONGTEXT, IN `_comen` MEDIUMTEXT, IN `_status` INT)
BEGIN
    UPDATE peticion
    SET peticion.dictamen = _dictam, peticion.coment = _comen, peticion.status = _status
    WHERE peticion.id_peticion = _folio;

    SELECT _folio as folio;

End $$


CREATE PROCEDURE `CrearFolio`(OUT `_folio` VARCHAR(20), IN `_fecha` DATE)
    MODIFIES SQL DATA
BEGIN
    DECLARE cont varchar(11);
   	DECLARE ano varchar(11);
    DECLARE mes varchar(11);
    DECLARE dia varchar(11);

    SELECT COUNT(*)INTO cont from peticion where fechaSolicitud = _fecha;
    set cont = cont+1;

    SELECT YEAR(_fecha)INTO ano;
    SELECT MONTH(_fecha)INTO mes;
    SELECT DAY(_fecha)INTO dia;

        if(CHAR_LENGTH(dia) = 1)THEN
                set dia = CONCAT('0',dia);
        end if;
        if(CHAR_LENGTH(mes) = 1)THEN
                set mes = CONCAT('0',mes);
        end if;
        if(CHAR_LENGTH(cont) = 1)THEN
                set cont = CONCAT('000',cont);
        end if;
        if(CHAR_LENGTH(cont) = 2)THEN
                set cont = CONCAT('00',cont);
        end if;
        if(CHAR_LENGTH(cont) = 3)THEN
                set cont = CONCAT('0',cont);
        end if;

        SET _folio = CONCAT(SUBSTR(ano,3,4),mes,dia,cont);
END$$



CREATE PROCEDURE `NuevaSol`(IN `num_cont` INT, IN `nombre` VARCHAR(20), IN `ape_p` VARCHAR(20), IN `ape_m` VARCHAR(20), IN `id_carr` INT, IN `prom` DOUBLE, IN `fech_sol` DATE, IN `solicitud` LONGTEXT, IN `id_raz` INT, IN `sem` INT)
BEGIN
    Declare folio varchar(11);
    CALL `CrearFolio`(folio,fech_sol);

    INSERT INTO alumno (num_control, nom_alumno, ape_paterno, ape_materno, id_carrera, prom_general,semestre) VALUES (num_cont, nombre, ape_p, ape_m, id_carr, prom,sem);

   	INSERT INTO peticion (id_peticion, num_control, fecha, peticion, dictamen, id_razon, fechaSolicitud, coment, `status`) VALUES(folio, num_cont,'2000-01-01', solicitud, 'Sin Capturar', id_raz, fech_sol, 'Sin Comentarios', 1);

    SELECT folio;
END $$



CREATE PROCEDURE `NuevaSolPer`(IN `num_cont` INT, IN `nombre` VARCHAR(20), IN `ape_p` VARCHAR(20), IN `ape_m` VARCHAR(20), IN `id_carr` INT, IN `prom` DOUBLE, IN `fech_sol` DATE, IN `solicitud` LONGTEXT, IN `id_raz` INT, IN `sem` INT)
BEGIN
    Declare folio varchar(11);
    CALL `CrearFolio`(folio,fech_sol);

    INSERT INTO alumno (num_control, nom_alumno, ape_paterno, ape_materno, id_carrera, prom_general,semestre) VALUES (num_cont, nombre, ape_p, ape_m, id_carr, prom,sem);

   	INSERT INTO peticion (id_peticion, num_control, fecha, peticion, dictamen, id_razon, fechaSolicitud, coment, `status`) VALUES(folio, num_cont,'2000-01-01', solicitud, 'Sin Capturar', id_raz, fech_sol, 'Sin Comentarios', 3);

    SELECT folio;
END$$



create PROCEDURE `ObtenerDatosSeguimiento`(IN `_folio` VARCHAR(11))    
BEGIN
	SELECT *
	FROM peticion
    INNER JOIN alumno
        ON peticion.num_control = alumno.num_control
    INNER JOIN carrera
        ON alumno.id_carrera = carrera.id_carrera

	WHERE peticion.id_peticion= _folio;
END$$


CREATE PROCEDURE `ObtenerNuevasSolicitudes`()
BEGIN
	SELECT *
	FROM peticion
	    INNER JOIN alumno
	        ON peticion.num_control = alumno.num_control
	    INNER JOIN carrera
        	ON alumno.id_carrera = carrera.id_carrera

	WHERE peticion.status= 1;

END $$



CREATE PROCEDURE `ObtenerSolicitudesActivas`()
BEGIN
	SELECT *
	FROM peticion
	    INNER JOIN alumno
	        ON peticion.num_control = alumno.num_control
	    INNER JOIN carrera
	        ON alumno.id_carrera = carrera.id_carrera

	WHERE peticion.status= 3;
END $$




create PROCEDURE `ObtenerSolicitudesFinalizadas`(IN `_folio` VARCHAR(11))
BEGIN
	SELECT *
	FROM peticion
	    INNER JOIN alumno
	        ON peticion.num_control = alumno.num_control
	    INNER JOIN carrera
	        ON alumno.id_carrera = carrera.id_carrera
	WHERE (peticion.status= 4 or peticion.status=5) and peticion.id_peticion like concat('%',_folio,'%');
END $$



create PROCEDURE `validarNuevaPeticion`(IN `_id` VARCHAR(11))
BEGIN
        UPDATE peticion set status=3 where id_peticion = _id;

END $$



CREATE PROCEDURE `ValidarUsuario`(IN `_acount` VARCHAR(20), IN `_pass` VARCHAR(20))
BEGIN	    
	select usuarios.nombre,usuarios.nivel from usuarios
	where usuarios.cuenta = _acount and usuarios.contrasena = _pass;
END $$