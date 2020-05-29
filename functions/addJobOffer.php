<?php

class addJobOffer
{
    public function newJobOffer($jobOfferName, $jobOfferFunction, $jobOfferBranch, $textDescription)
    {
//      maakt connectie met de DB
        $conn = new mysqli('localhost', 'root', '', 'naikiedasvacatures');

//      voegt een rij toe aan het joboffer table
        $query = "INSERT INTO joboffer (idJobbranch, idJobfunction, status, name, description)  VALUES ('$jobOfferBranch', '$jobOfferFunction', '0', '$jobOfferName', '$textDescription')";
        $conn->query($query);

        echo "<script type='text/javascript'>alert('De vacature is aangemaakt.');</script>";
    }

    public function updateJobOffer($jobOfferName, $jobOfferFunction, $jobOfferBranch, $textDescription, $jobID)
    {
//      maakt connectie met de DB
        $conn = new mysqli('localhost', 'root', '', 'naikiedasvacatures');

//      voegt een rij toe aan het joboffer table
        $query = "update naikiedasvacatures.joboffer
                    set idJobbranch = '$jobOfferBranch',
                        idJobfunction = '$jobOfferFunction',
                        name = '$jobOfferName',
                        description = '$textDescription'
                    Where jobofferID = '$jobID'";

        $conn->query($query);
//      stuurt je naar de vacature pagina die bijgewerkt is.
        echo "<script type='text/javascript'>alert('De vacature is bijgewerkt.');</script>";
        echo "<script>location.href='index.php?page=jobOfferPHP&jobofferID=$jobID';</script>";
    }
}