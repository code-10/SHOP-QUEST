<?php

function getCon()
{
    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"], 1);

    $con = new mysqli($server, $username, $password, $db);

    if ($con->connect_error) die($con->connect_error);

    return $con;

}

function rowExists($table, $search_param, $search_value)
{

    $con = getCon();

    $sql = "select * from $table where $search_param='$search_value';";

    $res = $con->query($sql);

    if ($res === False) die($con->error);
    else if ($res->num_rows > 0) return True;
    else return False;

}

?>
