<?php

namespace Tests\Feature;

use Address\Service\Validation\AddressValidationService;
use Tests\TestCase;

class StoreTest extends TestCase
{
    public function test_store_validation()
    {
        // Create a mock of the validation service
        $mockValidationService = $this->getMockBuilder(AddressValidationService::class)
                                      ->onlyMethods(['store'])
                                      ->getMock();

        // Set up the mock to expect the store method to be called with the provided data
        $mockValidationService->expects($this->once())
                              ->method('store')
                              ->with(['address' => '123 Main St', 'city' => 'New York', 'state' => 'NY', 'zip' => '10001']);

        // Call the store method of the validation service
        $mockValidationService->store(['address' => '123 Main St', 'city' => 'New York', 'state' => 'NY', 'zip' => '10001']);
    }

    public function test_store_policy()
    {
        // Create a mock of the policy service
        $mockPolicyService = $this->getMockBuilder(PolicyService::class)
                                  ->onlyMethods(['create'])
                                  ->getMock();

        // Set up the mock to expect the create method to be called with the authenticated user
        $mockPolicyService->expects($this->once())
                          ->method('create')
                          ->with($this->equalTo(auth()->user()));

        // Call the create method of the policy service
        $mockPolicyService->create(auth()->user());
    }

    public function test_store_action()
    {
        // Create a mock of the action service
        $mockActionService = $this->getMockBuilder(ActionService::class)
                                  ->onlyMethods(['store'])
                                  ->getMock();

        // Set up the mock to expect the store method to be called with the provided data
        $mockActionService->expects($this->once())
                          ->method('store')
                          ->with(['address' => '123 Main St', 'city' => 'New York', 'state' => 'NY', 'zip' => '10001']);

        // Call the store method of the action service
        $mockActionService->store(['address' => '123 Main St', 'city' => 'New York', 'state' => 'NY', 'zip' => '10001']);
    }

    public function test_store_event()
    {
        // Create a mock of the event service
        $mockEventService = $this->getMockBuilder(EventService::class)
                                 ->onlyMethods(['create'])
                                 ->getMock();

        // Set up the mock to expect the create method to be called with the authenticated user and the address object
        $mockEventService->expects($this->once())
                         ->method('create')
                         ->with($this->equalTo(auth()->user()), $this->isInstanceOf(Address::class));

        // Call the create method of the event service
        $mockEventService->create(auth()->user(), Address::factory()->create());
    }

    public function test_store_response()
    {
        // Create a mock of the response service
        $mockResponseService = $this->getMockBuilder(ResponseService::class)
                                    ->onlyMethods(['AddressStored'])
                                    ->getMock();

        // Set up the mock to expect the AddressStored method to be called
        $mockResponseService->expects($this->once())
                            ->method('AddressStored');

        // Call the AddressStored method of the response service
        $mockResponseService->AddressStored();
    }

}
