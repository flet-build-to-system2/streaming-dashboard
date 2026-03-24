<?php
// Root entry point — redirects to public/index.php
$query = $_SERVER['QUERY_STRING'];
$qs = $query ? '?'.$query : '';
header("Location: public/index.php$qs");
exit;
?>
