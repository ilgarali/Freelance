<?php include('includes/db.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <form id="myForm" enctype="multipart/form-data">
        <input style="display: block;margin:10px 5px;" type="text" name="title" id="title">
        <textarea name="text" id="text" cols="30" rows="10"></textarea>
        <input style="display: block;margin:10px;" type="file" name="img" id="img">
        <button style="display: block;" type="submit" name="submit" id="submit">Send Post</button>
    </form>
    
<div>
</div>

<div id="append">

<?php 
$sql = "SELECT * FROM test ORDER BY id DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$data = $stmt->fetchAll();
foreach ($data as $data) {
    # code...

?>
<h1> <?php echo $data['title'] ?> </h1>
<div><img src="upload/<?php echo $data['img'] ?>" alt=""></div>
<p> <?php echo $data['text'] ?> </p>
<?php }
 ?>
</div>


    <script>
        
     const myForm = document.getElementById('myForm');
 

     myForm.addEventListener('submit',(e) => {
        e.preventDefault();
        const title = document.getElementById('title').value;
        const text = document.getElementById('text').value;
        const img = document.getElementById('img');
        let show = document.getElementById('img').value;
        
        
        let showimage = show.replace(/C:\\fakepath\\/, '');
       
        
        const endpoint = 'testact.php';
        const formData = new FormData();
                
         formData.append("img",img.files[0]);
        
        formData.append("title",title);
        formData.append("text",text);
        fetch(endpoint,{
            method:"Post",
            body:formData
        }).then((res) => res.text()).then((data)=> console.log(data)).catch((error)=> console.log(error))
        const hold = document.getElementById('append');
        hold.insertAdjacentHTML('afterbegin',`<h1>${title}</h1><div><img src=upload/${showimage}></div> <p>${text}</p>  `) ;
   


       



     });


      /*   
        document.getElementById('addPost').addEventListener('submit',addPost);

        function addPost(e) { 
            e.preventDefault();
            let title = document.getElementById('title').value;
            let text = document.getElementById('text').value;
            let img = document.getElementById('img').value;
           
            alert(img);
            fetch('tetsact.php',{
                method:"POST",
                headers:{
                    'Accept':'application/json',
                    
                },
                body:JSON.stringify({title:title,text:text,img:img})
            }).then((res) => {return res.text()})
            .then((text) => console.log(text) )
            .catch((error) => console.log(error))
          

         }
 */


      

    </script>
</body>
</html>