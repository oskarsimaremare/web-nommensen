<?php

namespace App\Filament\Resources\Aboutmes;

use App\Filament\Resources\Aboutmes\Pages\CreateAboutme;
use App\Filament\Resources\Aboutmes\Pages\EditAboutme;
use App\Filament\Resources\Aboutmes\Pages\ListAboutmes;
use Illuminate\Support\Str;
use App\Models\Aboutme;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use UnitEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;

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
        return $schema->components([
                Textarea::make('content')
                    ->label('Deskripsi Profil')
                    ->required()
                    ->rows(5)
                    ->placeholder('Tuliskan profil singkat universitas (keunggulan, fokus pendidikan, dll.)')
                    ->helperText('Deskripsi singkat tanpa formatting. Untuk konten berformat gunakan menu Sejarah.')
                    ->columnSpanFull(),

                FileUpload::make('image')
                    ->label('Foto (Multiple)')
                    ->image()
                    ->multiple()
                    ->reorderable()
                    ->maxFiles(5)
                    ->directory('aboutmes')
                    ->visibility('public')
                    ->imagePreviewHeight('120')
                    ->maxSize(2048)
                    ->required()
                    ->helperText('Bisa upload beberapa foto sekaligus. Maks 5 foto, masing-masing 2MB.')
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

            TextColumn::make('content')
                    ->label('Deskripsi')
                    ->formatStateUsing(fn (?string $state): string => Str::limit(strip_tags($state ?? ''), 100))
                    ->wrap()
                    ->searchable(),

            TextColumn::make('created_at')
                    ->label('Ditambahkan')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

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
            'index' => ListAboutmes::route('/'),
            'create' => CreateAboutme::route('/create'),
            'edit' => EditAboutme::route('/{record}/edit'),
        ];
    }
}
