<?php


class addJobOffer
{
    public function newJobOffer($jobOfferName, $jobOfferFunction, $jobOfferBranch, $textDescription, $fileName)
    {
//      maakt connectie met de DB
        $conn = new mysqli('localhost', 'root', '', 'naikiedasvacatures');

//      voegt een rij toe aan jobofferBranch
        $query1 = "INSERT INTO jobbranch (branchName)  VALUES ('$jobOfferBranch')";
        $conn->query($query1);
        $branchID = $conn->insert_id;

//      voegt een rij toe aan jobofferFunction
        $query2 = "INSERT INTO jobfunction (functionName)  VALUES ('$jobOfferFunction')";
        $conn->query($query2);
        $functionID = $conn->insert_id;

//      voegt een rij toe aan het joboffer table
        $query3 = "INSERT INTO joboffer (idJobbranch, idJobfunction, status, name, description, jobOfferFile)  VALUES ('$branchID', '$functionID', '0', '$jobOfferName', '$textDescription', '$fileName')";
        $conn->query($query3);


            echo "<script type='text/javascript'>alert('De vacature is aangemaakt.');</script>";
        }
    }