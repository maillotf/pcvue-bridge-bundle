# Papercut-bridge-bundle

Symfony bundle for PcVue client which is base on OAuth2 authentication

## Required configuration

### Modify framework.yaml
```yaml
pcvue:
    authentication:
        protocol: "http"
        host: "127.0.0.1"
        port: "80"
        client_id: "CLIENT_ID"
        client_secret: "CLIENT_SECRET"
        username: "USERNAME"
        password: "PASSWORD"
#        root_dir: "ROOT_DIR"
```

root_dir is optional

### Modify services.yaml
```yaml
services:
    MaillotF\Pcvue\PcvueBridgeBundle\Service\PcvueService: '@pcvue.service'
```

##Package instalation with composer

```console
$ composer require maillotf/pcvue-bridge-bundle
```

## Use in controller:

```php
<?php
//...
use MaillotF\Pcvue\PcvueBridgeBundle\Service\PcvueService;

class exampleController extends AbstractController
{
	/**
	 * Example
	 * 
	 * @Route("example", name="example", methods={"GET"})
	 * 
	 */
	public function test(PcvueService $ps)
	{
		$user = $ps->user->getUser('4665');
		
		return ($this->json($user->getEmail()));
	}

}
```

## FAQ
You can get answer in the [FAQ](https://github.com/maillotf/pcvue-bridge-bundle/blob/master/FAQ.md)