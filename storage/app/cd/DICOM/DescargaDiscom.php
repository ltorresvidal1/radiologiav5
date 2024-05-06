<?php

	$nombre=$_GET["nombre"];
	$study_iuid=$_GET["study_iuid"];
	$series_iuid=$_GET["series_iuid"];
	$objectUID=$_GET["objectUID"];

file_put_contents($nombre, fopen('http://192.168.1.73:8080/dcm4chee-arc/aets/DCM4CHEE/wado?requestType=WADO&studyUID='.$study_iuid.'&seriesUID='.$series_iuid.'&objectUID='.$objectUID.'&contentType=application/dicom', 'r'));

echo 'OK';



?>
