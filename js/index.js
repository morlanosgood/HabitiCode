 $(document).ready(function() {
         console.log("outside call")
         //upon Habitica Submit Button clicked
         $("#habitica_info_submit").click(function( event ) {
           console.log("submit registered")
           //store user id & api token
           if($('#user_id').val() && $('#api_token').val()){
               localStorage.hab_user_id  = $('#user_id').val();
               localStorage.hab_api_tok = $('#api_token').val();
               hab_params = {user_id: localStorage.hab_user_id, api_tok: localStorage.hab_api_tok};
               localStorage.hab_stats = habitica_do(hab_params,"get_stats");
               user_stats = JSON.parse(localStorage.hab_stats);

               if(user_stats.error){
                  $('#hab_output').html(user_stats.error);
                  $('#hab_output').fadeIn();
                  $('#hab_output').fadeOut(5000);
              }else{
                  update_habitica_html(user_stats);

                  $('#hab_output').html('api info updated');
                  $('#hab_output').fadeIn();
                  $('#hab_output').fadeOut(5000);
              }
          }else{
              $('#hab_output').html('please fill out both fields!');
              $('#hab_output').fadeIn();
              $('#hab_output').fadeOut(5000);
          }
          event.preventDefault();
        });


     // Updates habitica habit -- MAKES AJAX CALL
     // Object params depends on type of action. Currently two actions supported: "change_habit" | "get_stats"
     // change_habit required variables: task_name (string), direction ('up' | 'down'), user_id (string), api_tok (string)
     // get_stats required variables: user_id (string), api_tok (string)
     //
     function habitica_do(params, action){
       console.log("start ajax call");
        return_val = false;
        $.ajax({
         url:'habitica_data.php',
         data:{data_params: params, action: action},
         async: false,
         success: function(data){
             if(data == 'ERROR'){
                return_val = false;
             }else{
                 return_val = data;
             }
             $('#user_id').val('');
             $('#api_token').val('');
         }
        });
        return return_val;
     }

     function update_habitica_html(user_stats){
        $('#hab_name').html(user_stats.habitRPGData.data.profile.name);
        $('#hab_class').html(user_stats.habitRPGData.data.stats.class);
        $('#hab_level').html(user_stats.habitRPGData.data.stats.lvl);

        $('#hab_name').fadeIn();
        $('#hab_class').fadeIn();
        $('#hab_level').fadeIn();

        $('#hab_xp_bar').css("width",(user_stats.habitRPGData.data.stats.exp/user_stats.habitRPGData.data.stats.toNextLevel)*100 + "%");
        $('#hab_xp_prog').html(user_stats.habitRPGData.data.stats.exp + "/" + user_stats.habitRPGData.data.stats.toNextLevel);
    }

  });
