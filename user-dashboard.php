<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,600;1,500&family=Nunito&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="user-dashboard.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
    </head>
    <body>
        <?php 
            session_start();
            $username=$_SESSION['customer'];
            include_once('DbConfig.php');
            $con=new DbConfig();
         ?>
         <div id="logout">
            <i class="fa fa-sign-out" style="color:black"></i>
         </div>
         <div id="navigation">
            <span id="logo">We Care.</span>
            <div class="nav_item">
                <span id="booking" class="active_link">My Bookings</span>
                <span id="order">My Orders</span>
            </div>
            <div id="logout_but">
                <i class="fa fa-user-circle"></i>
                <span><?php echo $_SESSION['customer']?></span>
            </div>
        </div>
        <div id="nav_nav">
            <span id="new_appoint" class="active_booking">Pending Bookings</span>
            <span id="old_appoint">Accepted Bookings</span>
        </div>
        <div class="pending_book">
        <?php
        $getitems=$con->connection->query("SELECT * from booking where username='$username' AND active='0'");
            while($row=mysqli_fetch_array($getitems)){
                $proid=$row['10'];
                $id=$con->connection->query("SELECT * from signup where id='$proid'");
                while($prorow=mysqli_fetch_array($id)){
                    $docuser=$prorow['2'];
                    $docname=$prorow['1'];
                }
        ?>
            <div class="book_item">
                <div class="first_book">
                    <img class="book_image" src="profileimage/<?php echo $docuser?>.jpg">
                     <p style="text-align:center"><?php echo $docname;?></p>
                     <p class="view_book" onclick="redirectDoc(<?php echo $row['10']?>)">view profile</p>
                </div>
                <div class="sec_book">
                    <span class="book_header">Info you provided</span>
                    <div>
                        <p>Phone number: <span><?php echo $row['3']?></span></p>
                        <p>Date: <span><?php echo $row['6']?></span></p>
                        <p>Time of appointment: <span><?php echo $row['5']?></span></p>
                        <p>History: <span><?php echo $row['4']?></span></p>
                        <p>Current symptoms: <span><?php echo $row['11']?></span></p>
                    </div>
                </div>
                <div style="width: 100%;grid-column: 1/3;"><iframe width="100%" height="200" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=200&amp;hl=en&amp;q=<?php echo $row['7']?>,<?php echo $row['8']?>+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe></div>
            </div>
            <?php
            }
            ?>
        </div>
        <div class="pending_book" style="display:none">
        <?php
        $getitems=$con->connection->query("SELECT * from booking where username='$username' AND active='1'");
            while($row=mysqli_fetch_array($getitems)){
                $proid=$row['10'];
                $id=$con->connection->query("SELECT * from signup where id='$proid'");
                while($prorow=mysqli_fetch_array($id)){
                    $docuser=$prorow['2'];
                    $docname=$prorow['1'];
                }
        ?>
            <div class="book_item">
                <div class="first_book">
                    <img class="book_image" src="profileimage/<?php echo $docuser;?>.jpg">
                     <p style="text-align:center"><?php echo $docname;?></p>
                     <p class="view_book" onclick="redirectDoc(<?php echo $row['10']?>)">view profile</p>
                </div>
                <div class="sec_book">
                    <span class="book_header">Info you provided</span>
                    <div>
                        <p>Phone number: <span><?php echo $row['3']?></span></p>
                        <p>Date: <span><?php echo $row['6']?></span></p>
                        <p>Time of appointment: <span><?php echo $row['5']?></span></p>
                        <p>History: <span><?php echo $row['4']?></span></p>
                        <p>Current symptoms: <span><?php echo $row['11']?></span></p>
                    </div>
                </div>
                <div style="width: 100%;grid-column: 1/3;"><iframe width="100%" height="200" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=200&amp;hl=en&amp;q=<?php echo $row['7']?>,<?php echo $row['8']?>+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe></div>
            </div>
            <?php
            }
            ?>
        </div>
        <script>
            document.getElementById('logo').addEventListener('click',function(){
                window.location.assign('index.php');
            });
            var logout=document.getElementById('logout');
            logout.addEventListener('click',function(){
                $.post('logout.php',"logout");
                window.location.assign('usersignin.php');
            });
            document.getElementById('order').addEventListener('click',function(){
                window.location.assign('user-order.php');
            });
            document.getElementById('booking').addEventListener('click',function(){
                window.location.assign('user-dashboard.php');
            });
            function redirectDoc(id){
                window.location.assign('doctor.php?profile='+id);
            }
            var new_app=document.getElementById('new_appoint');
            var old_app=document.getElementById('old_appoint');
            new_app.addEventListener('click',function(){
                new_app.classList.add("active_booking");
                old_app.classList.remove('active_booking');
                document.getElementsByClassName('pending_book')[0].style.display="grid";
                document.getElementsByClassName('pending_book')[1].style.display="none";
            });
            old_app.addEventListener('click',function(){
                old_app.classList.add("active_booking");
                new_app.classList.remove('active_booking');
                document.getElementsByClassName('pending_book')[1].style.display="grid";
                document.getElementsByClassName('pending_book')[0].style.display="none";
            });
        </script>
    </body>
</html>