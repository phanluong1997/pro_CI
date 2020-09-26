<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
        <link rel="stylesheet" href="css/style.css">
        <title><?php echo $title;?></title>
        <style type="text/css">
            /* Page Error */
            @import url('https://fonts.googleapis.com/css2?family=Play:wght@400;700&display=swap');
            @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap');
            * {
                box-sizing: border-box;
            }
            
            body {
                font-family: 'Play', sans-serif !important;
                font-size: 14px;
                font-weight: 400;
                margin: 0px;
                padding: 0px;
                color: #6e8899;
            }
            .page404{
                height: 100vh;
                background-color: #22303b;
                background-image: linear-gradient(to right, #22303b , rgb(49, 68, 82));
                color:white;
                overflow: hidden;
                position: relative;
                text-align: center;
            }
            .page404 .title404{
                font-size: 150px;
                font-weight: 200;
                margin: 0 auto;
                height: 210px;
                line-height: 210px;
                position: absolute;
                top:calc(18%) !important;
                left: calc(50% - 130.5px);
            }
            .page404 .titlePageNotFound{
                font-size: 35px;
                color: #ffbc34;
                position: absolute;
                top:40%;
                left: calc(50% - 151px);
            }
            .page404 .title {
                font-size: 16px;
                position: absolute;
                width: 50%;
                top:50%;
                left:25%;
                color: rgb(197, 197, 197);
                line-height: 26px;
            }
            .page404 .title a{
                color: #FFF;
            }
            .page404 .btn-return{
                border-radius: 8px;
                font-weight: 600;
                color:#fff;
                font-size: 16px;
                border: none;
                outline: none;
                cursor: pointer;
                background-color: transparent;
            }
            .page404 .btn-return:hover{
                color: #ffbc34;
            }
            /* End Page Error */
        </style>
    </head>

    <body>
        <div class="page404">
            <h1 class="title404">404</h1>
            <h2 class="titlePageNotFound">Page Not Found</h2>
            <div class="title">
                <a href="/">Back To Home <i class="fas fa-angle-right"></i></a>
            </div>
            
        </div>
    </body>

</html>