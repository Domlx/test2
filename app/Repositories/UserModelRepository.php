<?php

namespace App\Repositories\User;

use App\Repositories\Interfaces\IRepository;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Collection;

/**
 * Class UserModelRepository
 *
 * @package App\Repositories\User
 */
class UserModelRepository implements IRepository
{
    /**
     * @var User
     */
    protected $model;

    /**
     * PersonsRepository constructor.
     *
     * @param  User  $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * Get all entities
     *
     * @param  int  $limit
     * @param  int  $offset
     * @param  array  $columns
     *
     * @return Collection|null
     */
    public function all(int $limit, int $offset, array $columns = ['*']): ?Collection
    {
        return $this->model->select($columns)->take($limit)->skip($offset)->get();
    }

    /**
     * @param  array  $data
     *
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Update entity
     *
     * @param  int  $id
     * @param  array  $attributes
     *
     * @return mixed
     */
    public function update(int $id, array $attributes)
    {
        return $this->model->findOrFail($id)->update($attributes);
    }

    /**
     * @param  int  $id
     *
     * @return mixed
     */
    public function delete(int $id)
    {
        return $this->model->findOrFail($id)->delete();
    }

    /**
     * @param  int  $id
     *
     * @return mixed
     */
    public function find(int $id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function authUser():?Authenticatable
    {
        return auth()->user();
    }

    /**
     * Clear tokens of authenticated user
     */
    public function clearTokens():void
    {
        $this->authUser()->tokens->each(function ($token) {
            $token->delete();
        });
    }
}
