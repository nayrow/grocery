<?php

namespace App\Livewire;

use App\Models\Household;
use App\Models\User;
use Livewire\Component;

class MembersList extends Component
{
    public $users;
    public $auth_user;
    public $current_userId;
    public Household $household;

    public function mount(array $users, array $auth_user, Household $household)
    {
        $this->users = $users;
        $this->auth_user = $auth_user;
        $this->household = $household;
    }
    public function removeUser(int $id)
    {
        dd($id);
        $user = User::find($id);
        if($this->household->user_id!==$this->auth_user['id']){
            return redirect()->route('profile')->with('error', 'You are not the owner of the household');
        }
        if($user->id === $this->auth_user['id']){
            return redirect()->route('profile')->with('error', 'You cannot remove yourself from the household');
        }
        if($user->household_id === null){
            return redirect()->route('profile')->with('error', 'Invalid User');
        }
        if($user->household_id !== $this->household->id){
            return redirect()->route('profile')->with('error', 'User does not belong to this household');
        }
        $user->update([
            'household_id' => null
        ]);
        $this->users = $this->users->filter(function ($user) use ($id) {
            return $user['id'] !== $id;
        });
    }


    public function render()
    {
        return view('livewire.members-list',[
            'users' => $this->users,
            'auth_user' => $this->auth_user,
            'current_userId'=>$this->current_userId
        ]);
    }
}
