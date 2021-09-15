

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.6.0.js"integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
    <title>Comment form</title>
  </head>
  <body>
  <div class="container mt-5 mb-5" >
    <div class="d-flex justify-content-center row">
        <div class="d-flex flex-column col-md-8 p-2 bg-white border-bottom px-4">
              <center><h3>Comments</h3></center>
              <div id="alerts"></div>
              <form  method="post" id="comment_form" >
            <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Name</label>
  <input type="text" class="form-control" name="name" id="name" placeholder="John" required>
</div>
  <div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Email address</label>
  <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" required>
</div>
<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Comment</label>
  <textarea class="form-control" name="comment" id="comment" rows="3" placeholder="Hello" required></textarea>
</div>
<div class="mb-3">
<input type="hidden" name="comment_id" id="comment_id" value="0" />
<input type="button" class="btn btn-primary"  id="submit" name="submit" value="Comment" >


</div>
</form>

<div id="display_comment"></div>
     

<script>
  $(document).ready(function(){
    load_comment();
    
   $('#submit').on('click', function(e) {
    e.preventDefault();
  var name = $('#name').val();
		var email = $('#email').val();
		var comment = $('#comment').val();

		if(name!="" && email!="" && comment!="" && validateEmail(email) ){
      document.getElementById('alerts').innerHTML = '<div class="alert alert-success" role="alert">Commented!</div>';
          $.ajax({
          url:"/comment.php",
          method:"POST",
          data:{
                  name: name,
                  email: email,
                  comment: comment, 
                  comment_posted: 1,      
                },
                  cache: false,

   success:function(data)
   {
      $('#comment_form')[0].reset();
      load_comment();
    
  }
  })
}
else
   {
    document.getElementById('alerts').innerHTML = '<div class="alert alert-danger" role="alert">Dont leave empty fields or check your email!</div>';
   }
 });


function load_comment()
 {
  $.ajax({
   url:"/comments.php",
   method:"POST",
   success:function(output)
   {
    $('#display_comment').html(output);
   }
  })
 }
 function validateEmail(email) 
    {
        var re = /\S+@\S+\.\S+/;
        return re.test(email);
    }
   
   
  
    $(document).on('click', '.reply', function(e){
      
       
      e.preventDefault();
  var comment_id = $(this).attr("id");

  
  document.getElementById('replyform'+comment_id).style.display = 'inline';
  
  $(document).one('click', '.submit-reply', function(e){
    
    e.preventDefault();

    var reply_name = $('#reply_name').val();
		var reply_email = $('#reply_email').val();
		var reply_comment = $('#reply_comment').val();
    if(reply_name!="" && reply_email!="" && reply_comment!="" && validateEmail(reply_email) ){
    $.ajax({
          url:"comment.php",
          method:"POST",
          data:{
                  comment_id: comment_id,
                  reply_name: reply_name,
                  reply_email: reply_email,
                  reply_comment: reply_comment, 
                  reply_posted: 1,      
                },
                  cache: false,
   success:function(data)
   {
      $('#comment_form')[0].reset();
      
      load_comment();
    
  }
  })
    }
    else {
    document.getElementById('alert'+comment_id).innerHTML = '<div class="alert alert-danger" role="alert">Dont leave empty fields or check your email!</div>';
    }
  })
   
 });

    

   


});
  </script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

  </body>
</html>
