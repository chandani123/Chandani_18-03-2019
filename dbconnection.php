<?php
class database {

    var $_sql			= '';
    /** @var Internal variable to hold the connector resource */
    var $_resource		= '';
    /** @var Internal variable to hold the query result*/
    var $_result        = '';
    /** @var Internal variable to hold the query result*/
    var $_insert_id        = '';

    //$host = '';
    /**
     * Database object constructor
     * @param string Database host
     * @param string Database user name
     * @param string Database user password
     * @param string Database name
     * @param string Common prefix for all tables
     * @param boolean If true and there is an error, go offline
     */
    function database() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $con = new mysqli($servername, $username, $password,'mindarc_assessment');
        if ($con->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    }
    function dbClose(){
        mysql_close($this->_resource);
    }

    function fetchArray($rs){

        return @mysql_fetch_array($rs);
    }

}
?>
