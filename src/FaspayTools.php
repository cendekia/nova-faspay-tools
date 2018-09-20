<?php

namespace Cendekia\FaspayTools;

use Laravel\Nova\Nova;
use Laravel\Nova\Tool;

class FaspayTools extends Tool
{
    /**
     * Perform any tasks that need to happen when the tool is booted.
     *
     * @return void
     */
    public function boot()
    {
        Nova::script('faspay-tools', __DIR__.'/../dist/js/tool.js');
        Nova::style('faspay-tools', __DIR__.'/../dist/css/tool.css');
    }

    /**
     * Build the view that renders the navigation links for the tool.
     *
     * @return \Illuminate\View\View
     */
    public function renderNavigation()
    {
        return view('faspay-tools::navigation');
    }
}
