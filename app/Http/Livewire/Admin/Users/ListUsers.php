<?php

namespace App\Http\Livewire\Admin\Users;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class ListUsers extends AdminComponent
{
    public $state = [];
    public $user;
    public $user_id;
    public $show_edit_modal = false;

    public function add_user()
    {
        $this->state = [];
        $this->dispatchBrowserEvent('show-form');
    }

    public function create_user()
    {
        $validate_data = Validator::make($this->state, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ])->validate();

        /*$validate_data['password'] = bcrypt($validate_data['password']);
        $user = User::create($validate_data);*/

        $user = User::create([
            'name' => $this->state['name'],
            'email' => $this->state['email'],
            'password' => bcrypt($this->state['password']),
        ]);

        $this->dispatchBrowserEvent('hide-form', ['message' => 'User added successfully!']);

        return redirect()->back();
    }

    public function update_user()
    {
        $validate_data = Validator::make($this->state, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->user->id,
            'password' => 'sometimes|confirmed',
        ])->validate();

        if (!empty($this->state['password'])) {
            $validate_data['password'] = bcrypt($this->state['password']);
        }

        $this->user->update($validate_data);

        $this->dispatchBrowserEvent('hide-form', ['message' => 'User added successfully!']);

        return redirect()->back();
    }

    public function edit(User $user)
    {
        $this->show_edit_modal = true;
        $this->user = $user;
        $this->state = $user->toArray();
        $this->dispatchBrowserEvent('show-form');
    }

    public function destroy($user_id)
    {
        $this->user_id = $user_id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function render()
    {
        $users = User::latest()->paginate(5);
        return view('livewire.admin.users.list-users', [
            'users' => $users
        ]);
    }
}