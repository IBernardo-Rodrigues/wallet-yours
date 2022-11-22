<?php

const DSN = "mysql:dbname=epiz_33043064_walletyours;host=sql304.epizy.com";
const USER = "epiz_33043064";
const PASSWORD = "bQ5r19OsjqR1T";
const OPTIONS = [
  PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
  PDO::ATTR_CASE => PDO::CASE_NATURAL ];
