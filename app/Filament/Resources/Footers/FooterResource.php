<?php

namespace App\Filament\Resources\Footers;

use App\Filament\Resources\Footers\Pages\CreateFooter;
use App\Filament\Resources\Footers\Pages\EditFooter;
use App\Filament\Resources\Footers\Pages\ListFooters;
use App\Models\Footer;
use BackedEnum;
use UnitEnum;

use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;

use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;

class FooterResource extends Resource
{
    protected static ?string $model = Footer::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationLabel = 'Footer';

    protected static ?string $modelLabel = 'Footer';

    protected static ?string $pluralModelLabel = 'Footer';

    protected static string|UnitEnum|null $navigationGroup = 'Pengaturan';

    protected static ?int $navigationSort = 12;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Identitas & Lokasi')
                    ->description('Logo, alamat, dan peta lokasi yang ditampilkan di footer website.')
                    ->icon('heroicon-o-map-pin')
                    ->schema([
                        FileUpload::make('image')
                            ->label('Logo Universitas')
                            ->image()
                            ->directory('footers')
                            ->visibility('public')
                            ->imagePreviewHeight('120')
                            ->maxSize(2048)
                            ->required()
                            ->helperText('Logo putih/transparan paling cocok untuk footer.')
                            ->columnSpanFull(),

                        TextInput::make('alamat')
                            ->label('Alamat Lengkap')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        TextInput::make('link_gmaps')
                            ->label('Link Google Maps')
                            ->url()
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                    ]),

                Section::make('Kontak Resmi')
                    ->description('Email dan nomor WhatsApp yang bisa dihubungi pengunjung website.')
                    ->icon('heroicon-o-phone')
                    ->schema([
                        TextInput::make('email')
                            ->label('Email Kontak')
                            ->email()
                            ->required()
                            ->maxLength(255),

                        TextInput::make('wa')
                            ->label('Nomor WhatsApp')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Section::make('Sosial Media')
                    ->description('Link akun resmi universitas.')
                    ->icon('heroicon-o-globe-alt')
                    ->schema([
                        TextInput::make('link_instagram')
                            ->label('Instagram')
                            ->url()
                            ->required(),

                        TextInput::make('link_youtube')
                            ->label('YouTube')
                            ->url()
                            ->required(),

                        TextInput::make('link_linkedin')
                            ->label('LinkedIn')
                            ->url()
                            ->required(),

                        TextInput::make('link_facebook')
                            ->label('Facebook')
                            ->url()
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Logo')
                    ->disk('public')
                    ->height(50),

                TextColumn::make('alamat')
                    ->label('Alamat')
                    ->limit(50)
                    ->searchable(),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->copyable(),

                TextColumn::make('wa')
                    ->label('WhatsApp')
                    ->copyable()
                    ->prefix('+62 '),

                TextColumn::make('link_instagram')
                    ->label('Instagram')
                    ->url(fn ($record) => $record->link_instagram, true),

                TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFooters::route('/'),
            'create' => CreateFooter::route('/create'),
            'edit' => EditFooter::route('/{record}/edit'),
        ];
    }
}