<?php

$dir = "X:\Folder";
$extensions = array();
$fileNames = array();
$fileSizes = array();
scanDirectory($dir, $extensions, $fileNames, $fileSizes);
$extensions = array_unique($extensions);
foreach ($extensions as $elem) {
	echo $elem . '<br>';
}
print_r($fileNames);
$fileSizesNew = array();
foreach($fileSizes as $elem) {
    $elem = $elem / 1000; # В килобайты.
    $elem = $elem / 1000; # В мегабайты.
    $fileSizesNew[] = $elem;
}
$averageSize = array_sum($fileSizesNew) / count($fileSizesNew);
echo "<br><b> Average File Size = $averageSize </b><br>";

function scanDirectory($dir, &$extensions, &$fileNames, &$fileSizes) {
	$contents = scandir($dir);
	// print_r($contents);
	echo '<br><br><br>';

	foreach ($contents as $elem) {
		if ($elem == '.' or $elem == '..') {
            continue;
        }

        # Если не директория, получаем расширение.
        if (!is_dir($dir . '/' . $elem)) {
        	$extension = pathinfo($dir . '/' . $elem, PATHINFO_EXTENSION);
        	$extensions[] = $extension;
        	$fileNames[] = $elem;
            $fileSizes[] = filesize($dir . '/' . $elem);
        } else {
        	# Если директория, вызываем функцию повторно.
        	echo "<br><b>$elem is a dir</b><br>";
            scanDirectory($dir . '/' . $elem, $extensions, $fileNames, $fileSizes);
        }
    }

    // print_r($extensions);

    return $extensions;
}



?>