<?php
// Base EPP objects
include_once('Protocols/EPP/eppConnection.php');
// Connection object to Metaregistrar EPP server - this contains your userid and passwords!
include_once('Registries/Metaregistrar/metaregEppConnection.php');
include_once('Registries/IIS/iisEppConnection.php');
include_once('Registries/SIDN/sidnEppConnection.php');

// Base EPP commands: hello, login and logout
include_once('base.php');


/*
 * This script checks for the availability of domain names
 *
 * You can specify multiple domain names to be checked
 */


if ($argc <= 1)
{
    echo "Usage: changepassword <password>\n";
    echo "Please enter new password you want to use\n\n";
    die();
}

$newpassword = $argv[1];

echo "Changing password\n";
try
{
    $conn = new sidnEppConnection();
    $conn->setNewPassword($newpassword);
    // Connect to the EPP server
    if ($conn->connect())
    {
        if (login($conn))
        {
            echo "Password was changed\n";
        }
    }
}
catch (eppException $e)
{
    echo "ERROR: ".$e->getMessage()."\n\n";
}
