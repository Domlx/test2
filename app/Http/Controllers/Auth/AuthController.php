<?php


namespace App\Http\Controllers\Auth;


use App\Exceptions\InternalErrorException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Authentication\AuthenticationService;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Exception;

/**
 * Class AuthController
 *
 * @package App\Http\Controllers\Auth
 */
class AuthController extends Controller
{
    /**
     * @var AuthenticationService
     */
    protected $service;

    /**
     * @var string
     */
    protected $type = 'user';

    /**
     * AuthController constructor.
     *
     * @param  AuthenticationService  $service
     */
    public function __construct(AuthenticationService $service)
    {
        $this->service = $service;
    }

    /**
     * Login user and create token
     *
     * @param  LoginRequest  $request
     *
     * @return JsonResponse
     * @throws InternalErrorException
     */
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            return $this->getAttributes(
                $this->service->authenticate($request)
            );
        } catch (BadResponseException $e) {
            $code = $e->getCode();

            if ($code === Response::HTTP_BAD_REQUEST) {
                throw new InternalErrorException('Invalid Request. Please enter a username or a password.');
            }

            if ($code === Response::HTTP_UNAUTHORIZED) {
                throw new InternalErrorException('Your credentials are incorrect. Please try again.');
            }

            throw new InternalErrorException($e->getMessage());
        }
    }

    /**
     * Registration of user
     *
     * @param  RegisterRequest  $request
     *
     * @return JsonResponse
     * @throws InternalErrorException
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            $status = $this->service->register($request);
            $message = $status ? "User registered successfully"
                : "Error, item not registered. Please, try again later";

            return $this->getMessage($message);
        } catch (Exception $e) {
            throw new InternalErrorException($e->getMessage());
        }
    }

    /**
     * Get current user
     *
     * @param  Request  $request
     *
     * @return JsonResponse
     */
    public function user(Request $request): JsonResponse
    {
        return $this->getAttributes($request->user());
    }

    /**
     * Logout user (Revoke the token)
     *
     * @return JsonResponse
     * @throws InternalErrorException
     */
    public function logout(): JsonResponse
    {
        try {
            $this->service->logout();
            return $this->getMessage('Logged out successfully');
        } catch (Exception $e) {
            throw new InternalErrorException($e->getMessage());
        }
    }
}
