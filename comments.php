<?php
require 'db.php';

$sql="SELECT * FROM comments WHERE parent ='0' ORDER BY comment_id DESC";
$result = $conn->query($sql);
$output = '';
while($row=$result->fetch_assoc()){
    $output .='
    <hr>
    <div class="commented-section mt-2">
    <div class="d-flex flex-row align-items-center commented-user">
        <h5 class="mr-2">'.$row['name'].'</h5> <span class="badge bg-light text-dark">'.$row['time'].'</span>
    </div>
    
    <div class="comment-text-sm"><span>'.$row['comment'].'</span></div>
    
    <div class="reply-section"style=" margin-top:5px; margin-bottom:8px; background-color:; ">
        <div class="d-flex flex-row align-items-center"><button type="button" class="btn btn-secondary reply" id="'.$row["comment_id"].'"> Reply</button> </div>
        <div id="replyform'.$row["comment_id"].'" style="display:none;">
        <div id="alert'.$row["comment_id"].'" ></div>
        <form action="index.php"  method="post" id="reply_form'.$row["comment_id"].'"data-id="'.$row["comment_id"].'" ><div class="mb-3"><label for="exampleFormControlInput1" class="form-label">Name</label><input type="text" class="form-control" name="reply_name" id="reply_name" placeholder="John" required></div><div class="mb-3"><label for="exampleFormControlInput1" class="form-label">Email address</label><input type="email" class="form-control" name="reply_email" id="reply_email" placeholder="name@example.com" required></div><div class="mb-3"><label for="exampleFormControlTextarea1" class="form-label">Comment</label><textarea class="form-control" name="reply_comment" id="reply_comment" rows="3" placeholder="Hello" required></textarea></div><div class="mb-3"><input type="button" class="btn btn-primary submit-reply" onClick="key(this.id)" id="submit'.$row["comment_id"].'" name="submit1'.$row["comment_id"].'" value="Comment" ></div></form>
        </div>
        </div>
    </div>

</div> ';
$output .= get_reply($conn, $row["comment_id"]);
}
echo $output;

function get_reply($conn, $parent_id = 0, $marginleft = 0)
{

    $sql="SELECT * FROM comments WHERE parent ='".$parent_id."' ";
    $result = $conn->query($sql);
 $output = ''; 
 $count = mysqli_num_rows($result);
 if($parent_id == 0)
 {
  $marginleft = 0;
 }
 else
 {
  $marginleft = $marginleft + 48;
 }
 if($count > 0)
 {
  while($row=$result->fetch_assoc())
  {
    $output .='
    
    <div class="commented-section mt-2" style="margin-left:'.$marginleft.'px">
    <div class="d-flex flex-row align-items-center commented-user">
        <h5 class="mr-2">'.$row['name'].'</h5> <span class="badge bg-light text-dark">'.$row['time'].'</span>
    </div>
    <div class="comment-text-sm"><span>'.$row['comment'].'</span></div>
    
</div> ';
  }
 }
 return $output;
}

?>