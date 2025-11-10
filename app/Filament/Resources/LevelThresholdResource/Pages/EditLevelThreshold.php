<?php

namespace App\Filament\Resources\LevelThresholdResource\Pages;

use App\Filament\Resources\LevelThresholdResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLevelThreshold extends EditRecord
{
    protected static string $resource = LevelThresholdResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
