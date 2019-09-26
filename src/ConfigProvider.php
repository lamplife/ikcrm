<?php

declare(strict_types=1);

/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

namespace Firstphp\Ikcrm;

use Firstphp\Ikcrm\Facades\IkcrmFactory;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
                IkcrmInterface::class => IkcrmFactory::class
            ],
            'commands' => [
            ],
            'scan' => [
                'paths' => [
                    __DIR__,
                ],
            ],
            'publish' => [
                [
                    'id' => 'config',
                    'description' => 'The config for firstphp-ikcrm.',
                    'source' => __DIR__ . '/publish/ikcrm.php',
                    'destination' => BASE_PATH . '/config/autoload/ikcrm.php',
                ],
            ],
        ];
    }
}
