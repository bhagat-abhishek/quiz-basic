<?php

namespace App\Filament\Resources\QuizSubmissionResource\Pages;

use App\Filament\Resources\QuizSubmissionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListQuizSubmissions extends ListRecords
{
    protected static string $resource = QuizSubmissionResource::class;

    protected function getActions(): array
    {
        return [
            
        ];
    }
}
