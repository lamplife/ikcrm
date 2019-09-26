<?php

declare(strict_types = 1);

/**
 * Author: 狂奔的螞蟻 <www.firstphp.com>
 * Date: 2019/9/25
 * Time: 6:48 PM
 */

namespace Firstphp\Ikcrm\Facades;

use Firstphp\Ikcrm\IkcrmClient;
use Hyperf\Contract\ConfigInterface;
use Psr\Container\ContainerInterface;

class IkcrmFactory
{

    /**
     * @var ContainerInterface
     */
    protected $container;

    public function __invoke(ContainerInterface $container)
    {
        $contents = $container->get(ConfigInterface::class);
        $config = $contents->get("ikcrm");
        return $container->make(IkcrmClient::class, compact('config'));
    }

}