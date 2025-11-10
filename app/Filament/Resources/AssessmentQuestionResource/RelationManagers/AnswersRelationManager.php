<?php

namespace App\Filament\Resources\AssessmentQuestionResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AnswersRelationManager extends RelationManager
{
    protected static string $relationship = 'answers';

    public function form(Form $form): Form
    {
        return $form
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
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('answer_text')
            ->columns([
                Tables\Columns\TextColumn::make('order')
                    ->sortable(),
                Tables\Columns\TextColumn::make('answer_text')
                    ->limit(50)
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_correct')
                    ->boolean()
                    ->label('Correct'),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_correct')
                    ->label('Correct Answer'),
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
