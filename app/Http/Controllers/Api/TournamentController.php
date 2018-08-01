<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Class TournamentController
 * @package App\Http\Controllers\Api
 */
class TournamentController extends Controller
{
    /**
     * @param Request $request
     * @param $tournamentId
     * @return mixed
     * @throws \App\Exceptions\Custom
     */
    public function join(Request $request, $tournamentId)
    {
        $tournament = $this->TournamentService()->join($request, $tournamentId);
        
        return $tournament;
    }
}
