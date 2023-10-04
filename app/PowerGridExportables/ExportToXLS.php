<?php

namespace App\PowerGridExportables;

use App\Exports\TransactionExport;
use PowerComponents\LivewirePowerGrid\Components\Exports\Contracts\ExportInterface;
use PowerComponents\LivewirePowerGrid\Components\Exports\Export;
use PowerComponents\LivewirePowerGrid\Exportable;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExportToXLS extends Export implements ExportInterface
{

    public function download(array $exportOptions): BinaryFileResponse
    {
        $deleteFileAfterSend = boolval(data_get($exportOptions, 'deleteFileAfterSend'));
        $this->striped = strval(data_get($exportOptions, 'striped'));

        $this->build($exportOptions);
        return response()
            ->download(storage_path('app/' . $this->fileName . '.xlsx'))
            ->deleteFileAfterSend($deleteFileAfterSend);
    }

    public function build(Exportable|array $exportOptions): void
    {
        $data = $this->prepare($this->data, $this->columns);

        \Excel::store(new TransactionExport($data['rows'], $data['headers']), $this->fileName . '.xlsx');
    }
}
