<?php

namespace Specialty\Repository;

use Specialty\Models\Specialty;
use Morilog\Jalali\Jalalian;
use Specialty\Repository\Contracts\SpecialtyRepository;

class EloquentSpecialtyRepository implements SpecialtyRepository
{


    public function show(Specialty $specialty)
    {
        return $specialty->select(['id' , 'image' , 'name'])
            ->get()
            ->each(function ($item) {
                $item->date = Jalalian::forge(strtotime($item->created_at))->format('Y/m/d ');
            });
    }


    public function index($searchTerm = '', $active = null)
    {
        return Specialty::select(['id', 'name','image'])
            ->search($searchTerm)->get()
            ->each(function ($item) {
                $item->date = Jalalian::forge(strtotime($item->created_at))->format('Y/m/d ');
            });
    }


    public function delete(Specialty $specialty)
    {
        $specialty->delete();
    }

    public function store($data): Specialty
    {

        if ($data['image'] != null) {
            $file = $data['image'];
            $fileName = rand() . "_" . $file->getClientOriginalName();
            $file->move('uploads/specialty/', $fileName);
            $filePath = 'uploads/specialty/'.$fileName;
        } else {
            $filePath = 'default.png';
        }

        $specialty = Specialty::query()->create([
            'name' => $data['name'],
            'image' => $filePath,
        ]);


        return $specialty;
    }

    public function update(Specialty $specialty, $data)
    {

        if ($data['image'] != null) {
            $file = $data['image'];
            $fileName = rand() . "_" . $file->getClientOriginalName();
            $file->move('uploads/specialty/', $fileName);
            $filePath = 'uploads/specialty/'.$fileName;
        } else {
            $filePath = 'default.png';
        }


        $specialty->update([
            'name' => $data['name'],
            'image' => $filePath,
        ]);

        return $specialty;
    }

}
