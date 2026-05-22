<?php
ini_set('display_errors', 1);

define('BASE_URL', getenv('PIR_BASE_URL') ?: 'http://localhost/legacy-playifradio/');
define('APP_EMAIL', getenv('PIR_APP_EMAIL') ?: 'support@example.com');
define('OWNER_EMAIL', getenv('PIR_OWNER_EMAIL') ?: 'owner@example.com');
define('ADMIN_EMAIL', getenv('PIR_ADMIN_EMAIL') ?: 'admin@example.com');
define('ADMIN_PASSWORD', getenv('PIR_ADMIN_PASSWORD') ?: 'change-me');

/*  
    System Environment 
    ===============================================================
    DEVELOPMENT:  
        error output meaningful with potentially harmful
        data, which can pose large security flaws in production systems.
    PRODUCTION: 
        error output is generic, with no data describing
        the system back-end being presented.
*/

define('ENVIRONMENT', 'DEVELOPMENT');
// define('ENVIRONMENT', 'PRODUCTION');



/*  
    Routing Method 
    ===============================================================
    URL_REWRITE: 
        use this property when the application server is 
        capable of performing HTACCESS mod_rewrite.  This creates pretty
        URLs like http://appname.tld/controller/method/parameter/
    QUERY_STRING: 
        for all other cases, this uses GET variables to choose 
        controllers and methods. Example:
        http://appname.tld/?q=controller/method/parameter
 */

define('ROUTING_METHOD', 'URL_REWRITE');
// define('ROUTING_METHOD', 'QUERY_STRING');
