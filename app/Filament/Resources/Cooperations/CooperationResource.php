<?php

namespace App\Filament\Resources\Cooperations;

use App\Filament\Resources\Cooperations\Pages\CreateCooperation;
use App\Filament\Resources\Cooperations\Pages\EditCooperation;
use App\Filament\Resources\Cooperations\Pages\ListCooperations;
use App\Filament\Resources\Cooperations\Schemas\CooperationForm;
use App\Filament\Resources\Cooperations\Tables\CooperationsTable;
use App\Models\Cooperation;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use UnitEnum;

class CooperationResource extends Resource
{
    protected static ?string $model = Cooperation::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationLabel = 'Kerja Sama';

    protected static ?string $modelLabel = 'Kerja Sama';

    protected static ?string $pluralModelLabel = 'Kerja Sama';

    protected static string|UnitEnum|null $navigationGroup = 'Manajemen Konten';

    protected static ?int $navigationSort = 1; // ← Urutan di menu

    public static function form(Schema $schema): Schema
    {
        return CooperationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CooperationsTable::configure($table);
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
            'index' => ListCooperations::route('/'),
            'create' => CreateCooperation::route('/create'),
            'edit' => EditCooperation::route('/{record}/edit'),
        ];
    }
}