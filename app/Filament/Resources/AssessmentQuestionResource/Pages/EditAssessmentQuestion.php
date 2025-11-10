<?php

namespace App\Filament\Resources\AssessmentQuestionResource\Pages;

use App\Filament\Resources\AssessmentQuestionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAssessmentQuestion extends EditRecord
{
    protected static string $resource = AssessmentQuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
