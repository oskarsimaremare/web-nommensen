<?php

namespace App\Filament\Resources\News;

use App\Filament\Resources\News\Pages\CreateNews;
use App\Filament\Resources\News\Pages\EditNews;
use App\Filament\Resources\News\Pages\ListNews;
use App\Models\News;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;
use Illuminate\Support\Str;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationLabel = 'Berita';

    protected static ?string $modelLabel = 'Berita';

    protected static ?string $pluralModelLabel = 'Berita';

    protected static string|UnitEnum|null $navigationGroup = 'Publikasi';
    protected static ?int $navigationSort = 9; // ← Urutan di menu

   public static function form(schema $schema): schema
{
    return $schema
        ->components([
            TextInput::make('title')
                ->label('Judul Berita')
                ->required()
                ->maxLength(255)
                ->placeholder('contoh: B University Raih Akreditasi Unggul')
                ->helperText('Slug URL akan dibuat otomatis dari judul ini.')
                ->columnSpanFull(),

            RichEditor::make('content')
                ->label('Isi Berita')
                ->toolbarButtons([
                    'bold',
                    'italic',
                    'underline',
                    'bulletList',
                    'orderedList',
                    'link',
                    'h2',
                    'h3',
                ])
                ->required()
                ->columnSpanFull(),

            FileUpload::make('image')
                ->label('Foto Berita')
                ->image()
                ->directory('news')
                ->visibility('public')
                ->imagePreviewHeight('200')
                ->maxSize(3072)
                ->required()
                ->helperText('Foto utama berita. Format: JPG, PNG. Maks 3MB.')
                ->columnSpanFull(),

            Hidden::make('slug'),
            Hidden::make('users_id'),
        ]);
}

    public static function table(Table $table): Table
{
    return $table
        ->columns([
            ImageColumn::make('image')
                ->label('Foto')
                ->disk('public')
                ->height(60),

            TextColumn::make('title')
                ->label('Judul')
                ->searchable()
                ->sortable()
                ->weight('bold')
                ->limit(45)
                ->tooltip(fn (?string $state): ?string => $state),

            TextColumn::make('content')
                ->label('Cuplikan')
                ->formatStateUsing(fn (?string $state): string => Str::limit(strip_tags($state ?? ''), 60))
                ->wrap()
                ->toggleable(),

            TextColumn::make('user.name')
                ->label('Penulis')
                ->badge()
                ->color('success')
                ->sortable(),

            TextColumn::make('slug')
                ->label('Slug')
                ->copyable()
                ->copyMessage('Slug disalin!')
                ->limit(35)
                ->toggleable(isToggledHiddenByDefault: true),

            TextColumn::make('created_at')
                ->label('Diterbitkan')
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
        ->defaultSort('created_at', 'desc');
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
            'index' => ListNews::route('/'),
            'create' => CreateNews::route('/create'),
            'edit' => EditNews::route('/{record}/edit'),
        ];
    }
}
