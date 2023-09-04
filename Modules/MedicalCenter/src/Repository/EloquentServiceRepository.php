<?php

namespace MedicalCenter\Repository;

use MedicalCenter\Models\Service;
use MedicalCenter\Repository\Contracts\ServiceRepository;

class EloquentServiceRepository implements ServiceRepository
{


    public function show(Service $service): Service
    {
        return $service;
    }


    public function index($searchTerm = '', $active = null)
    {
        return Service::search($searchTerm)
            ->paginate(20);
    }


    public function delete(Service $service)
    {
        $service->delete();
    }

    public function store($data): Service
    {

        if ($data['image'] != null) {
            $file = $data['image'];
            $fileName = rand() . "_" . $file->getClientOriginalName();
            $file->move('uploads/service/', $fileName);
            $filePath = 'uploads/service/'.$fileName;
        } else {
            $filePath = 'default.png';
        }

        $service = Service::query()->create([
            'name' => $data['name'],
            'image' => $filePath,
        ]);

        return $service;
    }

    public function update(Service $service, $data)
    {
        if ($data['image'] != null) {
            $file = $data['image'];
            $fileName = rand() . "_" . $file->getClientOriginalName();
            $file->move('uploads/service/', $fileName);
            $filePath = 'uploads/service/'.$fileName;
        } else {
            $filePath = 'default.png';
        }

        $service->update([
            'name' => $data['name'],
            'image' => $filePath,
        ]);

        return $service;

    }

}
