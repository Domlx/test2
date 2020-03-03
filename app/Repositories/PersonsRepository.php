<?php

namespace App\Repositories;

use App\Mail\UserCreated;
use App\Repositories\Interfaces\IRepository;
use App\Models\Persons;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;

/**
 * Class PersonsRepository
 * @package App\Repositories
 */
class PersonsRepository implements IRepository
{
    /**
     * @var Persons
     */
    protected $model;

    /**
     * PersonsRepository constructor.
     *
     * @param  Persons  $model
     */
    public function __construct(Persons $model)
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
        $person = $this->model->create($data);
        if($person && $data['requests']){
            foreach ($data['requests'] as $item){
                $person->requests()->create($item);
            }
        }
        Mail::to(config('mail.to.address'))->send(new UserCreated());
        return $person;
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
     * @param $city
     * @param $zip
     * @return mixed
     */
    public function search($city, $zip)
    {
        return $this->model->where('city', 'like', $city)->where('zip_code', 'like', $zip)->get();
    }

    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    public function searchByOne($key, $value)
    {
        return $this->model->where($key, 'like', $value)->get();
    }
}
