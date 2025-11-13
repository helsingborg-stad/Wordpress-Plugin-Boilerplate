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
    private $cacheBust = null;

    public function __construct(
        AddFilter&AddAction&WpRegisterStyle&WpEnqueueStyle&WpRegisterScript&WpEnqueueScript $wpService,
        AcfService $acfService,
        EnqueueManager $wpEnqueue)
    {
        $wpService->AddAction('admin_enqueue_scripts', array($this, function () {
            $wpEnqueue->add('{{BPREPLACESLUG}}-css')
        }));
        $wpService->AddAction('admin_enqueue_scripts', array($this, function () {
            $wpEnqueue->add('{{BPREPLACESLUG}}-js')
        }));
    }
}
