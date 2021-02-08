<?php
if (isset($_COOKIE['name'])) echo "HELLO ". $_COOKIE['name'].";";
else    echo "HELLO Guest";
echo <<<_END
        <hr>
        <a href="cookie.php">Main page</a>
    </body>
</html>
_END;