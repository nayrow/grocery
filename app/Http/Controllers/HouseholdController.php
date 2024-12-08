<?php

namespace App\Http\Controllers;

use App\Models\Household;
use App\Models\HouseholdInvitation;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HouseholdController extends Controller
{
    public function show()
    {

    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255'
        ]);
        $household = Household::create([
            'name' => $request->name,
            'user_id' => Auth::user()->id
        ]);

        Auth::user()->update([
            'household_id' => $household->id
        ]);

        return redirect()->route('profile')->with('success', 'You have successfully create your household, you can now invite house members to it');
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, Household $household)
    {
        $request->validate([
            'name' => 'required|max:255'
        ]);

        $household->update([
            'name' => $request->name
        ]);

        return redirect()->route('profile')->with('success', 'Household name changed successfully');
    }

    public function acceptInvitation(Request $request, Household $household, User $user): RedirectResponse
    {
        $invitation = HouseholdInvitation::where('household_id', $household->id)->where('status', 'pending')->where('user_id', $user->id)->first();
        if ($invitation) {
            $invitation->update([
                'status' => 'accepted'
            ]);
            $user->update([
                'household_id' => $household->id
            ]);
            HouseholdInvitation::where('user_id', $user->id)
                ->where('status', 'pending')
                ->where('id', '!=', $invitation->id)
                ->update([
                    'status' => 'cancelled'
                ]);
            return redirect()->route('profile')->with('success', "You have successfully joined {{$household->name}}");
        } else {
            return redirect()->route('profile')->with('error', "This isn't a valid invitation");
        }
    }

    public function rejectInvitation(Request $request, Household $household, User $user): RedirectResponse
    {
        $invitation = HouseholdInvitation::where('household_id', $household->id)->where('status', 'pending')->where('user_id', $user->id)->first();
        if ($invitation) {
            $invitation->update([
                'status' => 'cancelled'
            ]);
            return redirect()->route('profile')->with('success', "You have successfully cancelled the invitation from {{$household->name}}");
        } else {
            return redirect()->route('profile')->with('error', "This isn't a valid invitation");
        }
    }


    public function destroy(string $id)
    {
        //
    }
}
