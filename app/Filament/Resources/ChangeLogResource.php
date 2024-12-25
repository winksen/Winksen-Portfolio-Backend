<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChangeLogResource\Pages;
use App\Filament\Resources\ChangeLogResource\RelationManagers;
use App\Models\ChangeLog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ChangeLogResource extends Resource
{
    protected static ?string $model = ChangeLog::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID'),
                Tables\Columns\TextColumn::make('name')->label('Name'),
                Tables\Columns\TextColumn::make('date')->dateTime()->label('Date'),
                Tables\Columns\TextColumn::make('type')->label('Type'),
                Tables\Columns\TextColumn::make('version')->label('Version'),
                Tables\Columns\TextColumn::make('comment')->label('Comment'),
            ])
            ->filters([
                //
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListChangeLogs::route('/'),
            'create' => Pages\CreateChangeLog::route('/create'),
            'edit' => Pages\EditChangeLog::route('/{record}/edit'),
        ];
    }
}
