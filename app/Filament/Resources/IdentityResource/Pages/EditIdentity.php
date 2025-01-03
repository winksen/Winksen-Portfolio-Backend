<?php

namespace App\Filament\Resources\IdentityResource\Pages;

use App\Filament\Resources\IdentityResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIdentity extends EditRecord
{
    protected static string $resource = IdentityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
