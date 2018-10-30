$(document).ready(function() {
        console.log("outside call")
        //upon Habitica Submit Button clicked
        $("#habitica_info_submit").click(function( event ) {
          console.log("submit registered")
          //store user id & api token
          if($('#user_id').val() && $('#api_token').val()){
              localStorage.hab_user_id  = $('#user_id').val();
              localStorage.hab_api_tok = $('#api_token').val();
              console.log('https://habitica.com/api/v3/members/'+ localStorage.hab_user_id);
              $.when(
                $.ajax({
                  url: 'https://habitica.com/api/v3/members/'+ localStorage.hab_user_id,
                  type: 'GET',
                  dataType: 'json',
                  cache: false,
                  // beforeSend: function(xhr){
                  //         xhr.setRequestHeader('x-api-user', localStorage.hab_user_id);
                  //         xhr.setRequestHeader('x-api-key',    localStorage.hab_api_tok);
                  //     },
                  success: function(data){
                       console.log("successful ajax call")
                       if(data == 'ERROR'){
                         console.log("ran into error")
                          user_stats = false;
                       }else{
                           user_stats = data;
                           console.log(data);
                       }
                  }
                })
              ).done(function(){
                  user_stats = JSON.parse(user_stats);
                  console.log("have user_stats");
                  console.log(user_stats);

                  if(!user_stats.success){
                    console.log("something went wrong")
                      $('#hab_output').html(user_stats.message);
                      $('#hab_output').fadeIn();
                      $('#hab_output').fadeOut(5000);
                  }else{
                      console.log("something went right")
                      update_habitica_html(user_stats);

                      $('#hab_output').html('api info updated');
                      $('#hab_output').fadeIn();
                      $('#hab_output').fadeOut(5000);
                  }
            });
            event.preventDefault();
      }else{
          $('#hab_output').html('please fill out both fields!');
          $('#hab_output').fadeIn();
          $('#hab_output').fadeOut(5000);
        }
     });
 });
