<?php
/************************************************************************
 * FICHIER DE CONFIGURATION - VARIABLES D'ENVIRONNEMENT                 *
*************************************************************************/
$rb_DBHost = "localhost"; /* MySql database server */
$rb_DBLogin = "root"; /* MySql database login */
$rb_DBPassword = ""; /* MySql database password */
$rb_DBName ="rbcustomcms"; /* MySql database name */

/*
 * Erreurs PHP
 * Pour afficher les erreurs PHP sur le site, retirez ou commentez les lignes suivantes.
 * Le deuxième paramètre de ini_set peut également être passé à 0.
 */
ini_set('display_errors', 1);
error_reporting(E_ALL & ~E_STRICT);