<?php

namespace App\Filament\Resources\LessonQuizResource\Pages;

use App\Filament\Resources\LessonQuizResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLessonQuiz extends EditRecord
{
    protected static string $resource = LessonQuizResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
