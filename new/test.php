<?php
header('Content-type: application/pdf');
header('Content-Disposition: inline; filename="700.PDF"');
readfile("700.PDF");
exit;
?>