<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use App\Services\ChallengeService;
use App\Services\GameService;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

/**
 * Class Controller
 * @package App\Http\Controllers
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    /**
     * @return AuthService
     */
    public function AuthService()
    {
        return new AuthService();
    }
    public function GameService()
    {
        return new GameService();
    }
    public function ChallengeService()
    {
        return new ChallengeService();
    }
}
