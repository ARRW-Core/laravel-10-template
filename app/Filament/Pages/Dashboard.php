<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\BlogPostsChart;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;

class Dashboard extends BaseDashboard
{
    // Customize properties or methods here

//    protected function getHeaderWidgets(): array
//    {
//        return [
//            BlogPostsChart::class
//        ];
//    }

    protected function getWidgets(): array
    {
        return [
            BlogPostsChart::class
        ];
    }

    protected function getHeading(): string
    {
        $company = auth()->user()->name;
        return "{$company}'s Dashboard";
    }


}
