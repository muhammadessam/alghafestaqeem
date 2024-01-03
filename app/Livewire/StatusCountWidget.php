<?php

namespace App\Livewire;

use App\Models\Evaluation\EvaluationTransaction;
use Filament\Support\RawJs;
use Filament\Widgets\ChartWidget;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;

class StatusCountWidget extends ChartWidget
{

    protected static ?string $heading = 'احصائيات الحالات';

    protected static ?string $maxHeight = '500px';

    public array $filters = [
        'from' => '',
        'to' => '',
    ];

    protected function getData(): array
    {
        $data = EvaluationTransaction::when($this->filters['from'] ?? false, function (Builder $builder, $from) {
            $builder->where('created_at', '>=', $from);
        })->when($this->filters['to'], function (Builder $builder, $to) {
            $builder->whereDate('created_at', '<=', $to);
        })->select('status', \DB::raw('COUNT(*) as status_count'))
            ->groupBy('status')
            ->orderBy('status_count', 'desc')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'احصائيات حالة المعاملات',
                    'data' => $data->flatten()->pluck('status_count'),
                    'backgroundColor' => ["#34344a", "#47394f", "#513c52", "#5a3e54", "#6d4359"]

                ],
            ],
            'labels' => $data->flatten()->map(function (EvaluationTransaction $element, $index) {
                return $element->status_words;
            }),
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }

    #[On('updateFromDate')]
    public function updateFromDate(string $from): void
    {
        $this->filters['from'] = $from;
        $this->updateChartData();
    }

    #[On('updateToDate')]
    public function updateToDate(string $to): void
    {
        $this->filters['to'] = $to;
        $this->updateChartData();
    }

    protected function getOptions(): RawJs
    {
        return RawJs::make(<<<JS
            {
               plugins:{
                   legend:{
                       'display':true,
                       'rtl':true,
                       'position':'right',
                       'labels':{
                           'generateLabels':(chart  )=>{
                               const pie = chart.data;
                               console.log(pie);
                               return pie.labels.map(function(item, index) {
                                 return {
                                     text:item + ' ( ' + pie.datasets[0].data[index] + ' ) ',
                                     fontColor : pie.datasets[0].backgroundColor[index%4],
                                     fillStyle:pie.datasets[0].backgroundColor[index%4],
                                 }
                               })
                           }
                       }

                   }
               },
               scales:{
                   x:{
                       display:false
                   },
                   y:{
                       display:false
                   }
               }
            }
        JS
        );
    }
}
