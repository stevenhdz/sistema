<?php
header("Content-type: application/force-download");
header("Content-Disposition: attachment; filename=\"export.csv\"");
header("Content-Length: ".filesize("my-file.js"));
?>