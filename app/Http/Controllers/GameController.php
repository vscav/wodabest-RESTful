<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image as Image;
use App\Game as Game;
use App\Category as Category;
use Illuminate\Support\Facades\DB as DB;

class GameController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Retrieve all games from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try
        {
            $games = Game::all();
        
            return response()->json($games);
        }
        catch(\Exception $e)
        {
            echo $e->getMessage();
        }
    }

    /**
     * Retrieve players for the next game.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function init(Request $request)
    {
        try
        {
            $limit = 2;
            if($request->category && $request->category !== "all")
            {
                $category_id =  Category::where('slug', $request->category)->select('id')->first()['id'];
                $players = Image::where('category_id', $category_id)->inRandomOrder()->take($limit)->get();
            }
            else
            {
                $players = Image::inRandomOrder()->take($limit)->get();
            }

            return response()->json($players);
        }
        catch(\Exception $e)
        {
            echo $e->getMessage();
        }
    }

    /**
     * Update the specified players in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try
        {
            $winner = Image::where('id', '=', $request->winner)->first();
            $loser = Image::where('id', '=', $request->loser)->first();
            //$category = $request->category;

            $wins = $winner->wins + 1;

            $winner_expected_score = Game::expected($loser->score, $winner->score);
            $winner_new_score = Game::win($winner->score, $winner_expected_score);

            $winner_rank = Game::rank($winner_new_score, $wins, $winner->wins);

            $winner->update([
                'score' => $winner_new_score,
                'wins' => $wins,
                'rank' => $winner_rank,
            ]);

            $losses = $loser->losses + 1;

            $loser_expected_score = Game::expected($winner->score, $loser->score);
            $loser_new_score = Game::win($loser->score, $loser_expected_score);

            $loser_rank = Game::rank($loser_new_score, $losses, $loser->wins);

            $loser->update([
                'score' => $loser_new_score,
                'losses' => $losses,
                'rank' => $loser_rank,
            ]);

            $game = Game::create([
                'winner' => $request->winner,
                'loser' => $request->loser
            ]);

            $players = [$winner, $loser];

            return response()->json($players, 201);
        }
        catch(\Exception $e)
        {
            echo $e->getMessage();
        }
    }
}
