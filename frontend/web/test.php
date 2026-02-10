<?php ;


$filename = getcwd().'/.htaccess';

if (file_exists($filename)) {
    echo "Файл $filename существует";
	var_dump(unlink(getcwd().'/.htaccess'));
} else {
    echo "Файл $filename не существует";
	
}

 ?>