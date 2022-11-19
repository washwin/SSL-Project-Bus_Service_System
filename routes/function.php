<?php 
    // if (isset($_SERVER["HTTP_REFERER"]) and strpos($_SERVER["HTTP_REFERER"], "index.php")) {
        if(array_key_exists('get_place_suggestions', $_GET)) {
            $str=$_GET["get_place_suggestions"];
            // $str = substr($str,1,strlen($str)-2);
            include('../db.php');
            $sql="SELECT placeName AS place FROM places WHERE placeName LIKE '%".$str."%';";
            $places=mysqli_query($conn,$sql);
            $count=mysqli_num_rows($places);
            if($count>0){
                while($row=mysqli_fetch_assoc($places)){
                    echo ($row['place'].',');
                  }
            }
            // echo substr($str,1,strlen($str)-2);
        }
    // }
?>