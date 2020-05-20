<?php


class jobOfferReaction
{
    public function addReactionToJobOffer($userID, $jobOfferID, $motivation, $cvInfo){
//      maakt connectie met de DB
        $conn = new mysqli('localhost', 'root', '', 'naikiedasvacatures');

//      voegt een rij toe aan het joboffer table
        $query = "INSERT INTO offerreaction (idUSer, idJoboffer, motivation, cv)  
        VALUES ('$userID', '$jobOfferID', '$motivation', '$cvInfo')";
        $conn->query($query);

        echo "<script type='text/javascript'>alert('Je reactie is geplaatst!');</script>";
    }
}