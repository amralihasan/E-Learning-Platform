<?php

namespace App\Filament\Resources\LessonQuizResource\Pages;

use App\Filament\Resources\LessonQuizResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLessonQuizzes extends ListRecords
{
    protected static string $resource = LessonQuizResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
