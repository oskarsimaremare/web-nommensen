<?php

namespace App\Filament\Resources\Rektors\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class RektorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama')
                    ->required()
                    ->maxLength(255),
                TextInput::make('jabatan')
                    ->required()
                    ->maxLength(255),
                FileUpload::make('image')
                    ->image()
                    ->required()
                    ->directory('rektors')
                    ->columnSpanFull(),
            ]);
    }
}
