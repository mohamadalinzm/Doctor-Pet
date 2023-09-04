<?php

namespace Shift\Service\Validation\Driver;

use App\Service\ValidationService;
use Shift\Service\ShiftValidationInterface;
use Shift\Service\Validation\Resource\AdminValidationRules;

class AdminShiftValidationService implements ShiftValidationInterface
{
    public $validator;

    public $validation;

    public function __construct()
    {
        $this->validator = (new ValidationService());
        $this->validation = app(ShiftValidationInterface::class);
    }


    public function store(array $data)
    {
        $rules = AdminValidationRules::Store();
        $validator = $this->validator->validate($data,$rules,[]);
        if (! $validator['isPass']) {
            $this->validation->ShiftValidationFailed($validator['errors']);
        }
    }

    public function update(array $data, $ShiftId)
    {
        $rules = AdminValidationRules::Update($data);
        $validator = $this->validator->validate($data,$rules,[]);
        if (! $validator['isPass']) {
            $this->validation->ShiftValidationFailed($validator['errors']);
        }
    }

    public function list(array $data)
    {
        // TODO: Implement list() method.
    }
}
