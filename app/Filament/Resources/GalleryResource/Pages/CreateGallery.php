<?php

namespace App\Filament\Resources\GalleryResource\Pages;

use App\Filament\Resources\GalleryResource;
use App\Models\Gallery;
use App\Models\User;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\CreateRecord\Concerns\HasWizard;

class CreateGallery extends CreateRecord
{
    use HasWizard;

    protected static string $resource = GalleryResource::class;

    public function form(Form $form): Form
    {
        return parent::form($form)
            ->schema([
                Wizard::make($this->getSteps())
                    ->startOnStep($this->getStartStep())
                    ->cancelAction($this->getCancelFormAction())
                    ->submitAction($this->getSubmitFormAction())
                    ->skippable($this->hasSkippableSteps())
                    ->contained(false),
            ])
            ->columns(null);
    }

    protected function afterCreate(): void
    {
        /** @var Gallery $gallery */
        $gallery = $this->record;

        /** @var User $user */
        $user = auth()->user();

        Notification::make()
            ->title('New gallery created')
            ->icon('heroicon-o-photo')
            ->body("**{$gallery->title} gallery with {$gallery->images->count()} images was created.**")
            ->actions([
                Action::make('View')
                    ->url(GalleryResource::getUrl('edit', ['record' => $gallery])),
            ])
            ->sendToDatabase($user);
    }

    /** @return Step[] */
    protected function getSteps(): array
    {
        return [
            Step::make('Gallery Details')
                ->schema([
                    Section::make('Gallery Information')
                        ->schema(GalleryResource::getGalleryDetailsFormSchema())
                        ->columns(2),
                ])
                ->icon('heroicon-o-photo'),

            Step::make('Gallery Images')
                ->schema([
                    Section::make('Upload Images')
                        ->schema([
                            GalleryResource::getImagesRepeater(),
                        ])
                        ->columns(1),
                ])
                ->icon('heroicon-o-academic-cap'),
        ];
    }
}
