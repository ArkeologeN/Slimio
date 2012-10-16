<!--
 Copyright (c) 2012. All Rights Reserved. The PlumTree Group
 Code is under development state at The PlumTree Group written by
 Hamza Waqas (Mobile Application Developer) at Karachi from MacOSX
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <a href="<?php print ($this->makeUrl(array(
                    '_logic' => 'index',
                    '_handler' => 'bye',
                    '_args'  => array('edit','delete'),
                    '_query'    => array('uid' => 1)
                )
            )); ?>">Bye Handler</a>
        <h1>Hello <?php print $hi //echo '<pre>'; print_r($this); exit; ?></h1>
    </body>
</html>
