<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Events\UserCreated;
use App\Filament\Resources\UserResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Event;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function afterCreate(): void
    {
        Event::dispatch(new UserCreated($this->record));
    }
}
