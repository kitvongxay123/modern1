<?php

namespace App\Http\Livewire\Admin\Users;


use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use App\Models\User;

class ListUsers extends Component
{
    public $state = [];

    public  $user;
    public $name;
    public $email;
    public $phone;

    public $showEditModal = false;

    public $userIdBeingRemoval = null;

    public function addNew()
    {
        $this->state = [];

        // $this->name ='';
        // $this->email ='';
        // $this->phone ='';

        $this->showEditModal = true;

        $this->dispatchBrowserEvent('show-form');
    }

    public function updateUser()
    {
        $validatedData = Validator::make($this->state, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$this->user->id,
            'password' =>  'sometimes|confirmed',
        ])->validate();

        if(!empty($validatedData['password']))
        {
            $validatedData['password'] = bcrypt($validatedData['password']);
        }

        $this->user->update($validatedData);

        $this->dispatchBrowserEvent('hide-form',['message'=> 'User added successfully!']);


    }
    public function createUser()
    {
        $validatedData = Validator::make($this->state, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' =>  'required|confirmed',
        ])->validate();

        $validatedData['password'] = bcrypt($validatedData['password']);

        User::create($validatedData);

        // session()->flash('message','User added successfully!');

        $this->dispatchBrowserEvent('hide-form',['message'=> 'User added successfully!']);

        return redirect()->back();

    }

    public function edit(User $user)
    {
        $this->showEditModal = true;

        $this->user =$user;
        $this->state = $user->toArray();

        $this->dispatchBrowserEvent('show-form');
    }

    public function confirmUserRemoval($userId)
    {
        $this->userIdBeingRemoval = $userId;

        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function deleteUser()
    {
        $user = User::findOrFail($this->userIdBeingRemoval);

        $user->delete();

        $this->dispatchBrowserEvent('hide-delete-modal',['message' => 'User deleted
        successfully!']);
    }
    public function render()
    {
        $users = User::latest()->paginate();
        return view('livewire.admin.users.list-users',[
            'users' => $users,
        ]);
    }


}
