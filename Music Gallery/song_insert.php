<?php
require_once('config.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Song registration</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <style>
    table{
        border-collapse: collapse;
        width : 100%;
        color : #eb4034;
        font-family : monospace;
        font-size: 25px;
        text allign: left;
    }

    th{
        background-color: #eb4034;
        color:white;
    }
    tr:nth-child(even){background-color : #ededed}
    </style>
</head>
<body>
<div>
        <table>
            <tr>
                <th>Singer ID</th>
                <th>Singer name</th>
                <th>Genre ID</th>
            </tr>
            
            <?php
            $con = mysqli_connect("localhost", "root", "", "music_gallery");
            $sql="select * from singer;";
            $result = $con->query($sql);
            if($result->num_rows>0)
            {
                while($row = $result->fetch_assoc())
                {
                    echo "<tr><td>" . $row["sgid"] . "</td><td>" . $row["sgname"] . "</td><td>". $row["gid"] . "</td>";

                }
            }
            else{
                echo 'no result';
            }
            ?>
            </table>
        </div>
<div>
    <?php
    if(isset($_POST['submit']))
    {
        $sgid = $_POST['sid'];
        $sname = $_POST['sname'];
        $duration = $_POST['duration'];
        $dor = $_POST['year'];
        $sql="INSERT INTO song(sgid,sname,duration,years) values(?,?,?,?)";
        $stmtinsert = $db->prepare($sql);
        $result = $stmtinsert->execute([$sgid, $sname,$duration,$dor]);
        if($result){
            echo "Saved Sucessfully";                           
        }
        else
            echo 'error';
        
    }  
    ?>
<div>
    <form action="song_insert.php"method="post">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                    <h1>Song Registation</h1>
                    <p>Fill up the form with correct values</p>
                    <label for="sid"><b>Singer ID</b></label>
                    <input class="form-control" type="integer" name="sid" required>
                    <label for="sname"><b>Song Name</b></label>
                    <input class="form-control" type="text" name="sname" required>
                    <label for="duration"><b>Duration of the Song</b></label>
                    <input class="form-control" type="integer" name="duration" required> 
                    <label for="year"><b>Year of release</b></label>
                    <input class="form-control" type="integer" name="year" required>
                    <hr class="mb-3">
                    <input class="btn btn-primary" type="submit" name="submit" value="Register">
                </div>
                </div>
            </div>  
    </form>
</div >    

</div>
</body>
</html>