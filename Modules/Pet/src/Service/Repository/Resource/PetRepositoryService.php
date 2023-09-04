<?php

namespace Pet\Service\Repository\Resource;

use Pet\Model\Pet;
use Pet\Service\PetRepositoryInterface;

class PetRepositoryService implements PetRepositoryInterface
{

    // save new Pet in database
    public function store(array $data)
    {
        return Pet::query()->create($data);
    }

    // update Pet in database
    public function update(array $data, $PetId)
    {
        $Pet = Pet::query()->find($PetId);

        return $Pet->update($data);
    }

    // delete an Pet
    public function delete($PetId)
    {
        $Pet = Pet::query()->find($PetId);

        return $Pet->delete();
    }

    // list all items
    public function list(array $appends, array $filters, array $select = null, int $limit, $userId = null)
    {
        if ($userId) {
            $queryBuilder = Pet::query()->where('user_id', $userId);
        } else {
            $queryBuilder = Pet::query();
        }

        // Apply filters to the query
        if (! empty($filters)) {
            foreach ($filters as $filter) {
                foreach ($filter as $column => $value) {
                    $queryBuilder->where($column, $value);
                }
            }
        }

        // Select specific columns to retrieve from the database
        if (! empty($select)) {
            $queryBuilder->select($select);
        }

        // Eager load any relationships
        if (! empty($appends)) {
            $queryBuilder->with($appends);
        }

        // Apply sorting to the query
        $queryBuilder->orderBy('created_at', 'desc');

        // Apply limit to the query
        $queryBuilder->limit($limit);

        // Retrieve the Petes belonging to the user
        $Petes = $queryBuilder->get();

        return $Petes;
    }

    // fetch function
    public function fetch(int $id, array $appends, array $select)
    {
        // Start with a base query for the Pet model
        $queryBuilder = Pet::query();

        // Add any requested appends
        if (! empty($appends)) {
            $queryBuilder->with($appends);
        }

        // Add any requested selects
        if (! empty($select)) {
            $queryBuilder->select($select);
        }

        // Retrieve the Pet model with the given ID
        $Pet = $queryBuilder->find($id);

        if ($Pet) {
            return $Pet->first();
        }

        return false;
    }

    // restore function
    public function restore(int $id)
    {
        // Retrieve the soft-deleted Pet model with the given ID
        $Pet = Pet::onlyTrashed()->find($id);

        // Restore the Pet model
        $Pet->restore();

        return $Pet;
    }

    // force delete Pet
    public function forceDelete(int $id)
    {
        // Retrieve the Pet model with the given ID and permanently delete it
        return Pet::query()->findOrFail($id)->forceDelete();
    }

    // check is Pet existed in database
    public function exists(int $id)
    {
        return Pet::query()->where('id', $id)->exists();
    }

}
