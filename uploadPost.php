<!DOCTYPE html>
<html lang="en">

<head>

    <?php include("./layout/head.php") ?>

    <title>Create</title>
</head>

<body>

    <?php

    session_start();
    include("php/conf.php");
    include('layout/navbar.php');
    include('layout/logoutForm.php');
    $error = "";
    $session_id = $_SESSION['user_id'];
    $image = $title = $tags =  $description = "";
    $user_id =  $conn->query("select id from users where session_id = '$session_id'")->fetch_column();
    if (isset($_POST['submit'])) {


        $image_tmpname = $_FILES['image']['tmp_name'];
        $post_id = "";
        $exts = ["png", "jpg", "jpeg", "gif"];
        $ext =  strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
       
        if ($_FILES["image"]["size"] >  5242880) {
            $error = "قەبارەی وێنەکە دەبێت کەمتر بێت لە ٥ مێگابایت";
        }
         elseif (!in_array($ext, $exts)) {
            $error = "ببورە کێشەیەک هەیە، تکایە هەوڵبدەرەوە";
        } 
        else {
            $image_name = "IMG_".date("Ymdhis")."_".random_int(1000000, 9999999).".".$ext;
            $av = $conn->query("select image from posts where image = '$image_name'");
            if($av->num_rows > 0){
                $image_name = "IMG_".date("Ymdhis")."_".random_int(2000000, 9999999).".".$ext;
            }
            $title = $_POST['title'];

            $description = $_POST['description'];
            $tags = $_POST['tags'];
            
            if (move_uploaded_file($image_tmpname, 'images/uploads/' . $image_name)) {

                $conn->query("insert into posts(user_id, image, title,description, tags) values('$user_id', '$image_name' ,'$title', '$description','$tags')");
                
                $followers = $conn->query("select *  from followers where user_id = '$user_id'");
                if($followers->num_rows > 0){
                  while($follower = $followers->fetch_assoc()){
                    $follower_id = $follower['follower_id'];

                    $conn->query("update users set inbox = 1 where id = '$follower_id'");
                    $message = "پۆستێکی نوێی کرد";
                    $link  = $conn->query("select id from posts order by created desc limit 1 ")->fetch_column();
                    $conn->query("insert into inbox (user_id, sender_id, message,link , user_link) value('$follower_id', '$user_id', '$message','$link' ,'$user_id' )");
                  }
                }

                $post_id = $conn->query("select id from posts where image = '$image_name' ")->fetch_column();
                $uploaded_image =  $conn->query("select image from posts where image = '$image_name'")->fetch_column();
                echo "<input type='hidden' id='uploadedImage' value='$uploaded_image'>";
            }
        }
    }
    ?>
    <div class="container">

        <?php
        if ($error != "") { ?>
            <div class="card p-2 text-center mt-5 rounded-4">
                <div> <?= $error ?></div>
                <a href="./create.php" class="text-secondary"><bdo dir="rtl">وێنەیەکی تر هەڵبژێرە</bdo></a>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-sm-12 col-md-4 text-center">
                    <img src="svg/storage.svg" alt="" class="w-100 mt-5">
                </div>
            </div>

        <?php } else { ?>
            <div class="card p-2 text-center mt-5 rounded-4">
                <div> <img src="svg/success.svg" alt="" width="20px"> <bdo dir="rtl">وێنەکە بە سەرکەوتوویی پۆست کرا</bdo></div>
                <a href="<?= 'post.php?id=' . $post_id ?>" class="text-secondary"><bdo dir="rtl">پۆستەکە ببینە</bdo></a>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-sm-12 col-md-4 text-center">
                    <img src="svg/talk.svg" alt="" class="w-100 mt-5">
                </div>
            </div>
        <?php } ?>

    </div>


    <input type="hidden" name="categories" id="categories" value="">
    <script>
        ///////////////////////////////////////////////////////////////////////////////////////////////////
        // In this section, we set the user authentication, user and app ID, model details, and the URL
        // of the image we want as an input. Change these strings to run your own example.
        //////////////////////////////////////////////////////////////////////////////////////////////////

        // Your PAT (Personal Access Token) can be found in the portal under Authentification
        const PAT = '87e71469783640cca6a6aa93c076c0c2';
        // Specify the correct user_id/app_id pairings
        // Since you're making inferences outside your app's scope
        const USER_ID = 'oivlrko2gf2e';
        const APP_ID = 'my-first-application-m21wyk';
        // Change these to whatever model and image URL you want to use
        const MODEL_ID = 'general-image-recognition';
        const MODEL_VERSION_ID = 'aa7f35c01e0642fda5cf400f543e7c40';
        const IMAGE_URL = 'https://i.pinimg.com/736x/00/95/48/009548895020f7e9bb1b7ed64aafac81.jpg';


        ///////////////////////////////////////////////////////////////////////////////////
        // YOU DO NOT NEED TO CHANGE ANYTHING BELOW THIS LINE TO RUN THIS EXAMPLE
        ///////////////////////////////////////////////////////////////////////////////////

        const raw = JSON.stringify({
            "user_app_id": {
                "user_id": USER_ID,
                "app_id": APP_ID
            },
            "inputs": [{
                "data": {
                    "image": {
                        "url": IMAGE_URL
                    }
                }
            }]
        });

        const requestOptions = {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Authorization': 'Key ' + PAT
            },
            body: raw
        };

        // NOTE: MODEL_VERSION_ID is optional, you can also call prediction with the MODEL_ID only
        // https://api.clarifai.com/v2/models/{YOUR_MODEL_ID}/outputs
        // this will default to the latest version_id
        let categories = [];
        let imageName = document.getElementById('uploadedImage').value;



        // fetch("https://api.clarifai.com/v2/models/" + MODEL_ID + "/versions/" + MODEL_VERSION_ID + "/outputs", requestOptions)
        //     .then(response => response.json())
        //     .then(result => {
        //         let concepts = result.outputs[0].data.concepts
        //         for (let i = 0; i < concepts.length; i++) {
        //             categories.push(concepts[i].name)

        //         }
        //         console.log(categories)
        //         document.getElementById("categories").value = categories;
        //         let avalable = setInterval(() => {
        //             if (categories == "" && imageName == "") {
        //                 console.log("empty")
        //             } else {
        //                 clearTimeout(avalable)
        //                 let xhr = new XMLHttpRequest();
        //                 xhr.open("GET", `php/setCategories.php?imageName=${imageName}&categories=${categories}`);
        //                 xhr.onreadystatechange = () => {
        //                     if (xhr.status == 200 && xhr.readyState == 4) {
        //                         let res = xhr.response;
        //                     }
        //                 }
        //                 xhr.send();
        //             }
        //         }, 100)
        //     })
        //     .catch(error => console.log('error', error));
    </script>
    <script src="js/home.js"></script>

</body>

</html>