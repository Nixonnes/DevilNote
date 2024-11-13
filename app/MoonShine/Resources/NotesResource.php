<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Note;
use Illuminate\Database\Eloquent\Model;
use App\MoonShine\Pages\Notes\NotesIndexPage;
use App\MoonShine\Pages\Notes\NotesFormPage;
use App\MoonShine\Pages\Notes\NotesDetailPage;

use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;
use MoonShine\Pages\Page;

/**
 * @extends ModelResource<Note>
 */
class NotesResource extends ModelResource
{
    protected string $model = Note::class;

    protected string $title = 'Notes';
    public function fields() : array
    {
        return [
            ID::make(),
            \MoonShine\Fields\Text::make('Content', 'content'),
            Text::make('User_id', 'user_id')
        ];
    }

    /**
     * @return list<Page>
     */
    public function pages(): array
    {
        return [
            NotesIndexPage::make($this->title()),
            NotesFormPage::make(
                $this->getItemID()
                    ? __('moonshine::ui.edit')
                    : __('moonshine::ui.add')
            ),
            NotesDetailPage::make(__('moonshine::ui.show')),
        ];
    }

    /**
     * @param Note $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
