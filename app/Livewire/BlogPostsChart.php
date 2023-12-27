<?php

namespace App\Livewire;

use App\Models\Evaluation\EvaluationTransaction;
use Filament\Support\RawJs;
use Filament\Widgets\ChartWidget;

class BlogPostsChart extends ChartWidget
{
    protected static ?string $heading = 'احصائيات الشركات';

    protected static ?string $maxHeight = '500px';

    public ?string $filter = 'toDay';

    protected function getFilters(): ?array
    {
        return [
            'day', 'month', 'year',
        ];
    }

    protected function getData(): array
    {
        $data = EvaluationTransaction::join('evaluation_companies', 'evaluation_companies.id', 'evaluation_transactions.evaluation_company_id')
            ->select('evaluation_companies.title', \DB::raw('COUNT(*) as company_count'))
            ->groupBy('evaluation_transactions.evaluation_company_id')
            ->orderBy('company_count', 'desc')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Blog posts created',
                    'data' => $data->flatten()->pluck('company_count'),
                ],
            ],
            'labels' => $data->flatten()->pluck('title'),
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }

    protected function getOptions(): RawJs
    {
        return RawJs::make(<<<JS
        {
            scales: {
                x: {
                    display:false
                },
                y:{
                    display:false
                }
            },

        }
        JS
        );
    }
}
