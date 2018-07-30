<?php

namespace App\Services;

use App\Challenge;
use App\Exceptions\Custom;
use App\Game;

/**
 * Class AuthService
 * @package App\Services
 */
class ChallengeService
{
    /**
     * @return mixed
     * @throws Custom
     */
    public function index()
    {
        $challenges = Challenge::get();
        
        if (count($challenges) > 0) {
            return $challenges;
        }
        throw new Custom('No challenges found', '403');
    }
    
    /**
     * @param $challenge_id
     * @return mixed
     * @throws Custom
     */
    public function challenge($challenge_id)
    {
        
        $challenge = Challenge::find($challenge_id);
        
        if ($challenge) {
            return $challenge;
        }
        
        throw new Custom('Challenge not found', '403');
    }
    
    public function myChallenge()
    {
        $challenge = Challenge::where(function ($q) {
            $q->where('user_one', auth()->user()->id)
                ->orWhere('user_two', auth()->user()->id);
        })
            ->get();
        
        if ($challenge) {
            return $challenge;
        }
        throw new Custom('Challenge not found', '403');
    }
    
    /**
     * @param $request
     * @param $user_id
     * @return Challenge
     * @throws Custom
     */
    public function create($request, $user_id)
    {
        if ($request->user()->id != $user_id) {
            $challenge           = new Challenge();
            $challenge->user_one = $request->user()->id;
            $challenge->user_two = $user_id;
            $challenge->save();
            
            return $challenge;
        }
        throw new Custom('You cannot play with yourself.', '403');
    }
    
    /**
     * @param $challenge_id
     * @param $user_id
     * @return Game
     * @throws Custom
     */
    public function accept($challenge_id, $user_id)
    {
        $challenge = Challenge::where('id', $challenge_id)->where('user_two', $user_id)->first();
        if ($challenge) {
            if ($challenge->user_two != auth()->user()->id) {
                throw new Custom('User two needs to accept challenge.', '403');
            }
            
            if ($challenge->user_two_accepted == 1) {
                throw new Custom('You already accepted challenge.', '403');
                
            }
            
            $challenge->update([
                'user_two_accepted' => 1
            ]);
            
            $gs = new GameService();
            
            $game = $gs->create($challenge_id);
            
            return $game;
        }
        throw new Custom('Challenge not found.', '403');
    }
}