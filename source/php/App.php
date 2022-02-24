<?php

namespace {{BPREPLACENAMESPACE}};

class App
{
    public function __construct()
    {
        add_action('admin_enqueue_scripts', array($this, 'enqueueStyles'));
        add_action('admin_enqueue_scripts', array($this, 'enqueueScripts'));

        $this->cacheBust = new \{{BPREPLACENAMESPACE}}\Helper\CacheBust();
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
            $this->cacheBust->name('css/{{BPREPLACESLUG}}.css')
        );

        wp_enqueue_style('{{BPREPLACESLUG}}-css');
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
            $this->cacheBust->name('js/{{BPREPLACESLUG}}.js')
        );

        wp_enqueue_script('{{BPREPLACESLUG}}-js');
    }
}
