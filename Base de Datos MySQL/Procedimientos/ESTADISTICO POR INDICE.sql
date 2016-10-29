CREATE DEFINER=`obsan`@`localhost` PROCEDURE `PA_ESTADISTICO_POR_INDICE`(IN `PESO` INT, IN `RANGO` INT, IN `CODIGO_CLASE` INT, OUT `UNIVERSO` INT, OUT `CANTIDAD_APROBADOS` INT, OUT `CANTIDAD_REPROBADOS` INT) NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER BEGIN
	
 
  SELECT COUNT(*) INTO UNIVERSO
		FROM (
		FROM (
		select Z.INDICE_GLOBAL ,Z.ID_ESTUDIANTES, Z.FECHA, SUM(Z.PESO) as PESO from 
		( 
			SELECT K.INDICE_GLOBAL,A.ID_ESTUDIANTES, A.FECHA, SUM(UV) AS PESO FROM 

				TBL_CALIFICACIONES A 
				INNER JOIN TBL_CLASES_PLAN_ESTUDIOS B 
				ON A.ID_CLASE_PLAN_ESTUDIOS = B.ID_CLASE_PLAN_ESTUDIOS 
				INNER JOIN TBL_CLASES C 
				ON B.ID_CLASE = C.ID_CLASE
				INNER JOIN TBL_ESTUDIANTES K
				ON (K.ID_ESTUDIANTE = A.ID_ESTUDIANTES) 

			WHERE FECHA IN
				(SELECT A.FECHA FROM TBL_CALIFICACIONES A 
					INNER JOIN TBL_CLASES_PLAN_ESTUDIOS B 
					ON A.ID_CLASE_PLAN_ESTUDIOS = B.ID_CLASE_PLAN_ESTUDIOS 
						WHERE B.ID_CLASE = @CODIGO_CLASE) AND B.ID_CLASE != @CODIGO_CLASE AND ID_ESTUDIANTES 
						IN(SELECT ID_ESTUDIANTES FROM TBL_CALIFICACIONES A 
							INNER JOIN TBL_CLASES_PLAN_ESTUDIOS B 
							ON A.ID_CLASE_PLAN_ESTUDIOS = B.ID_CLASE_PLAN_ESTUDIOS 
							WHERE B.ID_CLASE = @CODIGO_CLASE)

			GROUP BY ID_ESTUDIANTES, FECHA, B.ID_CLASE, INDICE_GLOBAL

		)Z where  Z.PESO BETWEEN @PESO-@RANGO AND @PESO+@RANGO
		AND Z.INDICE_GLOBAL = @INDICE
		GROUP BY Z.ID_ESTUDIANTES, Z.FECHA, Z.INDICE_GLOBAL) TABLA_UNIVERSO  ;


SELECT COUNT(*) INTO CANTIDAD_APROBADOS 
		FROM(select  Z.INDICE_GLOBAL,Z.ID_ESTUDIANTES, Z.FECHA, SUM(Z.PESO) as PESO, Z.OBSERVACION from 
		( 
			SELECT K.INDICE_GLOBAL,A.ID_ESTUDIANTES, A.OBSERVACION, A.FECHA, SUM(UV) AS PESO FROM 

				TBL_CALIFICACIONES A 
				INNER JOIN TBL_CLASES_PLAN_ESTUDIOS B 
				ON A.ID_CLASE_PLAN_ESTUDIOS = B.ID_CLASE_PLAN_ESTUDIOS 
				INNER JOIN TBL_CLASES C 
				ON B.ID_CLASE = C.ID_CLASE 
				INNER JOIN TBL_ESTUDIANTES K
				ON (K.ID_ESTUDIANTE = A.ID_ESTUDIANTES) 

			WHERE FECHA IN
				(SELECT A.FECHA FROM TBL_CALIFICACIONES A 
					INNER JOIN TBL_CLASES_PLAN_ESTUDIOS B 
					ON A.ID_CLASE_PLAN_ESTUDIOS = B.ID_CLASE_PLAN_ESTUDIOS 
						WHERE B.ID_CLASE = @CODIGO_CLASE) AND B.ID_CLASE != @CODIGO_CLASE AND ID_ESTUDIANTES 
						IN(SELECT ID_ESTUDIANTES FROM TBL_CALIFICACIONES A 
							INNER JOIN TBL_CLASES_PLAN_ESTUDIOS B 
							ON A.ID_CLASE_PLAN_ESTUDIOS = B.ID_CLASE_PLAN_ESTUDIOS 
							WHERE B.ID_CLASE = @CODIGO_CLASE)

			GROUP BY ID_ESTUDIANTES, FECHA, B.ID_CLASE, A.OBSERVACION , INDICE_GLOBAL

		)Z where  Z.PESO BETWEEN @PESO-@RANGO AND @PESO+@RANGO --'5 (+- Rango(2))'
		AND Z.INDICE_GLOBAL = @INDICE
		GROUP BY Z.ID_ESTUDIANTES, Z.FECHA, Z.OBSERVACION, Z.INDICE_GLOBAL) TABLA
		WHERE OBSERVACION = 'APR' ;


SET CANTIDAD_REPROBADOS = UNIVERSO - CANTIDAD_APROBADOS ;

END