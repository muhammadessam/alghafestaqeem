<?php

namespace App\Filament\Resources\EvaluationTransactionResource\Pages;

use App\Filament\Resources\EvaluationTransactionResource;
use App\Models\Transaction_files;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateEvaluationTransaction extends CreateRecord
{
    protected static string $resource = EvaluationTransactionResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $entity = static::getModel()::create($data);

        foreach ($data['files'] as $file) {
            $current_path = public_path() . '/storage/' . $file;
            $new_path = public_path() . '/upload/' . $file;
            rename($current_path, $new_path);

            Transaction_files::create([
                'Transaction_id' => $entity->id,
                'path' => $file,
                'type' => mime_content_type($new_path),
            ]);
        }

        return $entity;
    }
}
