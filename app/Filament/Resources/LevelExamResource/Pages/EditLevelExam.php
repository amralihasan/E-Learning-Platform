<?php

namespace App\Filament\Resources\LevelExamResource\Pages;

use App\Filament\Resources\LevelExamResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLevelExam extends EditRecord
{
    protected static string $resource = LevelExamResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
