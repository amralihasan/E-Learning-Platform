<?php

namespace App\Filament\Resources\LessonQuizResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Repeater;

class QuestionsRelationManager extends RelationManager
{
    protected static string $relationship = 'questions';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('question_type')
                    ->options([
                        'multiple_choice' => 'Multiple Choice',
                        'true_false' => 'True/False',
                        'short_answer' => 'Short Answer',
                    ])
                    ->required()
                    ->default('multiple_choice')
                    ->native(false)
                    ->reactive(),
                Forms\Components\Textarea::make('question_text')
                    ->required()
                    ->rows(3)
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('order')
                    ->numeric()
                    ->default(0)
                    ->required(),
                Forms\Components\TextInput::make('points')
                    ->numeric()
                    ->default(1)
                    ->required()
                    ->minValue(1),
                Forms\Components\Repeater::make('answers')
                    ->relationship('answers')
                    ->schema([
                        Forms\Components\Textarea::make('answer_text')
                            ->required()
                            ->rows(2)
                            ->columnSpan(2),
                        Forms\Components\Toggle::make('is_correct')
                            ->label('Correct Answer')
                            ->default(false)
                            ->required(),
                        Forms\Components\TextInput::make('order')
                            ->numeric()
                            ->default(0)
                            ->required(),
                    ])
                    ->columns(3)
                    ->defaultItems(4)
                    ->columnSpanFull()
                    ->required()
                    ->minItems(2)
                    ->visible(fn (Forms\Get $get) => in_array($get('question_type'), ['multiple_choice', 'true_false'])),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('question_text')
            ->columns([
                Tables\Columns\TextColumn::make('order')
                    ->sortable(),
                Tables\Columns\TextColumn::make('question_type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'multiple_choice' => 'primary',
                        'true_false' => 'success',
                        'short_answer' => 'warning',
                        default => 'gray',
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('question_text')
                    ->limit(50)
                    ->searchable()
                    ->wrap(),
                Tables\Columns\TextColumn::make('points')
                    ->sortable(),
                Tables\Columns\TextColumn::make('answers_count')
                    ->counts('answers')
                    ->label('Answers'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('question_type')
                    ->options([
                        'multiple_choice' => 'Multiple Choice',
                        'true_false' => 'True/False',
                        'short_answer' => 'Short Answer',
                    ]),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('order');
    }
}
