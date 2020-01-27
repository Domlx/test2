<?php

namespace App\Services;

use App\Repositories\PersonsRepository;
use Illuminate\Http\Request;

class PersonsService
{
    /**
     * @var PersonsRepository
     */
    protected $repository;

    /**
     * @var \Illuminate\Config\Repository|mixed
     */
    protected $limit;

    /**
     * Service constructor.
     *
     * @param  PersonsRepository  $repository
     */
    public function __construct(PersonsRepository $repository)
    {
        $this->repository = $repository;
        $this->limit = config('app.pagination_limit');
    }

    /**
     * Get all data from database with offset and selected columns
     *
     * @param  int  $offset
     * @param  string  $columns
     *
     * @return mixed
     */
    public function all(int $offset, string $columns)
    {
        return $columns ? $this->repository->all($this->limit,
            $offset * $this->limit, explode(',', $columns))
            : $this->repository->all($this->limit, $offset * $this->limit);
    }

    /**
     * Find data by id
     *
     * @param  int  $id
     *
     * @return mixed
     */
    public function find(int $id)
    {
        return $this->repository->find($id);
    }

    /**
     * Store data into database
     *
     * @param  Request  $request
     *
     * @return mixed
     */
    public function create(Request $request)
    {
        return $this->repository->create($request->all());
    }

    /**
     * Update data by ID
     *
     * @param  int  $id
     * @param  Request  $request
     *
     * @return int
     */
    public function update(int $id, Request $request): int
    {
        return $this->repository->update($id, $request->all());
    }

    /**
     * Delete data from database by ID
     *
     * @param  int  $id
     *
     * @return int
     */
    public function delete(int $id) :int
    {
        return $this->repository->delete($id);
    }

    /**
     * @param $request
     * @return mixed|null
     */
    public function search($request)
    {
        $city = $request->city ?? null;
        $zip_code = $request->zip_code ?? null;
        if($city && $zip_code) {
            return $this->repository->search($city, $zip_code);
        }
        if($city) {
            return $this->repository->searchByOne('city', $city);
        }
        if($zip_code) {
            return $this->repository->searchByOne('zip_code', $zip_code);
        }
        return null;
    }
}
