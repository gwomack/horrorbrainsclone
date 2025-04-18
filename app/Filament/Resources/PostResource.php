<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post\Post;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\Alignment;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use Mokhosh\FilamentRating\Columns\RatingColumn;
use Mokhosh\FilamentRating\RatingTheme;

class PostResource extends Resource
{
    /**
     * The model for the resource.
     */
    protected static ?string $model = Post::class;

    /**
     * The navigation icon for the resource.
     */
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    /**
     * The navigation label for the resource.
     */
    protected static ?string $navigationLabel = 'Posts';

    /**
     * The plural model label for the resource.
     */
    protected static ?string $pluralModelLabel = 'Posts';

    /**
     * The model label for the resource.
     */
    protected static ?string $modelLabel = 'Post';

    /**
     * Get the form for the resource.
     */
    public static function form(Form $form): Form
    {
        return $form
            ->schema(Post::getForm());
    }

    /**
     * Get the table for the resource.
     */
    public static function table(Table $table): Table
    {
        return $table
            ->filtersTriggerAction(function (Action $action) {
                $action->button()->label('Filters');
            })
            ->defaultSort('created_at', 'desc')
            ->columns([
                SpatieMediaLibraryImageColumn::make('thumb')
                    ->label('Thumb')
                    ->collection('images')
                    ->conversion('thumbnail')
                    ->disk('posts')
                    ->alignment(Alignment::Center)
                    ->limit(1),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->description(fn (Post $record) => new HtmlString(Str::limit($record->description, 50)))
                    ->html(),
                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('release_date')
                    ->date()
                    ->sortable(),
                RatingColumn::make('rating')
                    ->label('Rating')
                    ->sortable()
                    ->theme(RatingTheme::HalfStars)
                    ->size('sm'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\ToggleColumn::make('is_published')
                    ->label('Published')
                    ->sortable(),
                Tables\Columns\TextColumn::make('published_at')
                    ->date()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('tags')
                    ->label('Tags')
                    ->multiple()
                    ->relationship('tags', 'name'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label(''),
                Tables\Actions\DeleteAction::make()
                    ->label(''),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    /**
     * Get the relations for the resource.
     */
    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    /**
     * Get the pages for the resource.
     */
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
