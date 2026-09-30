<?php

namespace App\Filament\Resources\ContactMessages;

use App\Filament\Resources\ContactMessages\Pages\ManageContactMessages;
use App\Models\ContactMessage;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ContactMessageResource extends Resource
{
    protected static ?string $model = ContactMessage::class;

    protected static ?string $navigationLabel = 'Pesan Masuk';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->disabled(),
                TextInput::make('email')
                    ->label('Email')
                    ->disabled(),
                TextInput::make('phone')
                    ->label('Telepon')
                    ->disabled(),
                TextInput::make('event_name')
                    ->label('Nama event')
                    ->disabled(),
                Textarea::make('message')
                    ->label('Pesan')
                    ->disabled()
                    ->columnSpanFull(),
                DateTimePicker::make('consent_at')
                    ->label('Persetujuan diberikan')
                    ->disabled(),
                Select::make('status')
                    ->label('Status tindak lanjut')
                    ->options([
                        'new' => 'Baru',
                        'contacted' => 'Ditindaklanjuti',
                        'closed' => 'Selesai',
                    ])
                    ->required(),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('email')
                    ->label('Email')
                    ->placeholder('-'),
                TextEntry::make('phone')
                    ->label('Telepon')
                    ->placeholder('-'),
                TextEntry::make('event_name')
                    ->label('Nama event')
                    ->placeholder('-'),
                TextEntry::make('message')
                    ->label('Pesan')
                    ->columnSpanFull(),
                TextEntry::make('consent_at')
                    ->label('Persetujuan diberikan')
                    ->dateTime(),
                TextEntry::make('status')
                    ->label('Status tindak lanjut')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'contacted' => 'Ditindaklanjuti',
                        'closed' => 'Selesai',
                        default => 'Baru',
                    }),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                TextColumn::make('phone')
                    ->label('Telepon')
                    ->searchable(),
                TextColumn::make('event_name')
                    ->label('Event')
                    ->searchable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'contacted' => 'Ditindaklanjuti',
                        'closed' => 'Selesai',
                        default => 'Baru',
                    }),
                TextColumn::make('created_at')
                    ->label('Masuk')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'new' => 'Baru',
                        'contacted' => 'Ditindaklanjuti',
                        'closed' => 'Selesai',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageContactMessages::route('/'),
        ];
    }
}
