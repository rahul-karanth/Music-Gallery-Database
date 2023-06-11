<?php
$servername="localhost";
$username="root";
$password="";
$dbname="music_gallery";
$link = mysqli_connect($servername,$username,$password,$dbname);
$con  = mysqli_select_db($link,$dbname);
?>
<html>
   <body>
   <h1 style="text-align: center" >
      <strong>Music Gallery Management system</strong>
<style>

</style>
<div>
<form name="form1" action="" method="post">
   <input type="submit" name="submit1" value="customer">
</form>
</div>


<H1>    QUERIES </H1>


<div> <strong>1. Which artists have recorded songs longer than 5 minutes, and if so, how many songs were
recorded?</strong>
<form name="query1" action="" method="post">
   <input type="submit" name="query1" value="query1">
</form>
</div>


<div> <strong>2. For each artist and album how many songs were less than 5 minutes long?</strong>
<form name="query2" action="" method="post">
   <input type="submit" name="query2" value="query2">
</form>
</div>


<div> <strong>3. In which year or years were the most songs recorded?</strong>
<form name="query3" action="" method="post">
   <input type="submit" name="query3" value="query3">
</form>
</div>



<div> <strong> 4. List the artist, song and year of the top 5 longest recorded songs</strong>
<form name="query4" action="" method="post">
<input type="submit" name="query4" value="query4">
</form>
</div>


<div> <strong>5. List a table showing the Number of songs recorded for each year?</strong>
<form name="query5" action="" method="post">
   <input type="submit" name="query5" value=" query5">
</form>
</div>


<div> <strong> 6. In which year (or years) were the most (max) number of genre recorded, and how many
were recorded?</strong>
<form name="query6" action="" method="post">
   <input type="submit" name="query6" value="query6">
</form>
</div>
<div> <strong> 7.List the total duration of all songs recorded by each artist in descending order</strong>
<form name="query7" action="" method="post">
   <input type="submit" name="query7" value="query7">
</form>
</div>



</body>
</html>


<?php

      if(isset($_POST["submit1"]))
      {
         header('Location:db.php');
      }

      

   
      if(isset($_POST["query1"]))
      {
         $res=mysqli_query($link,"select sgname,count(*) from singer sg,song s where duration > 5 and sg.sgid=s.sgid group by sgname");
         echo"<table border=1>";
         echo"<tr>";
         echo"<th>";  echo"singer"; echo"</th>";
         echo"<th>";  echo"duration"; echo"</th>";
        
         
         echo"<th>";  
         echo"</tr>";
     
         while($row=mysqli_fetch_array($res))
         {
             echo"<tr>";
             echo"<th>";  echo $row["sgname"]; echo"</th>";
             echo"<th>";  echo $row["count(*)"]; echo"</th>";
            echo"</tr>";
         }
      }
      if(isset($_POST["query2"]))
      {
    $res = mysqli_query($link, "select sgname,count(*) from singer sg,song s where duration < 5 and sg.sgid=s.sgid group by sgname");
         echo"<table border=1>";
         echo"<tr>";
         echo"<th>";  echo"singer"; echo"</th>";
         echo"<th>";  echo"duration"; echo"</th>";
        
        
        
         
         echo"<th>";  
         echo"</tr>";
     
         while($row=mysqli_fetch_array($res))
         {
             echo"<tr>";
             echo"<th>";  echo $row["sgname"]; echo"</th>";
             echo"<th>";  echo $row["count(*)"]; echo"</th>";
          echo"</tr>";
         }
      }

      if(isset($_POST["query3"]))
      {
         $res=mysqli_query($link,"select years,count(*) from song group by years order by count(*) desc limit 1; ");
         echo"<table border=1>";
         echo"<tr>";
         echo"<th>";  echo"released_years"; echo"</th>";
         echo"<th>";  echo"total_count"; echo"</th>";
   
        
         
    
         while($row=mysqli_fetch_array($res))
         {
             echo"<tr>";
         echo"<th>";  echo $row["years"]; echo"</th>";
         echo"<th>";  echo $row["count(*)"]; echo"</th>";
        
         
         echo"</tr>";
         }
      }
      if(isset($_POST["query4"]))
      {
         $res=mysqli_query($link,"select sgname,sname, years from singer sg,song s where sg.sgid=s.sgid order by duration desc limit 5;");
         echo"<table border=1>";
         echo"<tr>";
         echo"<th>";  echo"Singer"; echo"</th>";
         echo"<th>";  echo"song"; echo"</th>";
         echo"<th>";  echo"released_year"; echo"</th>";
         
        
         
         echo"<th>";  
         echo"</tr>";
     
         while($row=mysqli_fetch_array($res))
         {
             echo"<tr>";
         echo"<th>";  echo $row["sgname"]; echo"</th>";
         echo"<th>";  echo $row["sname"]; echo"</th>";
         echo"<th>";  echo $row["years"]; echo"</th>";
         
         
         echo"</tr>";
         }
      }
      if(isset($_POST["query5"]))
      {
         $res=mysqli_query($link,"select years,count(sid) total_songs from song group by years;");
         echo"<table border=1>";
         echo"<tr>";
         echo"<th>";  echo"released_year"; echo"</th>";
         echo"<th>";  echo"total_songs"; echo"</th>";
      
        
         
         echo"<th>";  
         echo"</tr>";
     
         while($row=mysqli_fetch_array($res))
         {
             echo"<tr>";
         echo"<th>";  echo $row["years"]; echo"</th>";
         echo"<th>";  echo $row["total_songs"]; echo"</th>";
         echo"</tr>";
         }
      }
      if(isset($_POST["query6"]))
      {
         $res=mysqli_query($link,"select years,count(g.gid) as counts  from song s,genre g,singer sg where sg.gid=g.gid and s.sgid=sg.sgid group by years order by count(g.gid) desc limit 1;");
         echo"<table border=1>";
         echo"<tr>";
         echo"<th>";  echo"released_year"; echo"</th>";
         echo"<th>";  echo"total_genre"; echo"</th>";
         
        
         
         echo"<th>";  
         echo"</tr>";
     
         while($row=mysqli_fetch_array($res))
         {
             echo"<tr>";
         echo"<th>";  echo $row["years"]; echo"</th>";
         echo"<th>";  echo $row["counts"]; echo"</th>";
    
         
         echo"</tr>";
         }
      }
      if(isset($_POST["query7"]))
      {
         $res=mysqli_query($link,"select sgid,sum(duration) totald from song group by sgid order by totald desc;");
         echo"<table border=1>";
         echo"<tr>";
         echo"<th>";  echo"Singer ID"; echo"</th>";
         echo"<th>";  echo"total"; echo"</th>";
         
        
         
         echo"<th>";  
         echo"</tr>";
     
         while($row=mysqli_fetch_array($res))
         {
             echo"<tr>";
         echo"<th>";  echo $row["sgid"]; echo"</th>";
         echo"<th>";  echo $row["totald"]; echo"</th>";
    
         
         echo"</tr>";
         }
      }
?>