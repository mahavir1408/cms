<?php    
        switch(ENV_NAME)
        {
                case 'local':
                        define('HOST', 'localhost');
                        define('USER', 'root');
                        define('PASS', '');
                        define('DB'  , 'ab');
                        define('DEBUG',TRUE);
                break;                
        }
?>