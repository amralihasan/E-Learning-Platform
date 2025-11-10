<?php

namespace App\Filament\Resources\AssessmentQuestionResource\Pages;

use App\Filament\Resources\AssessmentQuestionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAssessmentQuestions extends ListRecords
{
    protected static string $resource = AssessmentQuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
