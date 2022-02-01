
<?php 
    session_start();
    include('connection.php');
    if(!isset($_SESSION['login_userid']) or empty($_SESSION['login_userid'])){
        header('location: login.php');
    }
    
    $id = $_SESSION['login_userid'];
    $sql = "SELECT a.FirstName, a.LastName, b.HospitalName, b.Result, b.DateTested, c.TestResult, d.TestName, c.SwabIssuanceCode
    from tbl_customer a 
    INNER JOIN tbl_medicalDetails b on a.ID = b.CustomerID
    INNER JOIN tbl_swabissuance c on a.ID = c.CustomerID
    INNER JOIN tbl_testType d on b.TestType = d.ID WHERE a.ID = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    $FirstName = $row['FirstName'];
    $LastName = $row['LastName'];
    $HospitalName = $row['HospitalName'];
    $Result = $row['Result'];
    $TestResult = $row['TestResult'];
    $TestName = $row['TestName'];
    $SwabIssuanceCode = $row['SwabIssuanceCode'];

?>
<style>
    @import "https://fonts.googleapis.com/css?family=Open+Sans:300,400";
body,
.badgescard,
.firstinfo {
    display: flex;
    justify-content: center;
    align-items: center;
}

html {
    height: 100%;
}

body {
    font-family: 'Open Sans', sans-serif;
    width: 100%;
    min-height: 100%;
    background: #00bcd4;
    font-size: 16px;
    overflow: hidden;
}

*,
*:before,
*:after {
    box-sizing: border-box;
}

.content {
    position: relative;
    animation: animatop 0.9s cubic-bezier(0.425, 1.14, 0.47, 1.125) forwards;
}

.card {
    width: 500px;
    min-height: 100px;
    padding: 20px;
    border-radius: 3px;
    background-color: white;
    box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
    position: relative;
    overflow: hidden;
}

.card:after {
    content: '';
    display: block;
    width: 190px;
    height: 300px;
    background: cadetblue;
    position: absolute;
    animation: rotatemagic 0.75s cubic-bezier(0.425, 1.04, 0.47, 1.105) 1s both;
}

.badgescard {
    padding: 10px 20px;
    border-radius: 3px;
    background-color: #00bcd4;
    color:#fff;
    width: 480px;
    box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
    position: absolute;
    z-index: -1;
    left: 10px;
    bottom: 10px;
    animation: animainfos 0.5s cubic-bezier(0.425, 1.04, 0.47, 1.105) 0.75s forwards;
}

.badgescard span {
    font-size: 1.6em;
    margin: 0px 6px;
    opacity: 0.6;
}

.firstinfo {
    flex-direction: row;
    z-index: 2;
    position: relative;
}

.firstinfo img {
    border-radius: 50%;
    width: 120px;
    height: 120px;
}

.firstinfo .profileinfo {
    padding: 0px 20px;
}

.firstinfo .profileinfo h1 {
    font-size: 1.8em;
}

.firstinfo .profileinfo h3 {
    font-size: 1.2em;
    color: #00bcd4;
    font-style: italic;
}

.firstinfo .profileinfo p.detail {
    padding: 10px 0px;
    color: #5A5A5A;
    line-height: 1.2;
    font-style: initial;
}

@keyframes animatop {
    0% {
        opacity: 0;
        bottom: -500px;
    }
    100% {
        opacity: 1;
        bottom: 0px;
    }
}

@keyframes animainfos {
    0% {
        bottom: 10px;
    }
    100% {
        bottom: -42px;
    }
}

@keyframes rotatemagic {
    0% {
        opacity: 0;
        transform: rotate(0deg);
        top: -24px;
        left: -253px;
    }
    100% {
        transform: rotate(-30deg);
        top: -24px;
        left: -78px;
    }
}
</style>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

<div class="content">
    <div class="card">
        <div class="firstinfo"><img src="images/img-01.png" />
            <div class="profileinfo">
                <h1><?php echo $FirstName . ' ' . $LastName; ?></h1>
                <h3><b>Hospital Name :</b> <?php echo $HospitalName; ?></h3>
                <span class="detail"><b>Test Type Use :</b> <?php echo $TestName; ?></span><br>
                <span class="detail"><b>Result :</b> <?php echo $Result; ?></span><br>
                <span class="detail"><b>Code :</b> <?php echo $SwabIssuanceCode; ?></span>
            </div>
        </div>
    </div>

</div>
