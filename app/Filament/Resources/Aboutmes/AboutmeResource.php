<?php

namespace App\Filament\Resources\Aboutmes;

use App\Filament\Resources\Aboutmes\Pages\CreateAboutme;
use App\Filament\Resources\Aboutmes\Pages\EditAboutme;
use App\Filament\Resources\Aboutmes\Pages\ListAboutmes;
use App\Filament\Resources\Aboutmes\Schemas\AboutmeForm;
use App\Filament\Resources\Aboutmes\Tables\AboutmesTable;
use App\Models\Aboutme;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class AboutmeResource extends Resource
{
    protected static ?string $model = Aboutme::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-information-circle';

    protected static ?string $navigationLabel = 'Tentang Kami';

    protected static ?string $modelLabel = 'Tentang Kami';

    protected static ?string $pluralModelLabel = 'Tentang Kami';

    protected static string|UnitEnum|null $navigationGroup = 'Profil Universitas';
    protected static ?int $navigationSort = 10; // ← Urutan di menu

    public static function form(Schema $schema): Schema
    {
        return AboutmeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AboutmesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAboutmes::route('/'),
            'create' => CreateAboutme::route('/create'),
            'edit' => EditAboutme::route('/{record}/edit'),
        ];
    }
}
