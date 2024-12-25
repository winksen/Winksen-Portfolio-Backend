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
                Tables\Columns\ImageColumn::make('imageUrl')
                    ->label('Image'),
                Tables\Columns\TextColumn::make('id')->label('ID'),
                Tables\Columns\TextColumn::make('title')->label('Title'),
                Tables\Columns\TextColumn::make('date')->dateTime()->label('Date'),
                Tables\Columns\TextColumn::make('location')->label('Location'),
                // Tables\Columns\TextColumn::make('link')->label('Link'),
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

            FileUpload::make('imageUrl')
                ->label('Image Upload')
                ->image()
                ->required()
                ->disk('public')
                ->directory('galleries')
                // ->maxSize(1024)
                ->columnSpan('full'),

            DatePicker::make('date')
                ->label('Date')
                ->native(false),

            Forms\Components\TextInput::make('link')
                ->maxLength(255),

            Forms\Components\Textarea::make('description')
                ->columnSpan('full'),

            Section::make('Options')
            ->schema([
                Forms\Components\Toggle::make('isNew')->label('New')->default(false),
                Forms\Components\Toggle::make('isHot')->label('Hot')->default(false),
                Forms\Components\Toggle::make('isFeatured')->label('Featured')->default(false),
            ])
            ->columns(3)
            ->collapsible(),

            Section::make('Tags')
            ->schema([
                Forms\Components\Checkbox::make('tag1')->label('Travel')->default(false),
                Forms\Components\Checkbox::make('tag2')->label('Landscapes')->default(false),
                Forms\Components\Checkbox::make('tag3')->label('Portraits')->default(false),
                Forms\Components\Checkbox::make('tag4')->label('Culture')->default(false),
                Forms\Components\Checkbox::make('tag5')->label('Food')->default(false),
                Forms\Components\Checkbox::make('tag6')->label('Wildlife')->default(false),
                Forms\Components\Checkbox::make('tag7')->label('Abstract')->default(false),
                Forms\Components\Checkbox::make('tag8')->label('Historical')->default(false),
                Forms\Components\Checkbox::make('tag9')->label('Macro')->default(false),
                Forms\Components\Checkbox::make('tag10')->label('Symmetry')->default(false),
                Forms\Components\Checkbox::make('tag11')->label('Street Photography')->default(false),
                Forms\Components\Checkbox::make('tag12')->label('Black and White')->default(false),
                Forms\Components\Checkbox::make('tag13')->label('Architecture')->default(false),
                Forms\Components\Checkbox::make('tag14')->label('Night')->default(false),
                Forms\Components\Checkbox::make('tag15')->label('Fashion')->default(false),
                Forms\Components\Checkbox::make('tag16')->label('Cityscapes')->default(false),
                Forms\Components\Checkbox::make('tag17')->label('Sunset/Sunrise')->default(false),
                Forms\Components\Checkbox::make('tag18')->label('Rural Life')->default(false),
                Forms\Components\Checkbox::make('tag19')->label('Underwater')->default(false),
                Forms\Components\Checkbox::make('tag20')->label('Events')->default(false),
                Forms\Components\Checkbox::make('tag21')->label('Religious')->default(false),
                Forms\Components\Checkbox::make('tag22')->label('Birds')->default(false),
                Forms\Components\Checkbox::make('tag23')->label('Sea')->default(false),

            ])
            ->columns(4)
            ->collapsible(),

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
                    // ->required()
                    ->disk('public')
                    // ->maxSize(1024)
                    ->directory('galleries/images'),

                Section::make('Image Details')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Title')
                            ->maxLength(255),
                        
                        Forms\Components\TextInput::make('alt')
                            ->label('Alt Text')
                            ->maxLength(255),

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
                            ->maxLength(255),

                        Forms\Components\Select::make('imageType')
                            ->label('Image Type')
                            ->options([
                                'JPG' => 'JPG',
                                'PNG' => 'PNG',
                            ])
                            ->default('JPG'),

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

                        Forms\Components\Select::make('rating')
                            ->label('Rating')
                            ->options([
                                '1' => '1 Star',
                                '2' => '2 Stars',
                                '3' => '3 Stars',
                                '4' => '4 Stars',
                                '5' => '5 Stars',
                            ])
                            ->default('3')
                            ->required(),                     
                    ])
                    ->columns(4)
                    ->collapsible(),
            ])
            ->defaultItems(1) // Optional: default to one item when no images are added
            ->orderColumn('id')
            ->required();
    }

}
