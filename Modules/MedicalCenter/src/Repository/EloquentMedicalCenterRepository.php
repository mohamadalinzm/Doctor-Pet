<?php

namespace MedicalCenter\Repository;

use Address\Foundation\Service\AddressService;
use MedicalCenter\Models\MedicalCenter;
use MedicalCenter\Repository\Contracts\MedicalCenterRepository;
use Morilog\Jalali\Jalalian;
use User\Model\User;

class EloquentMedicalCenterRepository implements MedicalCenterRepository
{

    public $serviceAddress;

    public function __construct()
    {
        $this->serviceAddress = (new AddressService);
    }


    public function show(MedicalCenter $medicalCenter)
    {
        return $medicalCenter->select(['id' , 'image' , 'certificate' , 'name', 'slug' , 'status'])
            ->with(['addresses','owner','services','type'])
            ->get()
            ->each(function ($item) {
                $item->date = Jalalian::forge(strtotime($item->created_at))->format('Y/m/d ');
            });
    }


    public function index($searchTerm = '', $active = null)
    {
        return MedicalCenter::select(['id', 'name','status'])
            ->with(['addresses','owner','services','type'])
            ->search($searchTerm)->get()
            ->each(function ($item) {
                $item->date = Jalalian::forge(strtotime($item->created_at))->format('Y/m/d ');
            });
    }


    public function delete(MedicalCenter $medicalCenter)
    {
        $medicalCenter->delete();
    }

    public function store($data): MedicalCenter
    {

        if ($data['image'] != null) {
            $file = $data['image'];
            $fileName = rand() . "_" . $file->getClientOriginalName();
            $file->move('uploads/medicalCenter/', $fileName);
            $filePath = 'uploads/medicalCenter/'.$fileName;
        } else {
            $filePath = 'default.png';
        }

        if ($data['certificate'] != null) {
            $certificate = $data['certificate'];
            $certificateName = rand() . "_" . $certificate->getClientOriginalName();
            $certificate->move('uploads/medicalCenter/', $certificateName);
            $certificatePath = 'uploads/medicalCenter/'.$certificateName;
        } else {
            $certificatePath = 'defaultCertificate.png';
        }

        $owner = User::firstOrCreate([
            'mobile' => $data['mobile'],
        ]);

        $medicalCenter = MedicalCenter::query()->create([
            'type_id' => $data['type_id'],
            'owner_id' => $owner->id,
            'name' => $data['brand'],
            'phone' => $data['name'],
            'on_site_visit' => $data['on_site_visit'],
            'image' => $filePath,
            'certificate' => $certificatePath,
            'status' => $data['status'],
        ]);

        $this->serviceAddress->action()->store([
            'city_id' => $data['city_id'],
            'state_id' => $data['state_id'],
            'address' => $data['address'],
            ], $medicalCenter);

        if (isset($data['services'])) {
            $medicalCenter->services()->sync($data['services']);
        }

        return $medicalCenter;
    }

    public function update(MedicalCenter $medicalCenter, $data)
    {

        if ($data['image'] != null) {
            $file = $data['image'];
            $fileName = rand() . "_" . $file->getClientOriginalName();
            $file->move('uploads/medicalCenter/', $fileName);
            $filePath = 'uploads/medicalCenter/'.$fileName;
        } else {
            $filePath = 'default.png';
        }

        if ($data['certificate'] != null) {
            $certificate = $data['certificate'];
            $certificateName = rand() . "_" . $certificate->getClientOriginalName();
            $certificate->move('uploads/medicalCenter/', $certificateName);
            $certificatePath = 'uploads/medicalCenter/'.$certificateName;
        } else {
            $certificatePath = 'defaultCertificate.png';
        }

        $owner = User::firstOrCreate([
            'mobile' => $data['mobile'],
        ]);

        $medicalCenter->update([
            'type_id' => $data['type_id'],
            'owner_id' => $owner->id,
            'name' => $data['brand'],
            'phone' => $data['name'],
            'on_site_visit' => $data['on_site_visit'],
            'image' => $filePath,
            'certificate' => $certificatePath,
            'status' => $data['status'],
        ]);

        $address = $medicalCenter->addresses()->latest()->first();

        $this->serviceAddress->action()->store([
            'city_id' => $data['city_id'],
            'state_id' => $data['state_id'],
            'address' => $data['address'],
        ], $address->id);

        if (isset($data['services'])) {
            $medicalCenter->services()->sync($data['services']);
        }

        return $medicalCenter;
    }

}
