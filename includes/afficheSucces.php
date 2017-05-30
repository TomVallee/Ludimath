    <?php 
 if (isUserConnected())
 {
     AfficherNotifSucces($_SESSION['id']); 
     SuccesConnection($_SESSION['id']);
 }
?>