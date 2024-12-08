<?php

namespace App\Livewire;

use App\Models\HouseholdInvitation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class InviteModal extends Component
{
    public string $query = '';
    public array $available_users = [];

    public array $queryString = ['query' => ['except' => '']];

    public function updatedQuery()
    {
        $this->available_users = $this->searchUsers()->toArray();
    }

    public function searchUsers()
    {
        return User::where('household_id', null)
            ->where('email', 'like', '%' . $this->query . '%')
            ->whereDoesntHave('invitations', function ($query) {
                $query->where('household_id', auth()->user()->household_id)
                    ->where('status', 'pending');
            })
            ->take(5)
            ->get();
    }

    public function sendInvitation(int $user_id)
    {
        $user = User::find($user_id);
        HouseholdInvitation::create([
            'household_id' => Auth::user()->household->id,
            'user_id' => $user->id,
            'status'=>'pending'
        ]);
        return redirect()->route('profile')->with('success','Invitation sent successfully');
    }

    public function render()
    {
        return view('livewire.invite-modal',[
            'available_users' => $this->available_users,
        ]);
    }
}
