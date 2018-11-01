 $(document).ready(function() {

         //when Habitica Submit Button clicked
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

      // when LeetCode Submit Button clicked
       $("#leetcode_info_submit").click(function( event ) {
         if($('#username').val() && $('#password').val()){
            console.log("leetcode button clicked & fields populated");
             localStorage.user = $('#username').val();
             console.log(localStorage.user);
             localStorage.pass = $('#password').val();
             console.log(localStorage.pass);
             leet_params = {username: localStorage.user, password: localStorage.pass};
             localStorage.leet_stats = leetcode_do(leet_params);
             leet_subs = JSON.parse(localStorage.leet_stats);
             console.log(leet_subs);
        }
       });

     // Updates habitica habit -- MAKES AJAX CALL TO HABITICA_DATA
     // Object params depends on type of action. Currently two actions supported: "change_habit" | "get_stats"
     // change_habit required variables: task_name (string), direction ('up' | 'down'), user_id (string), api_tok (string)
     // get_stats required variables: user_id (string), api_tok (string)
     //
     function habitica_do(params, action){
       console.log("habitica - start ajax call");
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

     // Gets LeetCode submissions by calling leetcode_data.php, getting
     //  submissions and returning to submit button click
     function leetcode_do(params){
       console.log("leetcode - start ajax call");
        return_val = false;
        $.ajax({
         url:'leetcode_data.php',
         data:{data_params: params},
         async: false,
         success: function(data){
             if(data == 'ERROR'){
                return_val = false;
                console.log(return_val);
             }else{
                 return_val = data;
                 console.log(return_val);
             }
             $('#user_id').val('');
             $('#api_token').val('');
         }
        });
        return return_val;
     }

     //update site with user stats
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
