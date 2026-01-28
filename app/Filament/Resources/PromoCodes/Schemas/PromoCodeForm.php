<?php

namespace App\Filament\Resources\PromoCodes\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PromoCodeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('code')
                    ->required(),
                Select::make('discount_type')
                    ->options(['percentage' => 'Percentage', 'fixed' => 'Fixed'])
                    ->required(),
                TextInput::make('discount_value')
                    ->required()
                    ->numeric(),
                DateTimePicker::make('valid_from')
                    ->required()
                    ->label('Valid From')
                    ->seconds(false)
                    ->default(fn () => now()->setTime(0, 0, 0)),
                DateTimePicker::make('valid_until')
                    ->required()
                    ->label('Valid Until')
                    ->seconds(false)
                    ->default(fn () => now()->setTime(23, 59, 59)),
                TextInput::make('usage_limit')
                    ->numeric()
                    ->minValue(0),
                TextInput::make('times_used')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->default(0),
            ]);
    }
}
