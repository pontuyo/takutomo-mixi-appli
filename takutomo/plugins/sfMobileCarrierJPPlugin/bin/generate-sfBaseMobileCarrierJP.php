#!/usr/bin/env php
<?php

/**
 * test batch script
 *
 * Here goes a brief description of the purpose of the batch script
 *
 * @package    mobile
 * @subpackage batch
 * @version    $Id$
 */

define('SF_ROOT_DIR',    realpath(dirname(__file__).'/../../..'));
define('SF_APP',         'frontend');
define('SF_ENVIRONMENT', 'dev');
define('SF_DEBUG',       1);

require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');

echo "<?php\n";
?>
class sfBaseMobileCarrierJP
{
    public static function loadYaml($name){
        $file = SF_ROOT_DIR . "/plugins/sfMobileCarrierJPPlugin/data/" . $name . ".yml";
        $cache = new sfFunctionCache(SF_ROOT_DIR . "/cache/".SF_APP."/".SF_ENVIRONMENT."/sfMobileCarrierJPPlugin");
        return $cache->call("sfYaml::load",$file);
    }
<?php generateMethods(findYamls()); ?>
}

<?php
function findYamls(){
    $yamls = array();
    $finder = sfFinder::type('file')
        ->ignore_version_control()
        ->follow_link()->name("*.yml");
    if($files = $finder->in(SF_ROOT_DIR
                            ."/plugins/sfMobileCarrierJPPlugin/data")){
        foreach($files as $file){
            $yamls[] = basename($file , ".yml");
        }
    }
    return $yamls;
}
function generateMethods($yamls){
    foreach($yamls as $yaml){
        $name = str_replace("-","_",$yaml);
        $name = "get".sfInflector::camelize($name);
        ?>
    /**
     * <?php echo $name."()\n" ?>
     *
     * #test
     * <code>
     * #true(count(sfBaseMobileCarrierJP::<?php echo $name ?>()) > 0);
     * </code>
     */
            <?php
        printf("public static function %s(){\n",$name);
        echo("return self::loadYaml(\"{$yaml}\");}\n");
    }
}

