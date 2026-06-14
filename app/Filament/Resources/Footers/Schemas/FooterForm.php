<?php

namespace App\Filament\Resources\Footers\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class FooterForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('image')
                    ->image()
                    ->directory('footers')
                    ->required(),
                TextInput::make('link_instagram')
                    ->url()
                    ->required(),
                TextInput::make('link_youtube')
                    ->url()
                    ->required(),
                TextInput::make('link_linkedin')
                    ->url()
                    ->required(),
                TextInput::make('link_facebook')
                    ->url()
                    ->required(),
                TextInput::make('alamat')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('wa')
                    ->tel()
                    ->required(),
                TextInput::make('link_gmaps')
                    ->url()
                    ->required(),
            ]);
    }
}
