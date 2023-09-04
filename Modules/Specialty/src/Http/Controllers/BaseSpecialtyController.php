<?php

namespace Specialty\Http\Controllers;

use App\Http\Controllers\Controller;
use Specialty\Repository\Contracts\SpecialtyRepository;


class BaseSpecialtyController extends Controller
{
    public $specialtyRepository;

    public function __construct()
    {
        $this->specialtyRepository = resolve(SpecialtyRepository::class);
;
    }
}
