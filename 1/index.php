<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EzQuiz</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
    .space{
        margin: auto;
    }

    .card{
        margin: 10px;
        margin-bottom: 20px;
        width: 350px;
    }

    .font{
        font-size: 25px;
    }
    </style>

</head>

<body>
    <div class="space container row">
            <?php
                $url = "https://dd-wtlab2020.netlify.app/pre-final/ezquiz.json";
                $response = file_get_contents($url);
                $result = json_decode($response);
                $num = 0;
                foreach ($result->tracks->items as $items){
                    echo '<div class="card">';
                foreach ($items->album->images as $image){
                    if ($image->height == 640){
                        echo '<img class="card-img-top" src="' . $image->url . '">';
                    }
                }
                echo '<div class="card-body">'."<p class='font'>" . $items->album->name . "</p>";
                foreach ($items->album->artists as $artists){
                echo "Artist : " . $artists->name . "<br>";
                }
                echo "Release date : " . $items->album->release_date . "<br>";
                foreach ($items->album->available_markets as $available_markets){
                    $num+=1;
                }
                echo "Avaliable : " . $num . " countries<br></div></div>";
                }
            ?>
    </div>
</body>
</html>
