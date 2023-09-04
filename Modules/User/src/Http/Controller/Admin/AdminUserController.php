<?php

namespace User\Http\Controller\Admin;

use Illuminate\Http\Request;
use User\Foundation\Service\UserService;

class AdminUserController
{
    public $service;

    public function __construct()
    {
        $this->service = (new UserService());
    }

    public function store(Request $request)
    {
        // 1 - Validate Inputs
        $this->service->validation()->admin()->store($request);


        // 2 - Store User
        $user = $this->service->store($request->all());


        // 3 - Attach Role
        $user->assignRole('doctor');


        // 4 - Run Event User Store
        $this->service->event()->admin()->create($user);


        // 5 - Return Message Result Base On Json & Web
        return $this->service->response()->admin()->UserStoredSuccess($user);
    }

    public function update(Request $request,$id)
    {

        // 1 - Validate Inputs
        $this->service->validation()->admin()->store($request);

        // 2 - Fetch User Existent
        $user = $this->service->fetch($id);

        // 3 - Update User Data
        $this->service->update($request->all(),$user);

        // 4 - Sync Role
        $user->assignRole('doctor');

        // 5 - Run Event Update User
        $this->service->event()->admin()->update($user);

        // 6 - Return Message Result Base On Json & Web
        $this->service->response()->admin()->UserUpdatedSuccess();
    }

    public function delete($id)
    {
        // 1 - fetch User
        $user = $this->service->fetch($id);

        // 2 - Delete User
        $this->service->delete($user);

        // 3 - Run Event Delete User
        $this->service->event()->admin()->delete($user);

        // 4 - Return Message Result Base On Json & Web
        return $this->service->response()->admin()->UserDeletedSuccess();
    }

    public function show($id)
    {
        $appends = ['role:id,name'];

        // 2 - Get Information That Need To Existed
        $user = $this->service->fetch($id, $appends);

        // 3 - Return Message Result Base On Json & Web
        return $this->service->transformers()->admin()->show($user);
    }

    public function list()
    {
        // 1 - Fetch List Of Users Considering Filters
        $users = $this->service->list(25);

        // 2 - Return List Base On Json Or Web Page
        return $this->service->response()->admin()->UserList($users);
    }
}


