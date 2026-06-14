<?php

namespace App\Filament\Resources\Students\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class StudentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('namalengkap')
                    ->required()
                    ->maxLength(255),
                TextInput::make('namapanggilan')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required()
                    ->maxLength(255),
                TextInput::make('nomor_hp')
                    ->required()
                    ->maxLength(15),
                TextInput::make('jalur')
                    ->required()
                    ->maxLength(255),
                FileUpload::make('image')
                    ->image()
                    ->required()
                    ->directory('students')
                    ->columnSpanFull(),
                TextInput::make('programstudi_1')
                    ->required()
                    ->maxLength(255),
                TextInput::make('programstudi_2')
                    ->required()
                    ->maxLength(255),
            ]);
    }
}
