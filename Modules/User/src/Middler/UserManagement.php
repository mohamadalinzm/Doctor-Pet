<?php

namespace User\Middler;

use User\Support\Enum\Gender;
use User\Support\Enum\Role;
use User\Support\Enum\Scope;
use Address\Support\Enum\Status;
use User\UserInterface;

class UserManagement implements UserInterface
{

    public function __construct()
    {

    }

    public function store($data)
    {
        $UserData = $this->getUserData($data);
        $user = $this->UserRepository->save($UserData);

        if ($data['scope'] == Scope::EMPLOYEE) {
            $EmployeeData = $this->getEmployeeData($data);
            $this->EmployeeRepository->save($user, $EmployeeData);
        }

        return $user;
    }

    public function update($data, $user)
    {
        return $this->UserRepository->update($data, $user);
    }

    public function delete($user)
    {
        return $this->UserRepository->delete($user);
    }

    public function list($appends = [])
    {
        return $this->UserRepository->list($this->limit,$appends);
    }

    public function fetch(int $id, $append = [])
    {
        $user = $this->UserRepository->fetch($id, $append);
        if (! $user) {
            $this->responder->UserNotFound();
        }

        return $user;
    }

    public function information(): array
    {
        // Roles
        $roles = Role::systemRole();

        // Gender
        $genders = Gender::getAsArray();


        // Status
        $statuses = Status::getAsArray();


        // Type
        $scopes = Scope::getAsArray();


        return [
            'roles' => $roles,
            'genders' => $genders,
            'statuses' => $statuses,
            'scopes' => $scopes,
        ];
    }

    public function show($user)
    {

    }

    //-----------------------------------------------------------//

    private function getUserData(array $data): array
    {
        return [
            'name' => $data['name'],
            'email' => $data['email'],
            'country_code' => $data['country_code'],
            'mobile' => $data['mobile'],
            'gender' => $data['gender'],
            'image' => $data['image'] ?? 'default.png',
            'scope' => $data['scope'],
            'role_id' => $data['role_id'],
        ];
    }

    private function getEmployeeData(array $data): array
    {
        return [
            'job_title' => $data['job_title'],
            'department_id' => $data['department_id'],
            'salary' => $data['salary'] ?? null,
            'start_date' => $data['start_date'] ?? null,
            'end_date' => $data['end_date'] ?? null,
        ];
    }

}
