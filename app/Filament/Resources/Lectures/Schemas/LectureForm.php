<?php

namespace App\Filament\Resources\Lectures\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class LectureForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama')
                    ->required()
                    ->maxLength(255),
                TextInput::make('nidn')
                    ->required()
                    ->maxLength(255),
                TextInput::make('pendidikan')
                    ->required()
                    ->maxLength(255),
                TextInput::make('jabatan')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required()
                    ->maxLength(255),
                TextInput::make('topik')
                    ->required()
                    ->maxLength(255),
                FileUpload::make('image')
                    ->image()
                    ->required()
                    ->directory('lectures')
                    ->columnSpanFull(),
            ]);
    }
}
