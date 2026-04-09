<?php

$db = \Config\Database::connect();
$db->query("ALTER TABLE hafalan ADD COLUMN nilai FLOAT DEFAULT 0 AFTER status;");
echo "Column 'nilai' added to 'hafalan' table.\n";
