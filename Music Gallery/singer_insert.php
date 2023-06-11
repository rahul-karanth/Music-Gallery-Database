<?php
require_once('config.php');
?>
<!DOCTYPE= html>
<html>
<head>
    <title>Singer registration</title>
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
                <th>Genre ID</th>
                <th>Genre Name</th>
                <th>Country_of_origin</th>
            </tr>
            <?php
            $con = mysqli_connect("localhost", "root", "", "music_gallery");
            $sql="select * from genre;";
            $result = $con->query($sql);
            if($result->num_rows>0)
            {
                while($row = $result->fetch_assoc())
                {
                    echo "<tr><td>" . $row["gid"] . "</td><td>" . $row["gname"] . "</td><td>". $row["country_of_origin"] . "</td>";

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
        
        $sgname = $_POST['sgname'];
        $gid = $_POST['gid'];
        $sql="INSERT INTO singer(sgname,gid) values(?,?)";
        $stmtinsert = $db->prepare($sql);
        $result = $stmtinsert->execute([$sgname, $gid]);
        if($result){
            echo "Saved Sucessfully";                           
        }
        else
            echo 'error';
        
    }  
    ?>
<div>
    <form action="singer_insert.php"method="post">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                    <h1>Registation</h1>
                    <p>Fill up the form with correct values</p>
                    <label for="sgname"><b>Singer name</b></label>
                    <input class="form-control" type="text" name="sgname" required>
                    <label for="gid"><b>Genre ID</b></label>
                    <input class="form-control" type="integer" name="gid" required>
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
