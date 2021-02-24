<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\RideRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Constraints\MinimalProperties;

/**
 * @ApiResource(
 *     collectionOperations={
 *         "get",
 *         "post"
 *     },
 *     itemOperations={
 *         "get",
 *         "put",
 *         "patch"
 *     },
 *     shortName="rides",
 *     normalizationContext={"groups"={"rides:api-get"}, "swagger_definition_name"="GET"},
 *     denormalizationContext={"groups"={"rides:api-write"}, "swagger_definition_name"="WRITE"},
 * )
 * @ORM\Table(name="icapps_rides")
 * @ORM\Entity(repositoryClass=RideRepository::class)
 */
class Ride
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     * @Groups({"rides:api-get", "rides:api-write"})
     * @ApiProperty(
     *     attributes={
     *         "openapi_context"={
     *             "type"="string",
     *             "enum"={"internal", "abroad"},
     *             "example"="internal"
     *         }
     *     }
     * )
     */
    public $type;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank
     * @Groups({"rides:api-get", "rides:api-write"})
     */
    private $startDate;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank
     * @Groups({"rides:api-get", "rides:api-write"})
     */
    private $endDate;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"rides:api-get", "rides:api-write"})
     * @Assert\NotBlank
     * @Assert\Length(
     *     min = 2,
     *     max = 50,
     * )
     */
    private $pickupStreetNumber;

    /**
     * @ORM\Column(type="json")
     * @Assert\NotBlank
     * @MinimalProperties()
     * @Groups({"rides:api-get", "rides:api-write"})
     */
    // @TODO:: lat/lon required object properties.
    // @TODO:: customize error messages in API.
    // @TODO:: enforce json instead of json.ld
    private $startLocation;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"rides:api-get", "rides:api-write"})
     * @Assert\NotBlank
     * @Assert\Length(
     *     min = 2,
     *     max = 50,
     * )
     */
    private $destinationStreetNumber;


    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * @Groups({"rides:api-get"})
     */
    public function getCustomField(): string
    {
        // Example custom field included in API.
        return 'Test';
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getPickupStreetNumber(): ?string
    {
        return $this->pickupStreetNumber;
    }

    public function setPickupStreetNumber(string $pickupStreetNumber): self
    {
        $this->pickupStreetNumber = $pickupStreetNumber;

        return $this;
    }

    public function getStartLocation()
    {
        return $this->startLocation;
    }

    public function setStartLocation($startLocation): void
    {
        $this->startLocation = $startLocation;
    }

    public function getDestinationStreetNumber(): ?string
    {
        return $this->destinationStreetNumber;
    }

    public function setDestinationStreetNumber(string $destinationStreetNumber): self
    {
        $this->destinationStreetNumber = $destinationStreetNumber;

        return $this;
    }
}
