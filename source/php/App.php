<?php

declare(strict_types=1);

namespace {{BPREPLACENAMESPACE}};

use WpService\Contracts\AddAction;
use WpService\Contracts\AddFilter;
use WpService\Contracts\WpEnqueueScript;
use WpService\Contracts\WpEnqueueStyle;
use WpService\Contracts\WpRegisterScript;
use WpService\Contracts\WpRegisterStyle;
use AcfService\AcfService;
use WpUtilService\Features\Enqueue\EnqueueManager;

class App
{
    public function __construct(
        private EnqueueManager $wpEnqueue,
        private AddFilter&AddAction&WpRegisterStyle&WpEnqueueStyle&WpRegisterScript&WpEnqueueScript $wpService,
        private AcfService $acfService)
    {
        $this->wpService->AddAction('admin_enqueue_scripts', array($this, 'enqueueStyles'));
        $this->wpService->AddAction('admin_enqueue_scripts', array($this, 'enqueueScripts'));
    }

    /**
     * Enqueue required style
     * @return void
     */
    public function enqueueStyles()
    {
        $this->wpEnqueue->add('css/{{BPREPLACESLUG}}.css');
    }

    /**
     * Enqueue required scripts
     * @return void
     */
    public function enqueueScripts()
    {
        $this->wpEnqueue->add('js/{{BPREPLACESLUG}}.js');
    }
}
