<?php

namespace App\Http\Repositories;
use App\Http\Repositories\RepositoryInterface;

abstract class BaseRepository implements RepositoryInterface
{
    protected $model;

    protected $originalModel;

    //khởi tạo
    public function __construct()
    {
        $this->setModel();
        $this->originalModel = $this->model;
    }

    //lấy model tương ứng
    abstract public function getModel();

    /**
     * Set model
     */
    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function find($id, array $with = [])
    {
        if (!empty($with)) {
            $result = $this->model->with($with)->find($id);
        } else {
            $result = $this->model->find($id);
        }

        return $result;
    }

    public function create($attributes = [])
    {
        return $this->model->create($attributes);
    }

    public function update($id, $attributes = [])
    {
        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);
            return $result;
        }

        return false;
    }

    public function updateWithReferenceId($key, $attributes = [])
    {
        $result = $this->model->where('reference_id', $key)->first();
        if ($result) {
            $result->update($attributes);
            return $result;
        }

        return false;
    }

    public function updateWithPostsId($key, $attributes = [])
    {
        $result = $this->model->where('posts_id', $key)->first();
        if ($result) {
            //$result->update($attributes);
            $this->model->where('posts_id', $key)
                ->update($attributes);
            return $result;
        }

        return false;
    }

    public function delete($id)
    {
        $result = $this->find($id);
        if ($result) {
            $result->delete();

            return true;
        }

        return false;
    }

    public function restoreBy($id)
    {
        $item = $this->model->where('id', $id)->whereNotNull('deleted_at')->withTrashed()->first();
        if (!empty($item)) {
            $item->restore();
        }
    }

    public function checkModeActionWebsite()
    {
        return env('MODE_ACTION_WEBSITE', true);
    }

    public function getFirstBy(array $condition = [], array $select = ['*'], array $with = [])
    {
        if (!empty($select)) {
            $data = $this->model->select($select)->with($with)->where($condition)->first();
        } else {
            $data = $this->model->select('*')->with($with)->where($condition)->first();
        }

        return $data;
    }

    public function resetModel(): self
    {
        $this->model = new $this->originalModel();

        return $this;
    }

    public function createOrUpdate($data, array $condition = [])
    {

        if (is_array($data)) {
            if (empty($condition)) {
                $item = new $this->model();
            } else {
                $item = $this->getFirstBy($condition);
            }

            if (empty($item)) {
                $item = new $this->model();
            }

            $item = $item->fill($data);
        } elseif ($data instanceof Model) {
            $item = $data;
        } else {
            return false;
        }

        $this->resetModel();

        if ($item->save()) {
            return $item;
        }

        return false;
    }

    public function updateWithPostsTranslation($key, $langCode, $attributes = [])
    {
        $result = $this->model->where('posts_id', $key)->where('lang_code', $langCode)->first();
        if ($result) {
            //$result->update($attributes);
            $this->model->where('posts_id', $key)->where('lang_code', $langCode)
                ->update($attributes);
            return $result;
        }

        return false;
    }

    public function updateWithPagesTranslation($key, $langCode, $attributes = [])
    {
        $result = $this->model->where('pages_id', $key)->where('lang_code', $langCode)->first();
        if ($result) {
            //$result->update($attributes);
            $this->model->where('pages_id', $key)->where('lang_code', $langCode)
                ->update($attributes);
            return $result;
        }

        return false;
    }

    public function updateWithCategoriesTranslation($key, $langCode, $attributes = [])
    {
        $result = $this->model->where('categories_id', $key)->where('lang_code', $langCode)->first();
        if ($result) {
            //$result->update($attributes);
            $this->model->where('categories_id', $key)->where('lang_code', $langCode)
                ->update($attributes);
            return $result;
        }

        return false;
    }

    public function updateWithTagTranslation($key, $langCode, $attributes = [])
    {
        $result = $this->model->where('tags_id', $key)->where('lang_code', $langCode)->first();
        if ($result) {
            //$result->update($attributes);
            $this->model->where('tags_id', $key)->where('lang_code', $langCode)
                ->update($attributes);
            return $result;
        }

        return false;
    }

    public function allBy(array $condition, array $with = [], array $select = ['*'])
    {
        $query = $this->model->newQuery();

        // Thêm điều kiện cho câu truy vấn
        foreach ($condition as $column => $value) {
            $query->where($column, $value);
        }

        // Nếu có các liên kết (relationships) được truy vấn thì eager load
        if (!empty($with)) {
            $query->with($with);
        }

        // Chọn các cột muốn lấy
        if (!empty($select)) {
            $query->select($select);
        }

        // Thực hiện truy vấn và trả về kết quả
        return $query->get();
    }

    public function activate($arrId = [], $value = 1)
    {
        return $this->model->whereIn('id', $arrId)->update(['status' => $value]);
    }

    public function deactivate($arrId = [], $value = 2)
    {
        return $this->model->whereIn('id', $arrId)->update(['status' => $value]);
    }

    public function updateOrCreate($key = [], $attributes = [])
    {
        return $this->model->updateOrCreate($key, $attributes);
    }
}
