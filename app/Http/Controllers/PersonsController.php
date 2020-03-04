<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonCreateRequest;
use App\Http\Requests\PersonSearchRequest;
use App\Http\Requests\PersonUpdateRequest;
use App\Services\PersonsService;
use Illuminate\Http\JsonResponse;
use App\Exceptions\InternalErrorException;

/**
 * Class PersonsController
 * @package App\Http\Controllers
 */
class PersonsController extends Controller
{
    /**
     * @var PersonsService
     */
    private $service;

    /**
     * @var string
     */
    protected $type = 'persons';

    /**
     * EmployeeController constructor.
     *
     * @param  PersonsService  $service
     */
    public function __construct(PersonsService $service)
    {
        $this->service = $service;
    }

    /**
     * @param  int  $offset
     * @param  string  $columns
     *
     * @return JsonResponse
     * @throws InternalErrorException
     */
    public function index(int $offset = 0, string $columns = ''): JsonResponse
    {
        try {
            return $this->getAttributes(
                $this->service->all($offset, $columns)
            );
        } catch (\Exception $e) {
            throw new InternalErrorException($e->getMessage());
        }
    }

    /**
     * @param PersonSearchRequest $request
     * @return JsonResponse
     * @throws InternalErrorException
     */
    public function search(PersonSearchRequest $request)
    {
        try {
            $result = $this->service->search($request);
            return $result ? $this->getAttributes($result) :$this->generateNotFound();
        } catch (\Exception $e) {
            throw new InternalErrorException($e->getMessage());
        }
    }

    /**
     * @param  int  $id
     *
     * @return JsonResponse
     * @throws InternalErrorException
     */
    public function item(int $id): JsonResponse
    {
        try {
            $item = $this->service->find($id);
            return $item ? $this->getAttributes($item) :$this->generateNotFound();
        } catch (\Exception $e) {
            throw new InternalErrorException($e->getMessage());
        }
    }

    /**
     * @param  PersonCreateRequest  $request
     *
     * @return JsonResponse
     * @throws InternalErrorException
     */
    public function create(PersonCreateRequest $request): JsonResponse
    {
        try {
            $message = $this->service->create($request)
                ? "Item created successfully"
                : "Error, item not created. Please, try again later";

            return $this->getMessage($message);
        } catch (\Exception $e) {
            throw new InternalErrorException($e->getMessage());
        }
    }

    /**
     * @param  int  $id
     * @param  PersonUpdateRequest  $request
     *
     * @return JsonResponse
     * @throws InternalErrorException
     */
    public function update(int $id, PersonUpdateRequest $request): JsonResponse
    {
        try {
            $message = $this->service->update($id, $request)
                ? "Item updated successfully"
                : "Error, item not updated. Please, try again later";

            return $this->getMessage($message);
        } catch (\Exception $e) {
            throw new InternalErrorException($e->getMessage());
        }
    }

    /**
     * @param  int  $id
     *
     * @return JsonResponse
     * @throws InternalErrorException
     */
    public function delete(int $id): JsonResponse
    {
        try {
            $message = $this->service->delete($id) ? "Item deleted successfully"
                : "Error, item not deleted. Please, try again later";

            return $this->getMessage($message);
        } catch (\Exception $e) {
            throw new InternalErrorException($e->getMessage());
        }
    }
}
