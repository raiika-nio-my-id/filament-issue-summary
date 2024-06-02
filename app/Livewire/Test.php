<?php

namespace App\Livewire;

use App\Models\User;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\Summarizers\Summarizer;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;

class Test extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(User::query())
            ->columns([
                TextColumn::make('email'),

                TextColumn::make('field')
                    ->getStateUsing(fn () => 1),
                TextColumn::make('field')
                        ->summarize([
                            Summarizer::make()
                                ->using(fn () => 1)
                        ]),

                TextColumn::make('name')
                    ->formatStateUsing(fn (): View => view(
                            'test_field_2'
                        )),
                TextColumn::make('name')
                        ->summarize([
                            Summarizer::make()
                                ->using(fn () => 2)
                        ]),
            ]);
    }

    public function render()
    {
        return view('livewire.test');
    }
}
