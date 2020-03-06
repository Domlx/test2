<?php

namespace App\Services\Authentication;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Repositories\User\UserModelRepository;
use GuzzleHttp\Client;

class AuthenticationService
{
    /**
     * @var UserModelRepository
     */
    protected $userRepository;

    /**
     * AuthenticationService constructor.
     *
     * @param  UserModelRepository  $userRepository
     */
    public function __construct(UserModelRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param  LoginRequest  $request
     *
     * @return array
     */
    public function authenticate(LoginRequest $request): array
    {
        $http = new Client();

        $response = $http->post(config('services.passport.login_url'), [
            'form_params' => [
                'grant_type'    => 'password',
                'client_id'     => config('services.passport.client_id'),
                'client_secret' => config('services.passport.client_secret'),
                'username'      => $request->email,
                'password'      => $request->password,
            ]
        ]);

        return json_decode((string) $response->getBody(), true);
    }

    /**
     * @param  RegisterRequest  $request
     *
     * @return mixed
     */
    public function register(RegisterRequest $request)
    {
        $data = $request->merge([
            'password' => bcrypt($request->password)
        ])->all();

        return $this->userRepository->create($data);
    }

    /**
     * @return mixed
     */
    public function logout(): void
    {
        $this->userRepository->clearTokens();
    }
}
