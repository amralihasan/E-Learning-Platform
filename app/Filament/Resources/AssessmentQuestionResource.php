<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AssessmentQuestionResource\Pages;
use App\Filament\Resources\AssessmentQuestionResource\RelationManagers;
use App\Models\AssessmentQuestion;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AssessmentQuestionResource extends Resource
{
    protected static ?string $model = AssessmentQuestion::class;

    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('assessment_id')
                    ->relationship('assessment', 'title')
                    ->required()
                    ->searchable()
                    ->preload(),
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
                    ->directory('assessment-audio')
                    ->visibility('public')
                    ->visible(fn (Forms\Get $get) => $get('section') === 'listening')
                    ->columnSpanFull()
                    ->getUploadedFileUsing(fn ($file) => $file ? asset('storage/' . $file) : null),
                Forms\Components\TextInput::make('order')
                    ->numeric()
                    ->default(0)
                    ->required(),
                Forms\Components\TextInput::make('points')
                    ->numeric()
                    ->default(1)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('assessment.title')
                    ->searchable()
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
                Tables\Columns\TextColumn::make('order')
                    ->sortable(),
                Tables\Columns\TextColumn::make('points')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('assessment_id')
                    ->relationship('assessment', 'title')
                    ->searchable()
                    ->preload(),
                Tables\Filters\SelectFilter::make('section')
                    ->options([
                        'reading' => 'Reading',
                        'listening' => 'Listening',
                        'grammar' => 'Grammar',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\AnswersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAssessmentQuestions::route('/'),
            'create' => Pages\CreateAssessmentQuestion::route('/create'),
            'edit' => Pages\EditAssessmentQuestion::route('/{record}/edit'),
        ];
    }
}
