<?php


class addJobOffer
{
    public function newJobOffer($jobOfferName, $jobOfferFunction, $jobOfferBranch, $textDescription)
    {
//      maakt connectie met de DB
        $conn = new mysqli('localhost', 'root', '', 'naikiedasvacatures');

//      voegt een rij toe aan het joboffer table
        $query3 = "INSERT INTO joboffer (idJobbranch, idJobfunction, status, name, description)  VALUES ('$jobOfferBranch', '$jobOfferFunction', '0', '$jobOfferName', '$textDescription')";
        $conn->query($query3);

            echo "<script type='text/javascript'>alert('De vacature is aangemaakt.');</script>";
        }
    }