<?php
require_once('root.php');
trait App
{
    public function plugin()
    {
        return new class {
            public function check($dir)
            {
                if (is_dir(PROJECT_ROOT . 'plugin' . $dir)) {
                    if (file_exists(PROJECT_ROOT . 'plugin' . $dir . '/plugin.json') and file_exists(PROJECT_ROOT . 'plugin' . $dir . '/main.php')) {
                        $json = file_get_contents(PROJECT_ROOT . 'plugin' . $dir . '/plugin.json');
                        $array = json_decode($json,true);
                        if (isset($array['command'])) {
                            return true;
                        } else {
                            return false;
                        }
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            }
            public function checkall(){
                if ($handle = opendir(PROJECT_ROOT . 'plugin')) {
                    while (false !== ($entry = readdir($handle))) {
                        if ($entry != "." && $entry != "..") {
                            return "$entry";
                        }
                    }
                    closedir($handle);
                } else {
                    return false;
                }
            }
        };
    }
}
