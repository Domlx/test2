<?php

namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface IRepository
{
    /**
     * Get all entities
     *
     * @param  int  $limit
     * @param  int  $offset
     * @param  array  $columns
     *
     * @return Collection|null
     */
    public function all(int $limit, int $offset, array $columns = ['*']): ?Collection;

    /**
     * Create entity
     *
     * @param  array  $data
     *
     * @return mixed
     */
    public function create(array $data);

    /**
     * Update entity
     *
     * @param  int  $id
     * @param  array  $attributes
     *
     * @return mixed
     */
    public function update(int $id, array $attributes);

    /**
     * Delete entity
     *
     * @param  int  $id
     *
     * @return mixed
     */
    public function delete(int $id);

    /**
     * Find by id
     *
     * @param  int  $id
     *
     * @return mixed
     */
    public function find(int $id);

}
