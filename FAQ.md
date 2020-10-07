# Frequently Asked Questions

- [How to get variable path for realtime service ?](#how-to-get-variable-path-for-realtime-service)
- [How to get the value for variable path in realtime service ?](#how-to-get-the-value-for-variable-path-in-realtime-service)

## How to get variable path for realtime service ?

First, we need to get all accessible branch from the root. Then, we can construct new variable path

```php
use MaillotF\Pcvue\PcvueBridgeBundle\Service\PcvueService;

public function test(PcvueService $ps)
{
	//Get Variable object for the root
	$rootVariables = $ps->realtime->getVariables('');
	//List of the paths for the root
	$path = $rootVariables->getBranchPaths();
	dump($path);
	
	//Get Variable object for a path previoulsy got
	$lvlOneVariables = $ps->realtime->getVariables($path[0]);
}
```

## How to get the value for variable path in realtime service ?

```php
use MaillotF\Pcvue\PcvueBridgeBundle\Service\PcvueService;

public function test(PcvueService $ps)
{
	
	$variable = $ps->realtime->getValues('75/Paris/Orsay/Floor4/Area1/elec_meter/ACTIVE_ENERGY');
	dump($variable);
}
```

```json
{
	"result": {
		"code": {
			"value": 1,
			"label": "S_Ok"
		},
		"Description": null
	},
	"value": 1639.1600341797,
	"Timestamp": "2020-10-07T14:31:52.676",
	"datetime": null,
	"quality": "Good",
	"properties": [],
	"IsReadOnly": false,
	"QualityValue": 192,
	"alarm": null
}
```

Datetime variable will be set only when getDatetime() method will be call.