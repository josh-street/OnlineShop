<?php

date_default_timezone_set('Europe/London');

DEFINE( "LOGGING", TRUE );
DEFINE( "LOGFILE", $_SERVER["DOCUMENT_ROOT"] . "/log/_API_.LOG" );

DEFINE( "DBHOST", "localhost" );	// Database location
DEFINE( "DBUSER", "root" );			// Database user
DEFINE( "DBPASS", "root" );			// Password for database user
DEFINE( "DBNAME", "OnlineShop" );   // Database name

DEFINE ( "FORCE_JSON", true);
?>