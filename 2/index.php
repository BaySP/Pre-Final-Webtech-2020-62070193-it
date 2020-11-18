<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HdQuiz</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

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

    .cbody{
        font-size: 15px;
    }

    form{
        padding: 0;
        width: 100%;
    }

}

    </style>
</head>
<body>
    <div class="space container row" style="margin-auto">
        <form method="post">
            <?php
                $bt = false;
                $ck = true;
                $sh = "";

                if(isset($_POST['test'])) {
                    $bt = true;

                    if($bt){
                        $sh = $_POST['text'];
                    }
                }

                echo '<h6>ระบุคำค้นหา :</h6><div style="width: 100% ;margin-bottom: 20px"><input id="text" name="text" value="' . $sh . '" class="form-control align-center" style="width: 80%; display: inline-block;">
                <button type="submit" name="test" class="btn btn-danger" style="margin-left: 15px">ค้นหา</button></div>';
            ?>

            </form>
            <?php
                $url = "https://dd-wtlab2020.netlify.app/pre-final/ezquiz.json";
                $response = file_get_contents($url);
                $result = json_decode($response);
                $num = 0;
                $fnum = 0;

                if ($sh == ""){
                    $ck = false;
                    foreach ($result->tracks->items as $items){
                        echo '<div class="card">';
                        foreach ($items->album->images as $image){
                            if ($image->height == 640){
                                echo '<img class="card-img-top" src="' . $image->url . '">';
                            }
                        }
                        echo "<div class='cbody'><p class='font'>" . $items->album->name . "</p>";
                        foreach ($items->album->artists as $artists){
                            echo "Artist : " . $artists->name . "<br>";
                        }
                        echo "Release date : " . $items->album->release_date . "<br>";
                        foreach ($items->album->available_markets as $available_markets){
                            $num+=1;
                        }
                        echo "Avaliable : " . $num . " countries<br></div></div>";
                    }
                }
                else{
                    foreach ($result->tracks->items as $items){
                        $ck = false;
                    foreach ($items->album->artists as $artists){
                            if (strpos($artists->name, $sh) !== false){
                                $ck = true;
                            }
                        }
                        if (strpos($items->album->name, $sh) !== false || $ck){
                            $fnum+=1;
                        }
                    }
                    if ($fnum > 0){
                        echo "<div style='width:100%; margin-bottom: 10px;'>ค้นหาเจอทั้งหมด " . $fnum . " รายการ<br></div>";
                    }
                    foreach ($result->tracks->items as $items){
                        $ck = false;
                        foreach ($items->album->artists as $artists){
                            if (strpos($artists->name, $sh) !== false){
                                $ck = true;
                            }
                        }
                        if (strpos($items->album->name, $sh) !== false || $ck){
                            $ck = false;
                            echo '<div class="card" style="width: 30%;">';
                            foreach ($items->album->images as $image){
                                if ($image->height == 640){
                                    echo '<img class="card-img-top" src="' . $image->url . '">';
                                }
                            }
                            echo "<div class='cbody'><p class='font'>" . $items->album->name . "</p>";
                            foreach ($items->album->artists as $artists){
                                echo "Artist : " . $artists->name . "<br>";
                            }
                            echo "Release date: " . $items->album->release_date . "<br>";
                            foreach ($items->album->available_markets as $available_markets){
                                $num+=1;
                            }
                            echo "Avaliable : " . $num . " countries<br></div></div>";
                        }
                    }
                }
                if ($ck==false){
                    echo 'Not Found';
                }
            ?>
    </div>
</body>
</html>
