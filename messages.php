<?php include 'includes/header.php';?>
<style>
.container{max-width:1170px; margin:auto;}
img{ max-width:100%;}
.inbox_people {
  background: #f8f8f8 none repeat scroll 0 0;
  float: left;
  overflow: hidden;
  width: 40%; border-right:1px solid #c4c4c4;
}
.inbox_msg {
  border: 1px solid #c4c4c4;
  clear: both;
  overflow: hidden;
}
.top_spac{ margin: 20px 0 0;}


.recent_heading {float: left; width:40%;}
.srch_bar {
  display: inline-block;
  text-align: right;
  width: 60%;
}
.headind_srch{ padding:10px 29px 10px 20px; overflow:hidden; border-bottom:1px solid #c4c4c4;}

.recent_heading h4 {
  color: #05728f;
  font-size: 21px;
  margin: auto;
}
.srch_bar input{ border:1px solid #cdcdcd; border-width:0 0 1px 0; width:80%; padding:2px 0 4px 6px; background:none;}
.srch_bar .input-group-addon button {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border: medium none;
  padding: 0;
  color: #707070;
  font-size: 18px;
}
.srch_bar .input-group-addon { margin: 0 0 0 -27px;}

.chat_ib h5{ font-size:15px; color:#464646; margin:0 0 8px 0;}
.chat_ib h5 span{ font-size:13px; float:right;}
.chat_ib p{ font-size:14px; color:#989898; margin:auto}
.chat_img {
  float: left;
  width: 11%;
}
.chat_ib {
  float: left;
  padding: 0 0 0 15px;
  width: 88%;
}

.chat_people{ overflow:hidden; clear:both;}
.chat_list {
  border-bottom: 1px solid #c4c4c4;
  margin: 0;
  padding: 18px 16px 10px;
}
.inbox_chat { height: 550px; overflow-y: scroll;}

.active_chat{ background:#ebebeb;}

.incoming_msg_img {
  display: inline-block;
  width: 6%;
}
.received_msg {
  display: inline-block;
  padding: 0 0 0 10px;
  vertical-align: top;
  width: 92%;
 }
 .received_withd_msg p {
  background: #ebebeb none repeat scroll 0 0;
  border-radius: 3px;
  color: #646464;
  font-size: 14px;
  margin: 0;
  padding: 5px 10px 5px 12px;
  width: 100%;
}
.time_date {
  color: #747474;
  display: block;
  font-size: 12px;
  margin: 8px 0 0;
}
.received_withd_msg { width: 57%;}
.mesgs {
  float: left;
  padding: 30px 15px 0 25px;
  width: 60%;
}

 .sent_msg p {
  background: #05728f none repeat scroll 0 0;
  border-radius: 3px;
  font-size: 14px;
  margin: 0; color:#fff;
  padding: 5px 10px 5px 12px;
  width:100%;
}
.outgoing_msg{ overflow:hidden; margin:26px 0 26px;}
.sent_msg {
  float: right;
  width: 46%;
}
.input_msg_write input {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border: medium none;
  color: #4c4c4c;
  font-size: 15px;
  min-height: 48px;
  width: 100%;
}

.type_msg {border-top: 1px solid #c4c4c4;position: relative;}
.msg_send_btn {
  background: #05728f none repeat scroll 0 0;
  border: medium none;
  border-radius: 50%;
  color: #fff;
  cursor: pointer;
  font-size: 17px;
  height: 33px;
  position: absolute;
  right: 0;
  top: 11px;
  width: 33px;
}
.messaging { padding: 0 0 50px 0;}
.msg_history {
  height: 516px;
  overflow-y: auto;
}
</style>




<body>
<div class="container ">
<h3 class="text-left " style="background-color: #007bff; height:70px;"></h3>
<div class="messaging">
      <div class="inbox_msg">
        <div class="inbox_people">
          <div class="headind_srch">
            <div class="recent_heading">
              <h4>Recent</h4>
            </div>
            <div class="srch_bar">
              <div class="stylish-input-group">
                <input type="text" class="search-bar"  placeholder="Search" >
                <span class="input-group-addon">
                <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
                </span> </div>
            </div>
          </div>
          <div class="inbox_chat">
          <?php    $sessid = $_SESSION['id'];
           
           $sql= "SELECT messages.id,from_id,to_id, messages.created_at, users.name as from_name, users2.name as to_name, `message`,users.id as `user_id` FROM messages
           left join users on users.id=messages.from_id
           left join users as users2 on users2.id=messages.to_id WHERE from_id =? OR to_id=?
            GROUP BY messages.from_id order by messages.id DESC ";
            $stmt=$conn->prepare($sql);
            $stmt->execute([$sessid,$sessid]);
            $data=$stmt->fetchAll();
           foreach ($data as $data) {
             # code...
           
           ?>

    <div class="chat_list active_chat">
    
      <div class="chat_people">
        <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
        <div class="chat_ib">
          <h5> <a href="message-new.php?message=<?php echo $data['from_id'] ?>">
        <?php
       
          
        
       
          echo $data['from_name'] ;
        
          
           ?>
         
        </a> <span class="chat_date"><?php echo $data['created_at'] ?></span></h5>
          <p><?php echo $data['message'] ?></p>
        </div>
      </div>
    </div>
    
          <?php  } ?>
         
          
           
          </div>
        </div>
     
      </div>
      
      

      
    </div>
  </div>
    </body>
    
     <script>
     
     let sendmessage = document.getElementById('sendmessage');
sendmessage.addEventListener('click',(e) => {
    e.preventDefault();
    let message = document.getElementById('message').value;
    let to_id = "<?php echo $_GET['message'] ?>";
    const message_send ="message-send.php";
    let formdata = new FormData();
    formdata.append('message',message);
    formdata.append('to_id',to_id);
    fetch(message_send,{
      method:'post',
      body:formdata
    }).then((res) => {res.json()} )
    .then((res) => { console.log(res) })
    .catch((error) => {console.log(error) }) 

    let msg_history = document.getElementsByClassName('msg_history')[0];
    let getdate = new Date().toLocaleString();
     msg_history.innerHTML += `'<div class="outgoing_msg">
             <div class="sent_msg">
               <p>${message}</p>
               <span class="time_date"> ${getdate}</span> </div>
           </div>'`;
           message.value ='';
    
});
     




     </script>

      <?php  include_once 'includes/footer.php';?>