<?php

namespace Pet\Service\Action;

use Illuminate\Support\Facades\Storage;
use Pet\PetInterface;
use Pet\Foundation\Abstraction\PetAbstract;
use Pet\Model\Pet;

class PetActionService extends PetAbstract
{

    // handle image uploading
    public function handleImageUpdating($Pet, $photo)
    {
        if ($photo !== null) {
            $photo = $this->SyncPhoto($Pet, $photo);
        } elseif ($photo == 'Deleted') {
            $this->action()->deletePhoto($Pet->avatar);
            $photo = null;
        }

        return $photo;
    }

    // Sync Photos In Image
    private function SyncPhoto($Pet, $photo): ?string
    {
        if ($Pet->avatar) {
            $this->action()->deletePhoto($Pet->avatar);
        }

        return $this->action()->upload($photo);
    }

    // Save An Animal
    public function upload($photo)
    {
        if (isset($photo)) {
            return Storage::url($photo->store('photos/pet', 'public'));
        }

        return null;
    }

    public function deletePhoto($photo)
    {
        return Storage::disk('public')->delete($photo);
    }

    // Save An Pet
    public function store(array $data)
    {
        return $this->repository()->store($data);
    }

    // Update And Pet
    public function update(array $data, int $PetId)
    {
        return $this->repository()->update($data, $PetId);
    }

    // Delete And Pet
    public function delete(int $PetId)
    {
        return $this->repository()->delete($PetId);
    }

    // List Pets
    public function list(array $appends, array $filters, int $limit, array $select = null, $userId = null)
    {
        return $this->repository()->list($appends, $filters, $select, $limit, $userId);
    }

    // Fetch Pet
    public function fetch(int $id, array $appends = [], array $select = [])
    {
        $result = $this->repository()->fetch($id, $appends, $select);
        if (! $result) {
            $this->response()->PetNotFound();
        }

        return $result;
    }

    // Restore Pet
    public function restore(int $id)
    {
        return $this->repository()->restore($id);
    }

    // Force Delete An Pet
    public function forceDelete(int $id)
    {
        return $this->repository()->forceDelete($id);
    }

    // Check Is Pet Existed Or Not
    public function exist($id)
    {
        $result = $this->repository()->exists($id);
        if (! $result) {
            $this->response()->PetNotFound();
        }

        return $result;
    }

}
