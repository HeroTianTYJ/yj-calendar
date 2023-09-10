<?php

use yjrj\Calendar;

bcscale(12);

$GLOBALS['config'] = include __DIR__ . '/config.php';
include __DIR__ . '/extend/common.php';
include __DIR__ . '/extend/Lunar.php';
include __DIR__ . '/extend/Solar.php';
include __DIR__ . '/extend/Calendar.php';
?>
<!doctype html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<title>昱杰万年历</title>
<script type="text/javascript" src="static/jquery.js"></script>
<script type="text/javascript" src="static/LayUI/js/LayUI.js"></script>
<script type="text/javascript" src="static/jquery.print.js"></script>
<script type="text/javascript" src="static/index.js"></script>
<link rel="stylesheet" type="text/css" href="static/LayUI/css/LayUI.css">
<link rel="stylesheet" type="text/css" href="static/index.css">
<script type="text/javascript">let DEVICE = '<?php echo device();?>';</script>
</head>

<body>
<?php echo (new Calendar())->html();?>
</body>
</html>