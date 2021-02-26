<?php

namespace App\ApiResource;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use App\Dto\SearchResult;

/**
 * @TODO:: custom controller/service
 * @ApiResource(
 *     collectionOperations={
 *         "get"={"path"="search"}
 *     },
 *     itemOperations={},
 *     output=SearchResult::class
 * )
 */
class Search
{
    /**
     * @var string
     * @ApiProperty(identifier=true)
     */
    public $keyword;
}
