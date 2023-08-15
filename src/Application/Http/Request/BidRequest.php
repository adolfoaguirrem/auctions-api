<?php

namespace App\Application\Http\Request;

use App\Application\Http\Request\BaseRequest;
use Symfony\Component\Validator\Constraints as Assert;

class BidRequest extends BaseRequest
{

    /**
     * @Assert\NotNull
     * @Assert\NotBlank
     * @Assert\Type(type="numeric")
     */
    protected $productId;

    /**
     * @Assert\NotNull
     * @Assert\NotBlank
     * @Assert\Type(type="numeric")
     */
    protected $buyerId;

    /**
     * @Assert\NotNull
     * @Assert\NotBlank
     * @Assert\Type(type="numeric")
     */
    protected $amount;
}
