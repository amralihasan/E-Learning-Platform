<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LessonResource\Pages;
use App\Filament\Resources\LessonResource\RelationManagers;
use App\Models\Lesson;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LessonResource extends Resource
{
    protected static ?string $model = Lesson::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('unit_id')
                    ->relationship('unit', 'title', fn ($query) => $query->where('is_active', true))
                    ->required()
                    ->searchable()
                    ->preload()
                    ->native(false)
                    ->reactive()
                    ->afterStateUpdated(fn ($state, Forms\Set $set) => $set('level', \App\Models\Unit::find($state)?->level)),
                Forms\Components\Select::make('level')
                    ->options([
                        'A1' => 'A1',
                        'A2' => 'A2',
                        'B1' => 'B1',
                        'B2' => 'B2',
                        'C1' => 'C1',
                        'C2' => 'C2',
                    ])
                    ->required()
                    ->native(false),
                Forms\Components\TextInput::make('lesson_number')
                    ->numeric()
                    ->required()
                    ->minValue(1)
                    ->maxValue(4)
                    ->label('Lesson Number (1-4)'),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('type')
                    ->options([
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
                    ->default('reading')
                    ->native(false),
                Forms\Components\RichEditor::make('description')
                    ->columnSpanFull()
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'underline',
                        'link',
                        'bulletList',
                        'orderedList',
                    ]),
                Forms\Components\FileUpload::make('main_image')
                    ->image()
                    ->directory('lesson-images')
                    ->visibility('public')
                    ->columnSpanFull()
                    ->nullable(),
                Forms\Components\FileUpload::make('audio')
                    ->acceptedFileTypes(['audio/mpeg', 'audio/mp3', 'audio/wav'])
                    ->directory('lesson-audio')
                    ->visibility('public')
                    ->columnSpanFull()
                    ->nullable(),
                Forms\Components\TextInput::make('order')
                    ->numeric()
                    ->default(0)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('unit.title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('level')
                    ->badge()
                    ->color('primary')
                    ->sortable(),
                Tables\Columns\TextColumn::make('lesson_number')
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'conversation' => 'info',
                        'grammar' => 'success',
                        'reading' => 'primary',
                        'vocabulary' => 'warning',
                        'listening' => 'danger',
                        'speaking' => 'success',
                        'writing' => 'info',
                        'youtube' => 'danger',
                        'quiz' => 'warning',
                        default => 'gray',
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('sections_count')
                    ->counts('sections')
                    ->label('Sections'),
                Tables\Columns\TextColumn::make('order')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('unit_id')
                    ->relationship('unit', 'title')
                    ->preload(),
                Tables\Filters\SelectFilter::make('level')
                    ->options([
                        'A1' => 'A1',
                        'A2' => 'A2',
                        'B1' => 'B1',
                        'B2' => 'B2',
                        'C1' => 'C1',
                        'C2' => 'C2',
                    ]),
                Tables\Filters\SelectFilter::make('type')
                    ->options([
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
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('unit_id')
            ->defaultSort('lesson_number');
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\SectionsRelationManager::class,
            RelationManagers\QuizzesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLessons::route('/'),
            'create' => Pages\CreateLesson::route('/create'),
            'edit' => Pages\EditLesson::route('/{record}/edit'),
        ];
    }
}
