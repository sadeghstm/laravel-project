<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
class UserController extends Controller
{
    //
    private function getUsers()
    {
        $path = storage_path('app/users.json');

        if (!File::exists($path)) {
            return [];
        }
        $content = File::get($path);
        $users = json_decode($content, true);
        if (json_last_error() !== JSON_ERROR_NONE || !is_array($users)) {
            return [];
        }

        return $users;
    }




    public function index()
    {
        $users = $this->getUsers();
        return view('users.index', ['users' => $users]);
    }
    public function create()
    {
        return view('users.form');
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255'
            ]
        );

        $users = $this->getUsers();

        $newUser = [
            'id' => count($users) > 0 ? max(array_column($users, 'id')) + 1 : 1,
            'name' => $request->input('name'),
            'email' => $request->input('email')
        ];

        $users[] = $newUser;
        $this->saveUsers($users);

        return Redirect::route('users.index');
    }
    public function show($id)
    {
        $users = $this->getUsers();

        $user = collect($users)->firstWhere('id', $id);
        // dd($user);

        if (!$user) {
            abort(404);
        }
        return view('users.show', ['user' => $user]);
    }



    public function edit($id)
    {
        $users = $this->getUsers();

        $user = collect($users)->firstWhere('id', $id);

        if (!$user) {
            abort(404);
        }

        return view('users.form', ['user' => $user]);
    }



    public function update(Request $request, $id)
    {
        $users = $this->getUsers();


        $userindex = 0;
        $isuserExists = false;
        // $userindex=collect($users)->search(fn($user)=>$user['id']==$id);
        foreach ($users as $key => $user) {
            if ($user['id'] == $id) {
                $userindex = $key;
                $isuserExists = true;
                break;
            }
        }

        if ($isuserExists == false) {
            abort(404);
        }

        $users[$userindex]['name'] = $request->input('name');
        $users[$userindex]['email'] = $request->input('email');

        $this->saveUsers($users);

        return Redirect::route('users.index');
    }




    public function destroy($id)
    {
        $users = $this->getUsers();

        //$userindex=collect($users)->search(fn($user)=>$user['id']==$id);
        $userindex = 0;
        $isuserExists = false;
        foreach ($users as $key => $user) {
            if ($user['id'] == $id) {
                $userindex = $key;
                $isuserExists = true;
                break;
            }
        }
        //dd($userindex);
        if ($isuserExists == false) {
            abort(404);
        }
        unset($users[$userindex]);

        $this->saveUsers($users);

        return Redirect::route('users.index');
    }
    private function saveUsers($users)
    {

        $path = storage_path('app/users.json');
        $content = json_encode($users, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        File::put($path, $content);
    }


}
