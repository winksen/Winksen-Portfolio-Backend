<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryResource\Pages;
use App\Models\Gallery;
use App\Models\Image;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\DatePicker;

class GalleryResource extends Resource
{
    protected static ?string $model = Gallery::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    public static function getNavigationBadge(): ?string
    {
        return (string) Gallery::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        // Gallery Details Section
                        Forms\Components\Section::make('Gallery Details')
                            ->schema(static::getGalleryDetailsFormSchema())
                            ->columns(2),

                        // Image Upload Repeater Section
                        Forms\Components\Section::make('Gallery Images')
                            ->schema([
                                static::getImagesRepeater(),
                            ]),
                    ])
                    ->columnSpan(['lg' => fn (?Gallery $record) => $record === null ? 3 : 2]),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID'),
                Tables\Columns\TextColumn::make('title')->label('Title'),
                Tables\Columns\TextColumn::make('date')->dateTime()->label('Date'),
                Tables\Columns\TextColumn::make('location')->label('Location'),
                Tables\Columns\TextColumn::make('link')->label('Link'),
            ])
            ->filters([/* Add filters if necessary */])
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
            // Define relations if necessary
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGalleries::route('/'),
            'create' => Pages\CreateGallery::route('/create'),
            'edit' => Pages\EditGallery::route('/{record}/edit'),
            'view' => Pages\ViewGallery::route('/{record}'),
        ];
    }

    // Gallery details form schema
    public static function getGalleryDetailsFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('title')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('location')
                ->maxLength(255),

            Forms\Components\DatePicker::make('date')
                ->label('Date')
                ->required(),

            Forms\Components\TextInput::make('link')
                ->url()
                ->maxLength(255),

            Forms\Components\Textarea::make('description')
                ->columnSpan('full'),

            Forms\Components\Toggle::make('isNew')->default(false),
            Forms\Components\Toggle::make('isHot')->default(false),
            Forms\Components\Toggle::make('isFeatured')->default(false),
        ];
    }

    // Image repeater section
    public static function getImagesRepeater(): Repeater
    {
        return Repeater::make('images')
            ->relationship() // Assumes a 'gallery_id' foreign key in the 'images' table
            ->schema([
                // Automatically filled with the Gallery's title
                Forms\Components\TextInput::make('gallery')
                    ->label('Gallery')
                    ->default(fn ($get) => $get('title')) // Assuming 'title' is available from the gallery
                    ->disabled(),

                FileUpload::make('imageUrl')
                    ->label('Image Upload')
                    ->image()
                    ->required()
                    ->disk('public') // Or whatever disk you're using
                    ->directory('galleries/images')
                    ->maxSize(1024), // Optional, adjust as necessary

                Section::make('Image Details')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Title')
                            ->maxLength(255),
                        
                        Forms\Components\TextInput::make('alt')
                            ->label('Alt Text')
                            ->maxLength(255),

                        // Forms\Components\DateTimePicker::make('date')
                        //     ->label('Date')
                        //     ->required(),

                        DatePicker::make('date')
                            ->label('Date')
                            ->native(false),
                        
                        Forms\Components\TextInput::make('location')
                            ->label('Location')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('coordinates')
                            ->label('Coordinates')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('dimensions')
                            ->label('Dimensions')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('size')
                            ->label('Size')
                            ->numeric()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('imageType')
                            ->label('Image Type')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('fileName')
                            ->label('File Name')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('camera')
                            ->label('Camera')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('lens')
                            ->label('Lens')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('cameraType')
                            ->label('Camera Type')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('focalLength')
                            ->label('Focal Length')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('shutterSpeed')
                            ->label('Shutter Speed')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('aperture')
                            ->label('Aperture')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('iso')
                            ->label('ISO')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('software')
                            ->label('Software')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('rating')
                            ->label('Rating')
                            ->numeric()
                            ->maxLength(5), // Optional, adjust as necessary
                    ])
                    ->columns(3) // Arrange fields in three columns
                    ->collapsible(), // Make the section collapsible for better usability
            ])
            ->defaultItems(1) // Optional: default to one item when no images are added
            ->orderColumn('title')
            ->required();
    }

}
