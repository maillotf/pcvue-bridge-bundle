<?php

namespace MaillotF\Pcvue\PcvueBridgeBundle\Helpers;

use MaillotF\Pcvue\PcvueBridgeBundle\Objects\PcVueObject;

/**
 * Description of CastHelper
 *
 * @author Flavien Maillot "contact@webcomputing.fr"
 */
class CastHelper
{

	/**
	 * Cast stdObject to a PcVueObject
	 * 
	 * @param type $instance
	 * @param string $className
	 * @return PcVueObject
	 * @author Flavien Maillot 
	 */
	public static function cast($instance, string $className): PcVueObject
	{
		$className = 'MaillotF\\Pcvue\\PcvueBridgeBundle\\Objects\\' . $className;
		$result = unserialize(sprintf(
						'O:%d:"%s"%s',
						\strlen($className),
						$className,
						strstr(strstr(serialize($instance), '"'), ':')
		));
		$result->init();
		return ($result);
	}

}
