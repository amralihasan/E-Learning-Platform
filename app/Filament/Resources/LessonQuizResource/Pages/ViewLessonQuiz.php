<?php

namespace App\Filament\Resources\LessonQuizResource\Pages;

use App\Filament\Resources\LessonQuizResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewLessonQuiz extends ViewRecord
{
    protected static string $resource = LessonQuizResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
