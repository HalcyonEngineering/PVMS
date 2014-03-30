
<div class="span-19 text-center">
<h1>Tour</h1>
<?php if (Yii::app()->user->isAdmin()){
    //Admin Video
  echo  "<iframe width=\"560\" height=\"315\" src=\"//www.youtube.com/embed/wLKtTTZrq7k\" frameborder=\"0\" allowfullscreen></iframe>";
}else if (Yii::app()->user->isManager()){
       //Manager Video
   echo "<iframe width=\"560\" height=\"315\" src=\"//www.youtube.com/embed/vYyESg-Iqh4\" frameborder=\"0\" allowfullscreen></iframe>";
}else{
    //Volunteer Video
echo "<iframe width=\"560\" height=\"315\" src=\"//www.youtube.com/embed/wjivo98WIIA\" frameborder=\"0\" allowfullscreen></iframe>";
}?>
</div>
