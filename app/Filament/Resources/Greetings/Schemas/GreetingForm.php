<?php

namespace App\Filament\Resources\Greetings\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class GreetingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('content')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->image()
                    ->required()
                    ->directory('greetings')
                    ->columnSpanFull(),
            ]);
    }
}
