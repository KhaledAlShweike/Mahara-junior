<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Pending_TeamtoTeam_matching;
use App\Models\Reservation;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TeamToTeamMatching extends Controller
{
    public function TeamtoteamMatching(Request $request)
    {
        // Validation 
        $this->validateRequest($request);

        $startTime = $request->input('start_time');
        $endTime = $request->input('end_time');
        $team1Id = $request->input('team1_id');
        $team2Id = $request->input('team2_id');
        $location = $request->input('location');
        $sportType = $request->input('sport_type');

        // Search for available reservations within the specified time range
        $availableReservations = Reservation::where(function ($query) use ($startTime, $endTime) {
            $query->where(function ($subQuery) use ($startTime, $endTime) {
                $subQuery->where('start_time', '>=', $startTime)
                    ->orWhere('end_time', '<=', $endTime);
            })->orWhere(function ($subQuery) use ($startTime, $endTime) {
                $subQuery->where('start_time', '<=', $startTime)
                    ->where('end_time', '>=', $endTime);
            });
        })->doesntHave('Pending_TeamtoTeam_matchings')->doesntHave('Team_to_Team_matching')->get();

        // Perform team matching logic based on available reservations
        foreach ($availableReservations as $reservation) {
            $matchingCriteria = [
                'team1_id' => $team1Id,
                'team2_id' => $team2Id,
                'location' => $location,
                'sport_type' => $sportType,
                'start_time' => $startTime,
                'end_time' => $endTime,
            ];

            // Check if teams match and add to pending team to team matching
            if ($this->checkTeamsMatch($matchingCriteria)) {
                $pendingMatching = Pending_TeamtoTeam_matching::create($matchingCriteria);

                return response()->json([
                    'message' => 'Matching process created successfully',
                    'teams' => [
                        'team1_id' => $matchingCriteria['team1_id'],
                        'team2_id' => $matchingCriteria['team2_id'],
                    ],
                    'reservation' => [
                        'start_time' => $reservation->start_time,
                        'end_time' => $reservation->end_time,
                        'club_id' => $reservation->club_id,
                        'name' => $reservation->club_name,
                        'address' => $reservation->address,
                        'stadium_id' => $reservation->stadium_id,
                        'sport_type' => $reservation->sport_type,
                    ],
                    'pending_matching_id' => $pendingMatching->id,
                ], 200);
            }
        }

        return response()->json(['message' => 'No matching process created'], 404);
    }

    private function checkTeamsMatch($criteria)
    {
        // Retrieve team information based on criteria
        $team1 = Team::find($criteria['team1_id']);
        $team2 = Team::find($criteria['team2_id']);

        // Check if teams exist
        if (!$team1 || !$team2) {
            return false;
        }

        // Check if teams have the same location and sport type
        return (
            $team1->location === $criteria['location'] &&
            $team1->sport_type === $criteria['sport_type'] &&
            $team2->location === $criteria['location'] &&
            $team2->sport_type === $criteria['sport_type']
        );
    }
}