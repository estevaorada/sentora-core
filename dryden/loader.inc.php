<?php

/**
 * @package zpanelx
 * @subpackage core
 * @author Bobby Allen (ballen@zpanelcp.com)
 * @copyright ZPanel Project (http://www.zpanelcp.com/)
 * @link http://www.zpanelcp.com/
 * @license GPL (http://www.gnu.org/licenses/gpl.html)
 */

/**
 * Script timer (start) used for determining script execution time.
 */
global $starttime;
$mtime = microtime();
$mtime = explode(" ", $mtime);
$mtime = $mtime[1] + $mtime[0];
$starttime = $mtime;

function __autoload($class_name) {
    $path = str_replace("_", "/", $class_name);
    if (file_exists("dryden/" . $path . ".class.php")) {
        require_once "dryden/" . $path . ".class.php";
    }


    /**
     * If a module has been called and is running we need to include classe's from the module's 'code' folder.
     */
    if (isset($_GET['module'])) {
        /**
         * Load in the Controller extentsion class to be used with the standard 'action' requests.
         */
        if (file_exists("modules/" . $_GET['module'] . "/code/controller.ext.php")) {
            require_once "modules/" . $_GET['module'] . "/code/controller.ext.php";
        }
        /**
         * Dynamically load other standard classes.
         */
        $additional_path = str_replace("_", "/", $class_name);
        if (file_exists("modules/" . $_GET['module'] . "/code/" . $class_name . ".class.php")) {
            require_once "modules/" . $_GET['module'] . "/code/" . $class_name . ".class.php";
        }
    }
}

?>