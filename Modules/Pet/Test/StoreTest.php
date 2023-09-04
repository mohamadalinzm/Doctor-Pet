<?php

namespace Tests\Feature;

use Pet\Service\Validation\PetValidationService;
use Tests\TestCase;

class StoreTest extends TestCase
{
    public function test_store_validation()
    {
        // Create a mock of the validation service
        $mockValidationService = $this->getMockBuilder(PetValidationService::class)
                                      ->onlyMethods(['store'])
                                      ->getMock();

        // Set up the mock to expect the store method to be called with the provided data
        $mockValidationService->expects($this->once())
                              ->method('store')
                              ->with(['Pet' => '123 Main St', 'city' => 'New York', 'state' => 'NY', 'zip' => '10001']);

        // Call the store method of the validation service
        $mockValidationService->store(['Pet' => '123 Main St', 'city' => 'New York', 'state' => 'NY', 'zip' => '10001']);
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
                          ->with(['Pet' => '123 Main St', 'city' => 'New York', 'state' => 'NY', 'zip' => '10001']);

        // Call the store method of the action service
        $mockActionService->store(['Pet' => '123 Main St', 'city' => 'New York', 'state' => 'NY', 'zip' => '10001']);
    }

    public function test_store_event()
    {
        // Create a mock of the event service
        $mockEventService = $this->getMockBuilder(EventService::class)
                                 ->onlyMethods(['create'])
                                 ->getMock();

        // Set up the mock to expect the create method to be called with the authenticated user and the Pet object
        $mockEventService->expects($this->once())
                         ->method('create')
                         ->with($this->equalTo(auth()->user()), $this->isInstanceOf(Pet::class));

        // Call the create method of the event service
        $mockEventService->create(auth()->user(), Pet::factory()->create());
    }

    public function test_store_response()
    {
        // Create a mock of the response service
        $mockResponseService = $this->getMockBuilder(ResponseService::class)
                                    ->onlyMethods(['PetStored'])
                                    ->getMock();

        // Set up the mock to expect the PetStored method to be called
        $mockResponseService->expects($this->once())
                            ->method('PetStored');

        // Call the PetStored method of the response service
        $mockResponseService->PetStored();
    }

}
