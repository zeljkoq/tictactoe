<?php

namespace App\Http\Controllers\Api;

use App\Events\ChallengeEvent;
use App\Events\GameEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Class ChallengeController
 * @package App\Http\Controllers\Api
 */
class ChallengeController extends Controller
{
    /**
     * @return mixed
     * @throws \App\Exceptions\Custom
     */
    public function index()
    {
        return $this->ChallengeService()->index();
    }
    
    /**
     * @param $challenge_id
     * @return mixed
     * @throws \App\Exceptions\Custom
     */
    public function challenge($challenge_id)
    {
        $challenge = $this->ChallengeService()->challenge($challenge_id);
        
        broadcast(new ChallengeEvent($challenge));
        
        return $challenge;
    }
    
    public function myChallenge()
    {
        $challenge = $this->ChallengeService()->myChallenge();
        
        return $challenge;
    }
    
    /**
     * @param Request $request
     * @param $user_id
     * @return \App\Challenge
     * @throws \App\Exceptions\Custom
     */
    public function create(Request $request, $user_id)
    {
        $challenge = $this->ChallengeService()->create($request, $user_id);
        
        broadcast(new ChallengeEvent($challenge));
        
        return $challenge;
    }
    
    /**
     * @param $user_id
     * @param $challenge_id
     * @return \App\Game
     * @throws \App\Exceptions\Custom
     */
    public function accept($user_id, $challenge_id)
    {
        $game = $this->ChallengeService()->accept($user_id, $challenge_id);
        
        broadcast(new GameEvent($game));
        
        return $game;
    }
}
