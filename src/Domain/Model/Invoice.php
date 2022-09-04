<?php

declare(strict_types=1);

namespace App\Domain\Model;

class Invoice
{

    /**
     * @var string $id
     */
    private  $id;

    /**
     * designation de la facture
     *
     * @var string
     */
    private $designation;

    /**
     * description de la facture
     * 
     * @var string
     */

    private $description;

    /**
     * prix hors taxe
     *
     * @var float
     */
    private  $price_ht;

    /**
     * prix total
     * 
     * @var float
     */

    private $price_ttc;

    /**
     * Le propriétaire de la facture
     * 
     * @var User
     */
    private  $user;

    public function __construct()
    {
        $this->id = uniqid();
    }


    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getDesignation(): string
    {
        return $this->designation;
    }

    /**
     * @param string designation
     * @return Invoice
     */
    public function setDesignation(string $designation): Invoice
    {
        $this->designation = $designation;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Invoice
     */
    public function setDescription(string $description): Invoice
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return float
     */
    public function getPriceHt()
    {
        return $this->price_ht;
    }

    /**
     * @param float $price_ht
     * @return Invoice
     */
    public function setPriceHt(float $price_ht): Invoice
    {
        $this->price_ht = $price_ht;
        return $this;
    }

    /**
     * @return float
     */
    public function getPriceTtc()
    {
        return $this->price_ttc;
    }

    /**
     * @param float $price_ttc
     * @return Invoice
     */
    public function setPriceTtc(float $price_ttc): Invoice
    {
        $this->price_ttc = $price_ttc;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return Invoice
     */
    public function setUser(User $user): Invoice
    {
        $this->user = $user;
        return $this;
    }
}
