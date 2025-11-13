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
        $wpService->AddAction(
            hookName: 'admin_enqueue_scripts',
            callback: function () {
                $this->wpEnqueue->add('css/{{BPREPLACESLUG}}.css');
            },
        );
        $wpService->AddAction(
            hookName: 'admin_enqueue_scripts',
            callback: function () {
                $this->wpEnqueue->add('js/{{BPREPLACESLUG}}.js');
            },
        );
    }
}
