
DROP TRIGGER TG_prestado on prestamo;
DROP TRIGGER TG_devuelto on prestamo;
DROP TRIGGER TG_stock on copia_libro;

CREATE OR REPLACE FUNCTION prestado() RETURNS TRIGGER AS $TG_prestado$
	BEGIN
		UPDATE libro SET stock = stock - 1 WHERE id = NEW.copia_libro_libro_id;
		UPDATE copia_libro SET prestado = true WHERE libro_id = NEW.copia_libro_libro_id AND numero = NEW.copia_libro_numero;
	RETURN NEW;
	END;
$TG_prestado$	LANGUAGE plpgsql;
	

CREATE TRIGGER TG_prestado 
	BEFORE INSERT ON prestamo
	FOR EACH ROW EXECUTE PROCEDURE prestado();
		
CREATE OR REPLACE FUNCTION devuelto() RETURNS TRIGGER AS $TG_devuelto$
	BEGIN
		UPDATE libro SET stock = stock + 1 WHERE id = NEW.copia_libro_libro_id;
		UPDATE copia_libro SET prestado = false WHERE libro_id = NEW.copia_libro_libro_id AND numero = NEW.copia_libro_numero;
	RETURN NEW;
	END;
$TG_devuelto$	LANGUAGE plpgsql;

CREATE TRIGGER TG_devuelto
	BEFORE UPDATE ON prestamo
	FOR EACH ROW EXECUTE PROCEDURE devuelto();

CREATE  OR REPLACE FUNCTION num_lib() RETURNS TRIGGER AS $TG_stock$
	DECLARE
	BEGIN
		update libro set stock = stock + 1 where id=NEW.libro_id;
	RETURN NEW;
	END;
$TG_stock$ LANGUAGE plpgsql;

CREATE  TRIGGER TG_stock
    BEFORE INSERT ON copia_libro
    FOR EACH ROW EXECUTE PROCEDURE num_lib();

