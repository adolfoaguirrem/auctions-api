<?php

namespace App\Application\Http\Request;

use App\Application\Http\Request\BaseRequest;
use Symfony\Component\Validator\Constraints as Assert;

class BuyerRequest extends BaseRequest
{

    /**
     * @Assert\NotNull
     * @Assert\NotBlank
     */
    protected $name;
}
