<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 24.7.18.
 * Time: 09.28
 */

namespace App\Transformers;

use App\Challenge;
use App\Game;

/**
 * Class GameTransformer
 * @package App\Transformers
 */
class GameTransformer extends \League\Fractal\TransformerAbstract
{
    /**
     * @var array
     */
    protected $availableIncludes = [
        'takes',
        'winners',
        'challenge',
    ];
    
    /**
     * @param Game $game
     * @return array
     */
    public function transform(Game $game)
    {
        return [
            'id'      => $game->id,
            'started' => $game->started,
        ];
    }
    
    /**
     * @param Game $game
     * @return \League\Fractal\Resource\Collection
     */
    public function includeTakes(Game $game)
    {
        return $this->collection($game->takes, new TakesTransformer());
    }
    
    /**
     * @param Game $game
     * @return \League\Fractal\Resource\Item
     */
    public function includeWinners(Game $game)
    {
        return $this->item($game->winners, new WinnerTransformer());
    }
    
    /**
     * @param Game $game
     * @return \League\Fractal\Resource\Item
     */
    public function includeChallenge(Game $game)
    {
        return $this->item($game->challenge, new ChallengeTransformer());
    }
}