<head>
<link rel="stylesheet" href="<?php echo URL;?>public/css/error.css">

</head>
<div class="error_msg">
    <p>
        
        <?php if(isset($error_msg))
        {echo $error_msg; }
        else{
            echo "you dont have permission!!!";   
        }
        
        ?>
    </p>
</div>