<?php

require_once('config.php');

///////////////////////
// Author: Trevin Chow
// Email: t1@mail.com
// Date: February 21, 2000
// Last Updated: August 14, 2001
//
// Description:
// Abstracts both the php function calls and the server information to POSTGRES
// databases. Utilizes class variables to maintain connection information such
// as number of rows, result id of last operation, etc.
//
// Sample Usage:
// include("include/dblib.php");
// $db = new phpDB();
// $db->connect("foobar");
// $db->exec("SELECT * from TREVIN");
// while ($db->nextRow()) {
// $rs = $db->fobject();
// echo "$rs->description : $rs->color : $rs->price <br>
// }

class phpDB
{
    // set when connect() is called
    var $hostName = 'localhost';
    var $port = '';
    var $userName = '';
    var $password = '';
    var $databaseName = '';
    var $connectionID = -1;
    var $row = -1; // a row counter, needed to loop through records in postgres.
    var $result = null; // point to result set.
    var $errorCode = 0; // internal error code

    ////////////////////////////////////////////
    // Core primary connection/database function
    ////////////////////////////////////////////

    /*
     *  Crea la conexión a la base de datos.
     */
    function connect()
    {

        $this->hostName = MY_HOST;
        $this->port = MY_PORT;
        $this->userName = MY_USER;
        $this->password = MY_PASS;
        $this->databaseName = MY_BD;

        // build connection string based on internal settings.
        $connStr = '';
        ( $this->hostName != '' ) ? ( $connStr .= "host=" . $this->hostName . " " ) : ( $connStr = $connStr );
        ( $this->port != '' ) ? ( $connStr .= "port=" . $this->port . " " ) : ( $connStr = $connStr );
        ( $this->databaseName != '' ) ? ( $connStr .= "dbname=" . $this->databaseName . " " ) : ( $connStr = $connStr );
        ( $this->userName != '' ) ? ( $connStr .= "user=" . $this->userName . " " ) : ( $connStr = $connStr );
        ( $this->password != '' ) ? ( $connStr .= "password=" . $this->password . " " ) : ( $connStr = $connStr );
        $connStr = trim( $connStr );

        $connID = pg_connect( $connStr );
        if ( $connID != "" ) {
            $this->connectionID = $connID;
            $this->exec( "set datestyle='ISO'", array() );
            $this->exec( "set time zone 'America/Santiago'", array() );
            return $this->connectionID;
        } else {
            // FATAL ERROR - CONNECTI0N ERROR
            $this->errorCode    = -1;
            $this->connectionID = -1;
            return 0;
        }
    }

    /*
     *  Cierra la conexión.
     */
    function close( )
    {
        if ( $this->connectionID != "-1" ) {
            $this->RollbackTrans(); // rollback transaction before closing
            $closed = pg_close( $this->connectionID );
            return $closed;
        } 
		else {
            // connection does not exist
            return null;
        }
    }

    /*
     *  Ejecutar Query
     *  @param $query [String] Query SQL a ejecutar.
     *  @return Resultado de la query.
     *  Ejemplos: $db->exec("INSERT INTO alumnos (nombre) VALUES($1)", array('Juan'))
     *            $db->exec("SELECT * FROM alumnos", array())
     *            $db->exec("SELECT * FROM alumnos WHERE nombre=$1, username=$2", array('juan', 'perez'))
     */
    function exec( $query, $params )
    {
        if ( $this->connectionID != "-1" ) {
            $this->result = pg_query_params( $this->connectionID, $query, $params );
            if ( $this->numRows() > 0 )
                $this->moveFirst();
            return $this->result;
        } else
            return 0;
    }

    /*
     *  Recuperar el último error levantado.
     *  @return [String] Error.
     */
    function errorMsg()
    {
        if ( $this->connectionID == "-1" ) {
            switch ( $this->errorCode ) {
                case -1:
                    return "FATAL ERROR - CONNECTION ERROR: RESOURCE NOT FOUND";
                    break;
                case -2:
                    return "FATAL ERROR - CLASS ERROR: FUNCTION CALLED WITHOUT PARAMETERS";
                    break;
                default:
                    return null;
            }
        } else {
            return pg_errormessage( $this->connectionID );
        }
    }

    ////////////////////
    // Movimiento de Cursor
    ////////////////////

    /*
     *  Mueve el cursor a la primera fila del resultado.
     *  @return [Bool] true si se puede mover el cursor.
     */
    function moveFirst( )
    {
        if ( $this->result == null )
            return false;
        else {
            $this->setRow( 0 );
            return true;
        }
    }

    /*
     *  Mueve el cursor a la última fila del resultado.
     *  @return [Bool] true si se puede mover el cursor.
     */
    function moveLast( )
    {
        if ( $this->result == null )
            return false;
        else {
            $this->setRow( $this->numRows() - 1 );
            return true;
        }
    }

    /*
     *  Mueve el cursor a la siguiente fila del resultado.
     *  @return [Bool] false si no quedan filas.
     */
    function prevRow( )
    {
        // If not first row, then advance row pointer
        if ( $this->row > 0 ) {
            $this->setRow( $this->row - 1 );
            return true;
        } else
            return false;
    }

    /*
     *  Mueve el cursor a la siguiente fila del resultado.
     *  @return [Bool] false si no hay fila siguiente (no quedan filas).
     *  Ejemplo: Uso en un ciclo while, para avanzar la fila y parar cuando
     *  no quedan.
     *  do {
     *      $alumno = $db->fobject();
     *  } while ($db->nextRow());
     */
    function nextRow( )
    {
        // If more rows, then advance row pointer
        if ( $this->row < $this->numRows() - 1 ) {
            $this->setRow( $this->row + 1 );
            return true;
        } else
            return false;
    }

    /*
     *  Mueve el cursor a una fila en particular.
     *  @param $row [Row] Fila hacia la que se quiere mover (NO el número de fila).
     */
    function setRow( $row )
    {
        $this->row = $row;
    }

    ///////////////////////
    // Métodos sobre el resultado
    ///////////////////////

    /*
     *  Recuperar una fila como un objeto, para poder acceder
     *  a sus atributos usando la notación $objeto->atributo.
     *  @return Fila de resultado representada como un objeto.
     *  Ejemplo:
     *  // Mostrar el nombre de un alumno
     *  $alumno = $db->fobject();
     *  echo $alumno->nombre;
     */
    function fobject( )
    {
        if ( $this->result == null || $this->row == "-1" )
            return null;
        else {
            $object = pg_fetch_object( $this->result, $this->row );
            return $object;
        }
    }

    /*
     *  Recuperar una fila como un arreglo.
     *  @return Fila de resultado representada como un arreglo.
     *  Ejemplo:
     *  // Mostrar el nombre de un alumno
     *  $alumno = $db->farray();
     *  echo $alumno["nombre"];
     */
    function farray( )
    {
        if ( $this->result == null || $this->row == "-1" )
            return null;
        else {
            $arr = pg_fetch_array( $this->result, $this->row );
            return $arr;
        }
    }

    /*
     *  Retorna el número de filas que fueron afectadas
     *  por un comando DELETE, UPDATE o INSERT.
     *  (por ejemplo, cuántas filas se agregaron)
     *  @return [Integer] Número de filas afectadas.
     */
    function numAffected( )
    {
        if ( $this->result == null )
            return 0; // no result to return result from!
        else
            return pg_cmdtuples( $this->result );
    }

    /*
     *  Retorna el número de filas que se recuperaron
     *  con una consulta de tipo SELECT.
     *  Ejemplo:
     *  // Mostrar la cantidad total de alumnos
     *  $db->exec('SELECT * FROM alumnos', array());
     *  echo $db->numRows;
     */
    function numRows( )
    {
        if ( $this->result == null )
            return 0;
        else {
            $this->numrows = pg_numrows( $this->result );
            return $this->numrows;
        }
    }

    /*
     *  Retorna la fila actual (donde está el cursor).
     *  @return Fila actual.
     *  NOTA: Esto no es el objeto sobre el cual trabajar,
     *  es la fila que usa internamente este archivo.
     */
    function currRow( )
    {
        return $this->row;
    }

    /*
     *  Retorna el número de campos (columnas) de un resultado.
     *  @return [Integer] Cantidad de columnas del resultado.
     */
    function numCols( )
    {
        if ( $this->result == null )
            return 0;
        else
            return pg_numfields( $this->result );
    }

    /*
     *  Obtener el nombre de la columna especificada del resultado.
     *  @param $fieldnum Número de columna que se quiere conocer.
     *  @return [String] Nombre de columna.
     *  Rel: Ver numCols()
     */
    function fieldname( $fieldnum )
    {
        if ( $this->result == null )
            return null;
        else
            return pg_FieldName( $this->result, $fieldnum );
    }

    ////////////////////////
    // Transaction related
    ////////////////////////

    function beginTrans( )
    {
        return @pg_exec( $this->connectionID, "begin" );
    }

    function commitTrans( )
    {
        return @pg_exec( $this->connectionID, "commit" );
    }

    // returns true/false
    function rollbackTrans( )
    {
        return @pg_exec( $this->connectionID, "rollback" );
    }

    ////////////////////////
    // SQL String Related
    ////////////////////////

    /*
     *  Sanitiza una consulta SQL.
     *  @param $string Consulta SQL
     *  @return Consulta SQL sanitizada
     */
    function querySafe( $string )
    {
        // replace ' with '
        $string = str_replace( "'", "'", $string );

        // replace line-break characters
        $string = str_replace( "
", "", $string );
        $string = str_replace( " ", "", $string );

        return $string;
    }
} // end class phpDB

?>
