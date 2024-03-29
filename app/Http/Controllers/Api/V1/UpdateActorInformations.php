<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\ActorPersonalInfos;
use App\Models\SportType;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UpdateActorInformations extends Controller
{
    public function changePassword(Request $request)
    {
        try {
            $request->validate([
                'current_password' => 'required|string',
                'new_password' => 'required|string|min:8',
                'confirm_password' => 'required|string|same:new_password',
            ]);

            $actor = auth()->user();

            if (!Hash::check($request->current_password, $actor->password)) {
                return response()->json(['status' => 1, 'message' => 'Current password is incorrect']);
            }

            $actor->update([
                'password' => Hash::make($request->new_password),
            ]);

            return response()->json(['status' => 0, 'message' => 'Password changed successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => 1, 'message' => 'Failed to change password', 'error' => $e->getMessage()]);
        }
    }
    public function changeFirstName(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:ActorPersonalInfos,id',
            'new_first_name' => 'required|string',
        ]);

        $actor = ActorPersonalInfos::findOrFail($request->input('id'));
        $actor->first_name = $request->input('new_first_name');
        $actor->save();

        return response()->json(['message' => 'First name changed successfully']);
    }

    public function changeLastName(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:ActorPersonalInfos,id',
            'new_last_name' => 'required|string',
        ]);

        $actor = ActorPersonalInfos::findOrFail($request->input('id'));
        $actor->last_name = $request->input('new_last_name');
        $actor->save();

        return response()->json(['message' => 'Last name changed successfully']);
    }

    public function changeEmail(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:ActorPersonalInfos,id',
            'new_email' => 'required|email|unique:ActorPersonalInfos,email',
        ]);

        $actor = ActorPersonalInfos::findOrFail($request->input('id'));
        $actor->email = $request->input('new_email');
        $actor->save();

        return response()->json(['message' => 'Email changed successfully']);
    }

    public function changeBirthdate(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:ActorPersonalInfos,id',
            'new_birthdate' => 'required|date',
        ]);

        $actor = ActorPersonalInfos::findOrFail($request->input('id'));
        $actor->b_date = $request->input('new_birthdate');
        $actor->save();

        return response()->json(['message' => 'Birthdate changed successfully']);
    }

    public function createTeam(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:ActorPersonalInfos,id',
            'team_name' => 'required|string|unique:teams,name',
            'SportType' => 'required|string|exists:SportType,name',
        ]);

        
        // Create a new team
        $team = Team::create(['name' => $request->input('team_name'),'SportType' => $request->input('SportType')]);

        // Make the actor the captain of the newly created team
        $actor = ActorPersonalInfos::findOrFail($request->input('id'));
        $actor->update(['id' => $team->id, 'Captain' => true]);

        return response()->json(['message' => 'Team created, and actor made captain successfully']);
    }
}
