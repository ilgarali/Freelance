<?php include('includes/db.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>


    
<div>
</div>

<div id="append">



<button class="btn btn-danger">Submit</button>


    <script>

        // let btn = document.querySelectorAll('.btn-danger');
        // for (let i = 0; i < btn.length; i++) {
        //     btn[i].addEventListener("click",function(){
                
        //         btn[i].setAttribute("class","btn btn-success");
        //         let x = btn[i].innerHTML;
        //         console.log(x);
                
        //     });
            
        // }
        
    //  const myForm = document.getElementById('myForm');
 

    //  myForm.addEventListener('submit',(e) => {
    //     e.preventDefault();
    //     const title = document.getElementById('title').value;
    //     const text = document.getElementById('text').value;
    //     const img = document.getElementById('img');
    //     let show = document.getElementById('img').value;
        
        
    //     let showimage = show.replace(/C:\\fakepath\\/, '');
       
        
    //     const endpoint = 'testact.php';
    //     const formData = new FormData();
                
    //      formData.append("img",img.files[0]);
        
    //     formData.append("title",title);
    //     formData.append("text",text);
    //     fetch(endpoint,{
    //         method:"Post",
    //         body:formData
    //     }).then((res) => res.text()).then((data)=> console.log(data)).catch((error)=> console.log(error))
    //     const hold = document.getElementById('append');
    //     hold.insertAdjacentHTML('afterbegin',`<h1>${title}</h1><div><img src=upload/${showimage}></div> <p>${text}</p>  `) ;
   


       



    //  });


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
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>