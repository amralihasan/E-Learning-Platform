<?php

namespace App\Filament\Resources\LevelThresholdResource\Pages;

use App\Filament\Resources\LevelThresholdResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLevelThresholds extends ListRecords
{
    protected static string $resource = LevelThresholdResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
