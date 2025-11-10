<?php

namespace App\Filament\Resources\LevelExamResource\RelationManagers;

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
                Forms\Components\Select::make('section')
                    ->options([
                        'reading' => 'Reading',
                        'listening' => 'Listening',
                        'grammar' => 'Grammar',
                    ])
                    ->required()
                    ->native(false),
                Forms\Components\Textarea::make('question_text')
                    ->required()
                    ->rows(3)
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('reading_passage')
                    ->rows(5)
                    ->label('Reading Passage (for reading questions)')
                    ->visible(fn (Forms\Get $get) => $get('section') === 'reading')
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('audio_url')
                    ->label('Audio File (for listening questions)')
                    ->acceptedFileTypes(['audio/mpeg', 'audio/mp3', 'audio/wav'])
                    ->directory('level-exam-audio')
                    ->visibility('public')
                    ->visible(fn (Forms\Get $get) => $get('section') === 'listening')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('order')
                    ->numeric()
                    ->default(0)
                    ->required(),
                Forms\Components\TextInput::make('points')
                    ->numeric()
                    ->default(1)
                    ->required(),
                Forms\Components\Repeater::make('answers')
                    ->relationship('answers')
                    ->schema([
                        Forms\Components\Textarea::make('answer_text')
                            ->required()
                            ->rows(2)
                            ->columnSpan(2),
                        Forms\Components\Toggle::make('is_correct')
                            ->label('Correct Answer')
                            ->default(false),
                        Forms\Components\TextInput::make('order')
                            ->numeric()
                            ->default(0)
                            ->required(),
                    ])
                    ->columns(3)
                    ->defaultItems(4)
                    ->columnSpanFull()
                    ->required()
                    ->minItems(2),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('question_text')
            ->columns([
                Tables\Columns\TextColumn::make('order')
                    ->sortable(),
                Tables\Columns\TextColumn::make('section')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'reading' => 'info',
                        'listening' => 'success',
                        'grammar' => 'warning',
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('question_text')
                    ->limit(50)
                    ->searchable(),
                Tables\Columns\TextColumn::make('points')
                    ->sortable(),
                Tables\Columns\TextColumn::make('answers_count')
                    ->counts('answers')
                    ->label('Answers'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('section')
                    ->options([
                        'reading' => 'Reading',
                        'listening' => 'Listening',
                        'grammar' => 'Grammar',
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
            ->defaultSort('section')
            ->defaultSort('order');
    }
}
