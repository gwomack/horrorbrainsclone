<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Models\Post\Post;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Livewire\Component;

class CommentForm extends Component implements HasForms
{
    use InteractsWithForms;

    /**
     * The data for the form.
     */
    public ?array $data = [];

    /**
     * The post for the form.
     */
    public Post $post;

    /**
     * Mount the component.
     */
    public function mount(Post $post): void
    {
        $this->form->fill();
        $this->post = $post;
    }

    /**
     * The form schema.
     */
    public function form(Form $form)
    {
        return $form
            ->statePath('data')
            ->schema([
                Grid::make(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('')
                            ->markAsRequired(false)
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Username'),
                        TextInput::make('email')
                            ->label('')
                            ->email()
                            ->required()
                            ->markAsRequired(false)
                            ->maxLength(255)
                            ->placeholder('Email*'),
                        Textarea::make('comment')
                            ->label('')
                            ->required()
                            ->markAsRequired(false)
                            ->columnSpanFull()
                            ->placeholder('Your Review*')
                            ->rows(5),
                    ]),
            ]);
    }

    /**
     * Create a comment.
     */
    public function create(): void
    {
        $this->validate();

        $data = $this->form->getState();

        // $record = Comment::create($data);
        // $this->form->model($record)->saveRelationships();

        $this->post->comments()->create($data);

        Notification::make()
            ->title('Comment submitted. It will be published after approval.')
            ->success()
            ->send();

        $this->form->fill();
    }

    /**
     * Render the component.
     */
    public function render()
    {
        return view('livewire.comment-form');
    }
}
