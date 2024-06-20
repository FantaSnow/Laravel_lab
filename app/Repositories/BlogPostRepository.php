<?php

namespace App\Repositories;

use App\Models\BlogPost as Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class BlogСategoryRepository.
 */
class BlogPostRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class; //абстрагування моделі BlogCategory, для легшого створення іншого репозиторія
    }

    /**
     * Отримати список статей
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllWithPaginate($perPage = 200)
    {
        $columns = ['id', 'title', 'slug', 'is_published', 'published_at', 'user_id', 'category_id'];

        $result = $this->startConditions()
            ->select($columns)
            ->orderBy('id', 'DESC')
            ->with([
                'category:id,title',
                'user:id,name',
            ])
            ->paginate($perPage);

        return $result;
    }
    /**
     *  Отримати модель для редагування в адмінці
     *  @param int $id
     *  @return Model
     */
    public function getEdit($id)
    {
        $collection = new Collection($id);

        return $this->startConditions()->find($id);
    }
}
