<?php

namespace Animal\Service\Repository\Resource;

use Animal\Model\Animal;
use Animal\Service\AnimalRepositoryInterface;

class AnimalRepositoryService implements AnimalRepositoryInterface
{

    // save new Animal in database
    public function store(array $data)
    {
        return Animal::query()->create($data);
    }


    // update Animal in database
    public function update(array $data, $AnimalId)
    {
        $Animal = Animal::query()->find($AnimalId);

        return $Animal->update($data);
    }


    // delete an Animal
    public function delete($AnimalId)
    {
        $Animal = Animal::query()->find($AnimalId);
        return $Animal->delete();
    }


    // list all items
    public function list(array $appends, array $filters, array $select = null, int $limit)
    {

        $queryBuilder = Animal::query();

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

        // Retrieve the Animales belonging to the user
        $Animales = $queryBuilder->get();

        return $Animales;
    }


    // fetch function
    public function fetch(int $id, array $appends, array $select)
    {
        // Start with a base query for the Animal model
        $queryBuilder = Animal::query();

        // Add any requested appends
        if (! empty($appends)) {
            $queryBuilder->with($appends);
        }

        // Add any requested selects
        if (! empty($select)) {
            $queryBuilder->select($select);
        }

        // Retrieve the Animal model with the given ID
        $Animal = $queryBuilder->find($id);

        if ($Animal) {
            return $Animal->first();
        }

        return false;
    }


    // restore function
    public function restore(int $id)
    {
        // Retrieve the soft-deleted Animal model with the given ID
        $Animal = Animal::onlyTrashed()->find($id);

        // Restore the Animal model
        $Animal->restore();

        return $Animal;
    }


    // force delete Animal
    public function forceDelete(int $id)
    {
        // Retrieve the Animal model with the given ID and permanently delete it
        return Animal::query()->findOrFail($id)->forceDelete();
    }


    // check is Animal existed in database
    public function exists(int $id)
    {
        return Animal::query()->where('id', $id)->exists();
    }

}
