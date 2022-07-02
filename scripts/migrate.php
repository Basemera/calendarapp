<?php
require __DIR__."/hashMigrations.php";
require(__DIR__."/migrations/2022_06_30_1656629661_create_users_table.php");
require(__DIR__."/migrations/2022_07_01_1656703288_create_users_table.php");
include(__DIR__."/migrations/2022_07_02_1656722019_create_invites_table.php");

// foreach (scandir(__DIR__."/migrations") as $filename) {
//     include $filename;
// }
// glob("folder/*.php")
$opt = 'm:';
$options = getopt($opt);
$file_name = $options ? $options['m'] : "";
$migrations = [];
$hashed_migration = new HashMigrations();
if (!$options) {
// echo scandir((__DIR__."/scripts/migrations"));
$migrations_files = array_diff(scandir((__DIR__."/migrations")), ['..', '.']);
foreach ($migrations_files as $migration_file) {
$migration_file_path = __DIR__."/migrations"."/".$migration_file;
$file1 = preg_replace('/[0-9]/','',$migration_file);
$file2 = explode("_", $file1);
$file3 = implode(" ", $file2);
$file4 = ucwords($file3);
$file5 = str_replace(" ", "", $file4);
$file6 = str_replace("php", "", $file5);
$file7 = str_replace(".", "", $file6);
$class_name = $file7;
echo $migration_file_path;
var_dump(file_exists($ENGINE._DIR__."/migrations/2022_07_02_1656722019_create_invites_table.php"));
$class = new $class_name();
if($hashed_migration->migrationExists($migration_file) && $hashed_migration->compareFileContents($migration_file)){
continue;
}
elseif ($hashed_migration->migrationExists($migration_file) && !$hashed_migration->compareFileContents($migration_file)) {
$created = $class->createTable();
$hashed_migration->UpdateFileContentsHash($migration_file);
echo "Migration ".$migration_file." has been run.";
continue;
}
else{
$created = $class->createTable();
if ($created) {
$hashed_migration->storeHash($migration_file_path);
echo "Migration ".$migration_file." has been run.";
} else {
echo "Couldnot run migration". $migration_file ."";
}
continue;
}
}
} else {
$migration_file = $file_name;
$migration_file = __DIR__."/migrations"."/".$migration_file;
$file1 = preg_replace('/[0-9]/','',$migration_file);
$file2 = explode("_", $file1);
$file3 = implode(" ", $file2);
$file4 = ucwords($file3);
$file5 = str_replace(" ", "", $file4);
$file6 = str_replace("php", "", $file5);
$file7 = str_replace(".", "", $file6);
$class_name = $file7;
echo $migration_file;

$class = new $class_name();
if($hashed_migration->migrationExists($migration_file) && $hashed_migration->compareFileContents($migration_file)){
return;
}
elseif ($hashed_migration->migrationExists($migration_file) && !$hashed_migration->compareFileContents($migration_file)) {
$created = $class->createTable();
$hashed_migration->UpdateFileContentsHash($migration_file);
echo "Migration ".$migration_file." has been run.";
return true;
}
else{
$created = $class->createTable();
if ($created) {
$hashed_migration->storeHash($migration_file_path);
echo "Migration ".$migration_file." has been run.";
return true;
} else {
echo "Couldnot run migration". $migration_file ."";
}
return true;
}
}
$hashed_migration->checkForUpdate();
?>