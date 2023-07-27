<!DOCTYPE html>
<html lang="en">

<head>
    <title>Create</title>
</head>

<body>
    <?php
    session_start();
    include("conf.php");
    $session_id = $_SESSION['user_id'];
    $image = $title = $tags =  $description = "";
    $user_id =  $conn->query("select id from users where session_id = '$session_id'")->fetch_column();
    if (isset($_POST['submit'])) {
        $image_name = time() . $_FILES['image']['name'];
        $image_tmpname = $_FILES['image']['tmp_name'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $tags = $_POST['tags'];
        if (move_uploaded_file($image_tmpname, '../images/uploads/' . $image_name)) {
            $conn->query("insert into posts(user_id, image, title,description, tags) values('$user_id', '$image_name' ,'$title', '$description','$tags')");
            echo ("uploaded");
            $uploaded_image =  $conn->query("select image from posts where image = '$image_name'")->fetch_column();
            echo "<input type='hidden' id='uploadedImage' value='$uploaded_image'>";
        }
    }

    ?>


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
        //                 xhr.open("GET", `setCategories.php?imageName=${imageName}&categories=${categories}`);
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

</body>

</html>