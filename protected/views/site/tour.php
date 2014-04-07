
<div class="span-19 text-center">
<h1>Tour</h1>
<?php if (Yii::app()->user->isAdmin()){
    //Admin Video
  echo  "<iframe width=\"560\" height=\"315\" src=\"//www.youtube.com/embed/wLKtTTZrq7k\" frameborder=\"0\" allowfullscreen></iframe>";
}else if (Yii::app()->user->isManager()){
       //Manager Video
   echo "<iframe width=\"560\" height=\"315\" src=\"//www.youtube.com/embed/4r30X5b9apo\" frameborder=\"0\" allowfullscreen></iframe>";
}else{
    //Volunteer Video
echo "<iframe width=\"560\" height=\"315\" src=\"//www.youtube.com/embed/sANW5PZUWQg\" frameborder=\"0\" allowfullscreen></iframe>";
}?>
</div>
