<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 30.7.18.
 * Time: 11.58
 */

namespace App\Services;

use App\Exceptions\Custom;
use App\Tournament;

class TournamentService
{
    /**
     * @param $request
     * @param $tournamentId
     * @return mixed
     * @throws Custom
     */
    public function join($request, $tournamentId)
    {
        $tournament = Tournament::find($tournamentId);
        if ($tournament) {
            if ($request->user()->canJoin($tournamentId)) {
               $tournament->users()->attach(['tournament_id' => $tournamentId], ['user_id' => auth()->user()->id]);
            }
            return $tournament->users()->latest()->first();
        }
        throw new Custom('Tournament not found.', '403');
    }
}