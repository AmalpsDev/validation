@extends('adminlayout.adminbar')
@section('content')


<div class="container">
  <div class="row mb-5">
    <div class="col-md-3"></div>
    <div class="col-lg-5 col-sm-12">
       <div class="card mt-5">
        <div class="card-header">
            <h3 class="text-secondary">Register</h3>
        </div>
        <div class="card-body">
          <form>
  <div class="form-group mb-2">
    <label for="name">Name</label>
    <input type="name" class="form-control" id="name"  placeholder="Enter name">
    <span id="name-req" style="color:red; display:none;">Required</span>
    
  </div>
  <div class="form-group mb-2">
    <label for="email">Email</label>
    <input type="email" class="form-control"  placeholder="Enter email" id="emailid" maxlength="255" onblur="checkEmail(this.value)">
    <span id="email-req" style="color:red; display:none;">Required</span>
    <div id="check_email"></div>
    <div id="valid_email"></div>
  </div>
  <div class="form-group mb-2">
    <label for="password">Password</label>
    <input type="password" class="form-control"  placeholder="Enter Password" id="password1">
    <span id="pass" style="color:red; display:none;">Required</span>
  </div>
  <div class="form-group mb-5">
    <label for="password">Re-enter Password</label>
    <input type="password" class="form-control"  placeholder="Re-enter Password" id="password2">
    <span id="pass2" style="color:red; display:none;">Required</span>
  </div>
  
  
  <input type="button" onclick="Register()" value="Register" class="btn btn-success">
</form>
           
              
           
        
    </div>
</div>
    </div>
  </div>
</div>

   
@stop
  
  
    
   
   <script>
   function checkEmail(str)
{
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if(!re.test(str)){
      $("#valid_email").html("Please enter a valid email address").css("color","red");
    }else{
       $("#valid_email").html("").css("color","white");
    }
    
}

    
    function Register(){
      
     var name=$('#name').val();
     var email=$('#emailid').val();
     var password1=$('#password1').val();
     var password2=$('#password2').val();

     if(name==''){
      $('#name-req').show();
      return false;
     }else{
      $('#name-req').hide();
     }
     if(email==''){
      $('#email-req').show();
      return false;
     }else{
      $('#email-req').hide();
     }
     if(password1==''){
      $('#pass').show();
      return false;
     }else{
      $('#pass').hide();
     }
     if(password2==''){
      $('#pass2').show();
      return false;
     }else{
      $('#pass2').hide();
          if(password2!=password1){
              
              swal({
  icon: 'error',
  title: 'Password Not Match',
  text: 'Something went wrong!'
  
})
              return false;
          }
      
     }
     APP_URL ="{{ URL::to('/')}}";
     $.ajax({
            url: APP_URL + "/registration",
            method: 'POST',
            data: {
                'action': 's',
                'name':name,
                'email':email,
                'password1':password1,

                
                '_token': "{{ csrf_token() }}"
            },
            dataType: 'JSON',
            success: function(result) {
                
                if(result==1){
                        swal(
                        'Successfully Registered!',
                        'You clicked the button!',
                        'success'
                        )
                }else if(result==2){
                      swal({
                      icon: 'error',
                      title: 'Registration Failed',
                      text: 'Something went wrong!',
                      
                      })
                }else if(result==3){
                            swal({
                            title: 'Email Id already Exists',
                            showClass: {
                            popup: 'animate__animated animate__fadeInDown'
                            },
                            hideClass: {
                            popup: 'animate__animated animate__fadeOutUp'
                            }
                            })
                }
              
            },
            error: function() {
                swal("Failed!", "Something went wrong", "error");
            }
        });

     
    
    }
   </script>
  
 
</body>
</html>