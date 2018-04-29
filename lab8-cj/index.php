<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>AJAX: Sign Up Page</title>

        <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

        <script>
        
            function validateForm() {
                
                return false;
           
            }
            
        </script>
        
        <script>
            $(document).ready(  function(){
                
                $("#username").change(function()
                {
                    //alert(  $("#username").val() );
                    $.ajax({

                        type: "GET",
                        url: "checkUsername.php",
                        dataType: "json",
                        data: { "username": $("#username").val() },
                        success: function(data,status) {
                        
                            //alert(data.password);
                            
                            if (!data) {  //data == false
                                
                                // alert("Username is AVAILABLE!");
                                $("#userMSG").html("Available!");
                                $("#userMSG").css("color", "green");
                                
                            } else {
                                
                                // alert("Username ALREADY TAKEN!");
                                $("#userMSG").html("Not Available!");
                                $("#userMSG").css("color", "red");
                                
                            }
                        
                        },
                        complete: function(data,status) { //optional, used for debugging purposes
                        //alert(status);
                        }
                        
                    });//ajax
                    
                    
                });
                
                 $("#zipCode").change( function(){ 
                    //  alert($("#zipCode").val() ); } );
                    $.ajax({

                        type: "GET",
                        url: "http://itcdland.csumb.edu/~milara/ajax/cityInfoByZip.php",
                        dataType: "json",
                        data: { "zip": $("#zipCode").val() },
                        success: function(data,status) {
                            
                        
                            //alert(data);
                            if(!data){
                                $("#zipMSG").html("Zip-Code not found!");
                                $("#zipMSG").css("color", "red");
                                $("#city").html("");
                                $("#latitude").html("");
                                $("#longitude").html("");
                            }
                            else
                            {
                                $("#zipMSG").html("");
                                $("#city").html(data.city);
                                $("#latitude").html(data.latitude);
                                $("#longitude").html(data.longitude);
                            }
                            
                            
                        
                        },
                        complete: function(data,status) { //optional, used for debugging purposes
                        //alert(status);
                        }
                        
                    });//ajax
                    
                 });

                 
                 $("#state").change( function(){
                    //  alert($("#state").val() ); } );
                   $.ajax({
                       
                       type:"GET",
                       url: "http://itcdland.csumb.edu/~milara/ajax/countyList.php",
                       dataType: "json",
                       data: { "state": $("#state").val() },
                       success: function(data,status){
                        
                            // alert(data[0].county); 
                            $("#county").html("<option> - Select One - </option>");
                            for(var i=0; i<data.length; i++)
                            {
                              $("#county").append("<option>" + data[i].county + "</option>"); 
                            }
                        
                       },
                       complete: function(data,success){
                           
                       }
                   }); 
                    
                });
                
                $("#pwd2").change(function()
                {
                    //alert(  $("#username").val() );
                    $.ajax({

                        type: "GET",
                        url: "checkUsername.php",
                        dataType: "json",
                        data: { "password": $("#password").val() },
                        success: function(data,status) {
                        
                            
                    if($("#pwd").val() == $("#pwd2").val()){
                        $("#pwdMSG").html(" ");
                    
                    }
                    else{
                        $("#pwdMSG").html("Passwords don't match!");
                        $("#pwdMSG").css("color", "red");
                    }
                        
                        },
                        complete: function(data,status) { //optional, used for debugging purposes
                        //alert(status);
                        }
                        
                    });//ajax
                    
                    
                });
                
                
            }); //documentReady
           
            
            
            
        </script>


    </head>

    <body>
    
       <h1> Sign Up Form </h1>
    
        <form onsubmit="return validateForm()">
            <fieldset>
               <legend>Sign Up</legend>
                First Name:  <input type="text"><br> 
                Last Name:   <input type="text"><br> 
                Email:       <input type="text"><br> 
                Phone Number:<input type="text"><br><br>
                Zip Code:    <input type="text" id="zipCode">
                            <span id="zipMSG"></span>
                                                <br>
                City:        <span id="city"></span>
                <br>
                Latitude:    <span id="latitude"></span>
                <br>
                Longitude:   <span id="longitude"></span>
                <br><br>
                State: 
                <select id="state">
                    <option value="">Select One</option>
                    <option value="ca"> California</option>
                    <option value="ny"> New York</option>
                    <option value="tx"> Texas</option>
                    <option value="va"> Virginia</option>
                </select><br />
                
                Select a County: <select id="county"></select><br>
                
                Desired Username: <input type="text" id="username">
                                <span id="userMSG"></span>
                                <br>
                Password: <input type="password" id="pwd"><br>
                
                    Type Password Again: <input type="password" id="pwd2">
                    <span id="pwdMSG"></span><br>
                    
                
                
                <input type="submit" value="Sign up!">
            </fieldset>
        </form>
    
    </body>
</html>