<?php
namespace App\Http\ViewComposers;

use App\LinkUrl;
use App\WebSetting;
use Illuminate\View\View;

class Navigation
{
    public function compose(View $view)
    {
        $settings = WebSetting::get()->pluck('value', 'id');
        $links = LinkUrl::get();
        $view->with('settings', $settings)
            ->with('links', $links);
    }
}
