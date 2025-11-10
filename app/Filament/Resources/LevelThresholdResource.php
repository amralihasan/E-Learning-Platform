<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LevelThresholdResource\Pages;
use App\Filament\Resources\LevelThresholdResource\RelationManagers;
use App\Models\LevelThreshold;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LevelThresholdResource extends Resource
{
    protected static ?string $model = LevelThreshold::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
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
                    ->unique(ignoreRecord: true)
                    ->native(false),
                Forms\Components\TextInput::make('min_percentage')
                    ->numeric()
                    ->required()
                    ->minValue(0)
                    ->maxValue(100)
                    ->step(0.01)
                    ->suffix('%')
                    ->label('Minimum Percentage'),
                Forms\Components\TextInput::make('max_percentage')
                    ->numeric()
                    ->required()
                    ->minValue(0)
                    ->maxValue(100)
                    ->step(0.01)
                    ->suffix('%')
                    ->label('Maximum Percentage'),
                Forms\Components\TextInput::make('order')
                    ->numeric()
                    ->required()
                    ->default(0),
                Forms\Components\Toggle::make('is_active')
                    ->default(true)
                    ->label('Active'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('level')
                    ->badge()
                    ->color('primary')
                    ->sortable(),
                Tables\Columns\TextColumn::make('min_percentage')
                    ->suffix('%')
                    ->sortable(),
                Tables\Columns\TextColumn::make('max_percentage')
                    ->suffix('%')
                    ->sortable(),
                Tables\Columns\TextColumn::make('order')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Active'),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('order');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLevelThresholds::route('/'),
            'create' => Pages\CreateLevelThreshold::route('/create'),
            'edit' => Pages\EditLevelThreshold::route('/{record}/edit'),
        ];
    }
}
