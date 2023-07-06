<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\TernaryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;
use STS\FilamentImpersonate\Tables\Actions\Impersonate;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'Authentication';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('name')
                            ->required(),
                        TextInput::make('email')
                            ->required()
                            ->email()
                            ->unique(table: static::$model, ignorable: fn ($record) => $record),
                        TextInput::make('password')
                            ->same('passwordConfirmation')
                            ->password()
                            ->maxLength(255)
                            ->required(fn ($component, $get, $livewire, $model, $record, $set, $state) => $record === null)
                            ->dehydrateStateUsing(fn ($state) => ! empty($state) ? Hash::make($state) : ''),
                        TextInput::make('passwordConfirmation')
                            ->password()
                            ->dehydrated(false)
                            ->required(function($component, $get, $livewire, $model, $record, $set, $state) {
                                return !empty($get('password'));
                            })
                            ->maxLength(255),
                        Select::make('roles')
                            ->multiple()
                            ->relationship('roles', 'name', function (Builder $query) {
                                $query->orderBy('id');
                                if (auth()->user()?->hasRole('super_admin'))
                                    return $query;
                                return $query->where('name', '!=', 'super_admin')->where('name', '!=', 'admin');
                            })
                            ->preload()
                            ->required(fn ($component, $get, $livewire, $model, $record, $set, $state) => $record === null),
                        Select::make('permissions')
                            ->multiple()
                            ->relationship('permissions', 'name', function (Builder $query) {
                                $query->orderBy('id');
                                return $query;
                            })
                            ->preload()
                            ->label('Direct Permissions')
                            ->visible(auth()->user()?->hasRole('super_admin'))
                    ])->columns(2),
            ]);
    }

    /**
     * @throws \Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('email'),
                IconColumn::make('email_verified_at')
                    ->options([
                        'heroicon-o-check-circle',
                        'heroicon-o-x-circle' => fn ($state): bool => $state === null,
                    ])
                    ->colors([
                        'success',
                        'danger' => fn ($state): bool => $state === null,
                    ])
                    ->label(''),
                Tables\Columns\TextColumn::make('roles.name')
                    ->label('Roles'),
                Tables\Columns\TextColumn::make('permissions.name')
                    ->label('Direct Permissions')
                    ->visible(auth()->user()?->hasRole('super_admin')),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->dateTime('y-m-d H:i')
                    ->visible(auth()->user()?->hasRole('super_admin'))
                    ->toggleable(auth()->user()?->hasRole('super_admin'),true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->dateTime('y-m-d H:i')
                    ->visible(auth()->user()?->hasRole('super_admin'))
                    ->toggleable(auth()->user()?->hasRole('super_admin'),true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->dateTime('y-m-d H:i')
                    ->visible(auth()->user()?->hasRole('super_admin'))
                    ->toggleable(auth()->user()?->hasRole('super_admin'),true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                TernaryFilter::make('email_verified_at')
                    ->nullable(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make()->hidden(! auth()->user()->hasRole('super_admin'))->visible(fn ($record) => $record->trashed()),
                Tables\Actions\RestoreAction::make()->visible(fn ($record) => $record->trashed()),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make()->hidden(! auth()->user()->hasRole('super_admin')),
                Tables\Actions\RestoreBulkAction::make(),
            ])->prependActions([
                Impersonate::make(), // <---
            ]);
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        if (auth()->user()->hasRole('super_admin'))
            return parent::getEloquentQuery()->where('id', '!=', auth()->user()->id);
        else
            return parent::getEloquentQuery()
                ->withoutGlobalScopes([
                    SoftDeletingScope::class,
                ])
                ->whereHas('roles', function ($query) {
                    $query->where('name', '!=', 'super_admin')->where('name', '!=', 'admin');
                })
                ->where('id', '!=', auth()->user()->id);
    }
}
