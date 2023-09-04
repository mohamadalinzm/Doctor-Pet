<?php

namespace Address\Service\Repository\Resource;

use Address\Model\Address;
use Address\Service\AddressRepositoryInterface;

class AddressRepositoryService implements AddressRepositoryInterface
{

    // save new address in database
    public function store(array $data, $entity)
    {
        $address = new Address;
        $address->fill($data);

        return $entity->addresses()->save($address);
    }

    // update address in database
    public function update(array $data, $addressId)
    {
        $address = Address::query()->find($addressId);

        return $address->update($data);
    }

    // delete an address
    public function delete($addressId)
    {
        $address = Address::query()->find($addressId);

        return $address->delete();
    }

    // list all items
    public function list($entity, array $appends, array $filters, array $select = null, int $limit)
    {
        $queryBuilder = $entity->addresses()->where('is_active',true);

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

        // Retrieve the addresses belonging to the user
        $addresses = $queryBuilder->get();

        return $addresses;
    }

    // fetch function
    public function fetch(int $id, array $appends, array $select)
    {
        // Start with a base query for the Address model
        $queryBuilder = Address::query();

        // Add any requested appends
        if (! empty($appends)) {
            $queryBuilder->with($appends);
        }

        // Add any requested selects
        if (! empty($select)) {
            $queryBuilder->select($select);
        }

        // Retrieve the Address model with the given ID
        $address = $queryBuilder->find($id);

        if ($address) {
            return $address->first();
        }

        return false;
    }

    // set function
    public function set(int $id)
    {
        // Retrieve the Address model with the given ID and update its default flag
        $address = Address::query()->findOrFail($id);
        Address::query()->where('user_id', $id)->update(['is_default' => false]);
        $address->update(['is_default' => true]);

        return $address;
    }

    // restore function
    public function restore(int $id)
    {
        // Retrieve the soft-deleted Address model with the given ID
        $address = Address::onlyTrashed()->find($id);

        // Restore the Address model
        $address->restore();

        return $address;
    }

    // force delete address
    public function forceDelete(int $id)
    {
        // Retrieve the Address model with the given ID and permanently delete it
        return Address::query()->findOrFail($id)->forceDelete();
    }

    // check is address existed in database
    public function exists(int $id)
    {
        return Address::query()->where('id', $id)->exists();
    }

}
