<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function getNavigationBadge(): ?string { return (string) User::count(); }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Name')
                    ->maxLength(255),

                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->unique(User::class, 'email', fn ($record) => $record)
                    ->label('Email')
                    ->maxLength(255),

                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required(fn ($livewire) => !$livewire->record) // Password is required only when creating a new user
                    ->minLength(8)
                    ->label('Password')
                    ->maxLength(255)
                    ->reactive()
                    ->afterStateUpdated(fn ($state, $get) => $get('password') !== $state ? $state : null),

                // Forms\Components\Checkbox::make('is_admin')
                //     ->label('Is Admin')
                //     ->default(false),

                Forms\Components\DateTimePicker::make('email_verified_at')
                    ->nullable()
                    ->label('Email Verified At'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID'),
                Tables\Columns\TextColumn::make('name')->label('Name'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->label('Created At'),
                Tables\Columns\TextColumn::make('updated_at')->dateTime()->label('Updated At'),
                Tables\Columns\TextColumn::make('is_admin')->label('Admin'),
            ])
            ->filters([
                // You can add filters, for example, for admin status
                Tables\Filters\SelectFilter::make('is_admin')
                    ->options([
                        0 => 'User',
                        1 => 'Admin',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
            'view' => Pages\ViewUser::route('/{record}'),
        ];
    }
}
