<?php

namespace App\Filament\Resources\LevelExamResource\Pages;

use App\Filament\Resources\LevelExamResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLevelExams extends ListRecords
{
    protected static string $resource = LevelExamResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
