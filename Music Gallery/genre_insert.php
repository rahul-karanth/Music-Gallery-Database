<?php
require_once('config.php');
?>
<!DOCTYPE= html>
<html>
<head>
    <title>Genre registration</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
<div>
    <?php
    if(isset($_POST['submit']))
    {
        
        $gname = $_POST['gname'];
        $coo = $_POST['coo'];
        $sql="INSERT INTO genre(gname,country_of_origin) values(?,?)";
        $stmtinsert = $db->prepare($sql);
        $result = $stmtinsert->execute([$gname, $coo]);
        if($result){
            echo "\Saved Sucessfully";                           
        }
        else
            echo 'error';
        
    }  
    ?>
<div>
    <form action="genre_insert.php"method="post">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                    <h1>Registation</h1>
                    <p>Fill up the form with correct values</p>
                    <label for="gname"><b>name</b></label>
                    <input class="form-control" type="text" name="gname" required>
                    <label for="coo"><b>Country of Origin</b></label>
                    <input class="form-control" type="integer" name="coo" required>
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