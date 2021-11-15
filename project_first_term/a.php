<?php
    $pw = 'xd';
    $passwd = password_hash($pw, PASSWORD_DEFAULT);
    echo '<br/>' . $passwd;
    echo '<br/>' . password_verify('xdd', $passwd);
?>