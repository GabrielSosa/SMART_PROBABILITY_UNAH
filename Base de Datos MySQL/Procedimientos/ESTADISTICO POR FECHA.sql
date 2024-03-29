DELIMITER $$
CREATE DEFINER=`obsan`@`localhost` PROCEDURE `PA_ESTADISTICO_FECHA`(IN `CODIGO_CLASE` INT, IN `FECHA` DATE, OUT `UNIVERSO` INT, OUT `CANTIDAD_APROBADOS` INT, OUT `CANTIDAD_REPROBADOS` INT)
    NO SQL
BEGIN

SELECT COUNT(*) INTO UNIVERSO FROM tbl_calificaciones A 
INNER JOIN TBL_CLASES_PLAN_ESTUDIOS B 
ON A.ID_CLASE_PLAN_ESTUDIOS = B.ID_CLASE_PLAN_ESTUDIOS 
WHERE B.ID_CLASE = CODIGO_CLASE AND A.FECHA = FECHA;

SELECT COUNT(*) INTO CANTIDAD_APROBADOS FROM tbl_calificaciones A 
INNER JOIN TBL_CLASES_PLAN_ESTUDIOS B 
ON A.ID_CLASE_PLAN_ESTUDIOS = B.ID_CLASE_PLAN_ESTUDIOS 
WHERE B.ID_CLASE = CODIGO_CLASE AND A.OBSERVACION = 'APR' AND A.FECHA = FECHA;


SET CANTIDAD_REPROBADOS = UNIVERSO - CANTIDAD_APROBADOS ;

END$$
DELIMITER ;