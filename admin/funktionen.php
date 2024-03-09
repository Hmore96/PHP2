<?php
//notwenidg, um auf die $_session zur Verfügung zu haben.
session_start();

 $db = mysqli_connect("localhost", "root","","php2");
 //MySQLI mitteilen, dass unsere Befehle als utf8 kommen

 mysqli_set_charset($db, "utf8");
