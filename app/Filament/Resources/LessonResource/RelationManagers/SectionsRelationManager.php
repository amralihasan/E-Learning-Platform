<?php

namespace App\Filament\Resources\LessonResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class SectionsRelationManager extends RelationManager
{
    protected static string $relationship = 'sections';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('section_type')
                    ->options([
                        'introduction' => 'Introduction',
                        'conversation' => 'Conversation',
                        'grammar' => 'Grammar',
                        'reading' => 'Reading',
                        'vocabulary' => 'Vocabulary',
                        'listening' => 'Listening',
                        'speaking' => 'Speaking',
                        'writing' => 'Writing',
                        'youtube' => 'Youtube',
                        'quiz' => 'Quiz',
                    ])
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->native(false)
                    ->reactive(),
                Forms\Components\RichEditor::make('content')
                    ->label('Content')
                    ->columnSpanFull()
                    ->visible(fn (Forms\Get $get) => $get('section_type') !== 'youtube')
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'underline',
                        'link',
                        'bulletList',
                        'orderedList',
                    ]),
                Forms\Components\TextInput::make('youtube_url')
                    ->label('YouTube URL')
                    ->url()
                    ->visible(fn (Forms\Get $get) => $get('section_type') === 'youtube')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('order')
                    ->numeric()
                    ->default(0)
                    ->required(),
                Forms\Components\Toggle::make('is_active')
                    ->default(true)
                    ->label('Active'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('section_type')
            ->columns([
                Tables\Columns\TextColumn::make('order')
                    ->sortable(),
                Tables\Columns\TextColumn::make('section_type')
                    ->badge()
                    ->color('primary')
                    ->formatStateUsing(fn (string $state): string => ucfirst($state))
                    ->sortable(),
                Tables\Columns\TextColumn::make('content')
                    ->limit(50)
                    ->html()
                    ->visible(fn ($record) => $record->section_type !== 'youtube'),
                Tables\Columns\TextColumn::make('youtube_url')
                    ->limit(30)
                    ->visible(fn ($record) => $record->section_type === 'youtube'),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Active'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('section_type')
                    ->options([
                        'introduction' => 'Introduction',
                        'conversation' => 'Conversation',
                        'grammar' => 'Grammar',
                        'reading' => 'Reading',
                        'vocabulary' => 'Vocabulary',
                        'listening' => 'Listening',
                        'speaking' => 'Speaking',
                        'writing' => 'Writing',
                        'youtube' => 'Youtube',
                        'quiz' => 'Quiz',
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
