<?php

declare(strict_types=1);

namespace {{BPREPLACENAMESPACE}};

use WpService\Contracts\AddAction;
use WpUtilService\Features\Enqueue\EnqueueManager;

class App
{
    public function __construct(
        AddAction $wpService,
        private EnqueueManager $wpEnqueue,
    ) {
        $wpEnqueue->on('admin_enqueue_scripts')->add('css/{{BPREPLACESLUG}}.css')->add('js/{{BPREPLACESLUG}}.js');
    }
}
