       <script type="text/javascript">
        $(document).ready(function(){
            
            
            //if submit button is clicked
            $('#submit').click(function () {
              
                $nameErr = "";
                // Captcha is Passed
                //Get the data from all the fields
                var appname = $('input[name=appname]');
                var playlink = $('input[name=playlink]');
                var applink = $('input[name=applink]');
                var mslink = $('input[name=mslink]');
                var bblink = $('input[name=bblink]');

                alert("TEST -1: "+appname.val());
        
                //Simple validation to make sure user entered something
                //If error found, add hightlight class to the text field
                if (appname.val()=='') {
                    //appname.addClass('hightlight');
                    $nameErr = "Name is required";
                    alert("ERROR!");
                } 
                
                /*if (playlink.val()=='') {
                    playlink.addClass('hightlight');
                    return false;
                } else playlink.removeClass('hightlight');
                
                if (playlink.val()=='') {
                    applink.addClass('hightlight');
                    return false;
                } else applink.removeClass('hightlight');
                
                if (mslink.val()=='') {
                    mslink.addClass('hightlight');
                    return false;
                } else mslink.removeClass('hightlight');
                
                if (bblink.val()=='') {
                    bblink.addClass('hightlight');
                    return false;
                } else bblink.removeClass('hightlight');*/

                alert("TEST 0: "+appname.val() +"playlink "+playlink.val() +" applink "+applink.val());
                
                //organize the data properly
                //var data = 'name=' + appname.val() + '&email=' + email.val() + '&phonenumber=' + phonenumber.val() + '&message=' + encodeURIComponent(message.val());
                
                var data = 'Appname=' + appname.val();

                alert("TEST 1: "+data);
                //disabled all the text fields
                $('.text').attr('disabled','true');
                
                //show the loading sign
                document.getElementById("submit").disabled=true;
                document.getElementById("submit").value='Please Wait..';
                
                //start the ajax
                $.ajax({
                    //this is the php file that processes the data and send mail
                    url: "contact-form.php",    
                    
                    //GET method is used
                    type: "POST",
        
                    //pass the data         
                    data: data,     
                    
                    //Do not cache the page
                    cache: false,
                    
                    //success
                    success: function(result){
                                //hide the form
                            $('.contact-form-div').fadeOut('slow');                 
                            
                            //show the success message
                            $('.done').fadeIn('slow');
                                    }
                    
                });
                //cancel the submit button default behaviours
                return false;
                
            }); 
        })
        </script>
