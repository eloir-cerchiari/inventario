<?php

namespace Util;
/**
 * Description of SlimUtil
 *
 * @author eloir
 */
class SlimUtil {

    public static function absoluteUrlFor($name, $params = array()){
        
        return \Slim\Slim::getInstance()->request->getUrl().\Slim\Slim::getInstance()->urlFor($name, $params);
        
    }

}