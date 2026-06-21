<?php

namespace App\Filament\Resources\Visimisis;

use App\Filament\Resources\Visimisis\Pages\CreateVisimisi;
use App\Filament\Resources\Visimisis\Pages\EditVisimisi;
use App\Filament\Resources\Visimisis\Pages\ListVisimisis;
use App\Models\Visimisi;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use UnitEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Illuminate\Support\Str;

class VisimisiResource extends Resource
{
    protected static ?string $model = Visimisi::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-eye';

    protected static ?string $navigationLabel = 'Visimisi';

    protected static ?string $modelLabel = 'Visimisi';

    protected static ?string $pluralModelLabel = 'Visimisi';

    protected static string|UnitEnum|null $navigationGroup = 'Profil Universitas';
    protected static ?int $navigationSort = 11; // ← Urutan di menu

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
       RichEditor::make('visi')
                ->label('Visi')
                ->toolbarButtons([
                    'bold',
                    'italic',
                    'underline',
                    'bulletList',
                    'orderedList',
                    'link',
                    'h3',
                ])
                ->required()
                ->columnSpanFull(),

            RichEditor::make('misi')
                ->label('Misi')
                ->toolbarButtons([
                    'bold',
                    'italic',
                    'underline',
                    'bulletList',
                    'orderedList',
                    'link',
                    'h3',
                ])
                ->required()
                ->helperText('Gunakan numbered list untuk menuliskan poin-poin misi.')
                ->columnSpanFull(),

            FileUpload::make('image')
                ->label('Foto (Multiple)')
                ->image()
                ->multiple()
                ->reorderable()
                ->maxFiles(5)
                ->directory('visimisis')
                ->visibility('public')
                ->imagePreviewHeight('120')
                ->maxSize(2048)
                ->required()
                ->helperText('Bisa upload beberapa foto. Maks 5 foto, masing-masing 2MB.')
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
        ImageColumn::make('image')
                ->label('Foto')
                ->disk('public')
                ->height(50)
                ->stacked()
                ->limit(3)
                ->limitedRemainingText(),

            TextColumn::make('visi')
                ->label('Visi')
                ->formatStateUsing(fn (?string $state): string => Str::limit(strip_tags($state ?? ''), 60))
                ->wrap()
                ->searchable(),

            TextColumn::make('misi')
                ->label('Misi')
                ->formatStateUsing(fn (?string $state): string => Str::limit(strip_tags($state ?? ''), 60))
                ->wrap()
                ->toggleable(),

            TextColumn::make('updated_at')
                ->label('Diperbarui')
                ->dateTime('d M Y H:i')
                ->sortable(),
        ])
        ->filters([
            //
        ])
        ->actions([
            EditAction::make(),
            DeleteAction::make(),
        ])
        ->bulkActions([
            BulkActionGroup::make([
                DeleteBulkAction::make(),
            ]),
        ])
        ->defaultSort('updated_at', 'desc');
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
            'index' => ListVisimisis::route('/'),
            'create' => CreateVisimisi::route('/create'),
            'edit' => EditVisimisi::route('/{record}/edit'),
        ];
    }
}
