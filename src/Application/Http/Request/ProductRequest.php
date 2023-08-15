<?php

namespace App\Application\Http\Request;

use App\Application\Http\Request\BaseRequest;
use Symfony\Component\Validator\Constraints as Assert;

class ProductRequest extends BaseRequest
{

    /**
     * @Assert\NotNull
     * @Assert\NotBlank
     */
    protected $name;

    /**
     * @Assert\NotNull
     * @Assert\NotBlank
     * @Assert\Type(type="numeric")
     */
    protected $price;
}
