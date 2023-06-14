<?php

namespace App\Filament\Widgets;

use Filament\Widgets\BarChartWidget;
use Filament\Widgets\LineChartWidget;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class BlogPostsChart extends BaseWidget
{
    protected static ?string $heading = 'Blog posts';

//    protected function getCards(): array
//    {
//        return [
//            Card::make('Unique views', '192.1k'),
//            Card::make('Bounce rate', '21%'),
//            Card::make('Average time on page', '3:12'),
//        ];
//    }
//    protected function getData(): array
//    {
//        return [
//            'datasets' => [
//                [
//                    'label' => 'Blog posts created',
//                    'borderColor' => 'black',
//                    'borderWidth' => 1,
//                    'backgroundColor' => 'cyan',
//                    'data' => [0, 10, 5, 2, 21, 32, 45, 74, 65, 45, 77, 89, 10],
//                    'fill' => [
//                        'above' => 'red',
//                        'below' => 'blue',
//                        'value' => 25
//                    ]
//                ],
//            ],
//            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec', 'Jan'],
//        ];
//    }

//    protected static ?array $options = [
//        'animations' => [
//            'tension' => [
//                'duration' => 1000,
//                'easing' => 'linear',
//                'from' => 10,
//                'to' => 0,
//                'loop' => true
//            ]
//        ]
//    ];
}
