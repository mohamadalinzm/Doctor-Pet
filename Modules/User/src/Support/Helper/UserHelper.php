<?php

namespace User\Support\Helper;

class UserHelper
{
    public static function getUserData($data): array
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

    public static function getDoctorData($data): array
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