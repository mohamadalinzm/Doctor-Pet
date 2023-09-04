<?php

namespace MedicalCenter\Repository;

use MedicalCenter\Models\MedicalCenterType;
use MedicalCenter\Repository\Contracts\MedicalCenterTypeRepository;

class EloquentMedicalCenterTypeRepository implements MedicalCenterTypeRepository
{


    public function show(MedicalCenterType $type): MedicalCenterType
    {
        return $type;
    }


    public function index($searchTerm = '', $active = null)
    {
        return MedicalCenterType::search($searchTerm)
            ->paginate(20);
    }


    public function delete(MedicalCenterType $type)
    {
        $type->delete();
    }

    public function store($data): MedicalCenterType
    {
        if ($data['image'] != null) {
            $file = $data['image'];
            $fileName = rand() . "_" . $file->getClientOriginalName();
            $file->move('uploads/type/', $fileName);
            $filePath = 'uploads/type/'.$fileName;
        } else {
            $filePath = 'default.png';
        }

        $type = MedicalCenterType::query()->create([
            'name' => $data['name'],
            'image' => $filePath,
        ]);

        return $type;
    }

    public function update(MedicalCenterType $type, $data)
    {
        if ($data['image'] != null) {
            $file = $data['image'];
            $fileName = rand() . "_" . $file->getClientOriginalName();
            $file->move('uploads/type/', $fileName);
            $filePath = 'uploads/type/'.$fileName;
        } else {
            $filePath = 'default.png';
        }

        $type->update([
            'name' => $data['name'],
            'image' => $filePath,
        ]);

        return $type;
    }

}
