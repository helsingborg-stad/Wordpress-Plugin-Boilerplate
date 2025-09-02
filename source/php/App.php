<?php

declare(strict_types=1);

namespace {{BPREPLACENAMESPACE}};

use WpService\Contracts\AddAction;
use WpService\Contracts\AddFilter;
use WpService\Contracts\WpEnqueueScript;
use WpService\Contracts\WpEnqueueStyle;
use WpService\Contracts\WpRegisterScript;
use WpService\Contracts\WpRegisterStyle;

class App
{
    public function __construct(private AddFilter&AddAction&WpRegisterStyle&WpEnqueueStyle&WpRegisterScript&WpEnqueueScript $wpService)
    {
        $this->wpService->AddAction('admin_enqueue_scripts', array($this, 'enqueueStyles'));
        $this->wpService->AddAction('admin_enqueue_scripts', array($this, 'enqueueScripts'));
        $this->cacheBust = new \{{BPREPLACENAMESPACE}}\Helper\CacheBust();
    }

    /**
     * Enqueue required style
     * @return void
     */
    public function enqueueStyles()
    {
        $this->wpService->WpRegisterStyle(
            '{{BPREPLACESLUG}}-css',
            {{BPREPLACECAPSCONSTANT}}_URL . '/dist/' .
            $this->cacheBust->name('css/{{BPREPLACESLUG}}.css')
        );

        $this->wpService->WpEnqueueStyle('{{BPREPLACESLUG}}-css');
    }

    /**
     * Enqueue required scripts
     * @return void
     */
    public function enqueueScripts()
    {
        $this->wpService->WpRegisterScript(
            '{{BPREPLACESLUG}}-js',
            {{BPREPLACECAPSCONSTANT}}_URL . '/dist/' .
            $this->cacheBust->name('js/{{BPREPLACESLUG}}.js')
        );

        $this->wpService->WpEnqueueScript('{{BPREPLACESLUG}}-js');
    }
}
