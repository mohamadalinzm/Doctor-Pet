<?php

namespace Animal\Service\Action;

use Animal\AnimalInterface;
use Animal\Foundation\Abstraction\AnimalAbstract;
use Animal\Model\Animal;
use Illuminate\Support\Facades\Storage;

class AnimalActionService extends AnimalAbstract
{

    // Save An Animal
    public function store(array $data)
    {
        return $this->repository()->store($data);
    }

    // Save An Animal
    public function upload($photo)
    {
        if (isset($photo)) {
            return Storage::url($photo->store('photos/animal', 'public'));
        }

        return null;
    }

    public function deletePhoto($photo)
    {
        return Storage::disk('public')->delete($photo);
    }

    // Update And Animal
    public function update(array $data, int $AnimalId)
    {
        return $this->repository()->update($data, $AnimalId);
    }

    // handle image uploading
    public function handleImageUpdating($Animal, $photo)
    {
        if ($photo !== null) {
            $photo = $this->SyncPhoto($Animal, $photo);
        } elseif ($photo == 'Deleted') {
            $this->action()->deletePhoto($Animal->image);
            $photo = null;
        }

        return $photo;
    }

    // Delete And Animal
    public function delete(int $AnimalId)
    {
        $animal = $this->fetch($AnimalId);
        $this->action()->deletePhoto($animal->image);
        $this->repository()->delete($AnimalId);
    }

    // List Animals
    public function list(array $appends, array $filters, int $limit, array $select = null)
    {
        return $this->repository()->list($appends, $filters, $select, $limit);
    }

    // Fetch Animal
    public function fetch(int $id, array $appends = [], array $select = [])
    {
        $result = $this->repository()->fetch($id, $appends, $select);
        if (! $result) {
            $this->response()->AnimalNotFound();
        }

        return $result;
    }

    // Restore Animal
    public function restore(int $id)
    {
        return $this->repository()->restore($id);
    }

    // Force Delete An Animal
    public function forceDelete(int $id)
    {
        return $this->repository()->forceDelete($id);
    }

    // Check Is Animal Existed Or Not
    public function exist($id)
    {
        $result = $this->repository()->exists($id);
        if (! $result) {
            $this->response()->AnimalNotFound();
        }

        return $result;
    }

    // Sync Photos In Image
    private function SyncPhoto($Animal, $photo): ?string
    {
        if ($Animal->image) {
            $this->action()->deletePhoto($Animal->image);
        }

        return $this->action()->upload($photo);
    }

}
