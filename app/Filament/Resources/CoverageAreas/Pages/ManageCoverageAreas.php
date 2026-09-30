<?php

namespace App\Filament\Resources\CoverageAreas\Pages;

use App\Filament\Resources\CoverageAreas\CoverageAreaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageCoverageAreas extends ManageRecords
{
    protected static string $resource = CoverageAreaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
