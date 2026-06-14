<?php

namespace App\Filament\Resources\Facilities;

use App\Filament\Resources\Facilities\Pages\CreateFacility;
use App\Filament\Resources\Facilities\Pages\EditFacility;
use App\Filament\Resources\Facilities\Pages\ListFacilities;
use App\Filament\Resources\Facilities\Schemas\FacilityForm;
use App\Filament\Resources\Facilities\Tables\FacilitiesTable;
use App\Models\Facility;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class FacilityResource extends Resource
{
    protected static ?string $model = Facility::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-building-library';

    protected static ?string $navigationLabel = 'Fasilitas';

    protected static ?string $modelLabel = 'Fasilitas';

    protected static ?string $pluralModelLabel = 'Fasilitas';

    protected static string|UnitEnum|null $navigationGroup = 'Manajemen Konten';
    protected static ?int $navigationSort = 3; // ← Urutan di menu

    public static function form(Schema $schema): Schema
    {
        return FacilityForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FacilitiesTable::configure($table);
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
            'index' => ListFacilities::route('/'),
            'create' => CreateFacility::route('/create'),
            'edit' => EditFacility::route('/{record}/edit'),
        ];
    }
}
