<?php

namespace {{BPREPLACENAMESPACE}};

class App
{
    public function __construct()
    {
        add_action('admin_enqueue_scripts', array($this, 'enqueueStyles'));
        add_action('admin_enqueue_scripts', array($this, 'enqueueScripts'));
    }

    /**
     * Enqueue required style
     * @return void
     */
    public function enqueueStyles()
    {
        wp_register_style(
            '{{BPREPLACESLUG}}-css',
            {{BPREPLACECAPSCONSTANT}}_URL . '/dist/' .
            \{{BPREPLACENAMESPACE}}\Helper\CacheBust::name('css/{{BPREPLACESLUG}}.css')
        );
    }

    /**
     * Enqueue required scripts
     * @return void
     */
    public function enqueueScripts()
    {
        wp_register_script(
            '{{BPREPLACESLUG}}-js',
            {{BPREPLACECAPSCONSTANT}}_URL . '/dist/' .
            \{{BPREPLACENAMESPACE}}\Helper\CacheBust::name('js/{{BPREPLACESLUG}}.js')
        );
    }
}
