<?php

namespace MaillotF\Pcvue\PcvueBridgeBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use MaillotF\Pcvue\PcvueBridgeBundle\DependencyInjection\PcvueExtension;

/**
 * Description of PcvueBridgeBundle
 *
 * @package MaillotF\Pcvue\PcvueBridgeBundle
 * @author Flavien Maillot "contact@webcomputing.fr"
 */
class PcvueBridgeBundle extends Bundle
{

	public function getContainerExtension()
	{
		return new PcvueExtension();
	}

}
