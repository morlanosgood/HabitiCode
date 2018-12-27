$(document).ready(function() {
  localStorage.hab_is_valid = false;
  localStorage.code_is_valid = false;

        //testing scheduler
        $("#test_scheduler").click(function( event ) {
          $.ajax({
           url:'scheduler.php',
           async: false,
           success: function(data){
               if(data == 'ERROR'){
                  return_val = false;
               }else{
                 return_val = data;
                 return return_val;
               }
           },
           error: function(data){
             console.log("ERROR WITH AJAX CALL");
             console.log(data);
           }
         });
          return return_val;
        });

        //when Habitica Submit Button clicked
        $("#habitica_info_submit").click(function( event ) {
          console.log("submit registered");
          //store user id & api token
          if($('#user_id').val() && $('#api_token').val()){
              localStorage.hab_user_id  = $('#user_id').val();
              localStorage.hab_api_tok = $('#api_token').val();
              hab_params = {user_id: localStorage.hab_user_id, api_tok: localStorage.hab_api_tok};
              //make call to get info
              localStorage.hab_stats = habitica_do(hab_params,"get_stats");
              user_stats = JSON.parse(localStorage.hab_stats);
              console.log(user_stats);
              //state if there is an error
              if(user_stats.error){
                 $('#hab_output').html(user_stats.error);
                 $('#hab_output').fadeIn();
                 $('#hab_output').fadeOut(5000);
             }else{
               //show info to user
                 update_habitica_html(user_stats);
                 localStorage.hab_is_valid = true;
                 $('#hab_output').html('api info updated');
                 $('#hab_output').fadeIn();
                 $('#hab_output').fadeOut(5000);
             }
         }else{
           //if don't have both fields
             $('#hab_output').html('please fill out both fields!');
             $('#hab_output').fadeIn();
             $('#hab_output').fadeOut(5000);
         }
         event.preventDefault();
       });

     // when Codewars Submit Button clicked
      $("#codewars_info_submit").click(function( event ) {
        if($('#username').val()){
           console.log("codewars button clicked & fields populated");
            localStorage.code_user = $('#username').val();
            console.log(localStorage.code_user);
            //make call to get info
            localStorage.code_stats = codewars_do(localStorage.code_user);
            code_subs = JSON.parse(localStorage.code_stats);
            if(code_subs.success == 'false'){
               $('#code_output').html(code_subs.reason);
               $('#code_output').fadeIn();
               $('#code_output').fadeOut(5000);
            }else{
             //show info to user
              localStorage.code_completed = code_subs.codeChallenges.totalCompleted;
              localStorage.code_is_valid = true;
               $('#code_output').html('api info updated');
               $('#code_output').fadeIn();
               $('#code_output').fadeOut(5000);
               $('#code_completed').html(localStorage.code_completed);
            }
            }else{
            //if don't have anything in the field
            $('#code_output').html('please fill out the field!');
            $('#code_output').fadeIn();
            $('#code_output').fadeOut(5000);
            }
            event.preventDefault();
      });

      //when Goals button clicked
      $("#update_submit").click(function( event ) {
        //keep track of goal values
        localStorage.num_complete = $('#completed_value').val(); // int
        console.log(localStorage.num_complete);
        localStorage.track_complete = $('#track_complete').val(); //bool
        localStorage.task_name = "Codewars - complete " + localStorage.num_complete + " challenges";
        //Have both CodeWars and Habitica Info that is valid
        if(localStorage.code_is_valid && localStorage.hab_is_valid){
          //make call to get info
          hab_params = {user_id: localStorage.hab_user_id, api_tok: localStorage.hab_api_tok, task_name: localStorage.task_name};
          localStorage.check_hab = habitica_do(hab_params,"check_habit");
          console.log(localStorage.check_hab);
          //Comunicate with database
          res = database_connect();
          //tell users they are all set
        //  $('#goals_output').html('values updated. HabitiCode will now update hourly.');
        //  $('#goals_output').fadeIn();
      }else if (!localStorage.code_is_valid){
          $('#goals_output').html('please provide a valid CodeWars Username and then try again.');
          $('#goals_output').fadeIn();
          $('#goals_output').fadeOut(5000);
      }else if (!localStorage.hab_is_valid){
          $('#goals_output').html('please provide valid Habitica values and then try again');
          $('#goals_output').fadeIn();
          $('#goals_output').fadeOut(5000);
        }
      });

    // Updates habitica habit -- MAKES AJAX CALL TO HABITICA_DATA
    // Object params depends on type of action. Currently two actions supported: "change_habit" | "get_stats"
    // change_habit required variables: task_name (string), direction ('up' | 'down'), user_id (string), api_tok (string)
    // get_stats required variables: user_id (string), api_tok (string)
    function habitica_do(params, action){
      console.log("start habitica_do");
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
             return return_val;
           }
          // $('#user_id').val('');
          // $('#api_token').val('');
       },
       error: function(data){
         console.log("ERROR WITH AJAX CALL");
         console.log(data);
       }
     });
      return return_val;
   }

    // Gets Codewars submissions by calling codewars_data.php, getting
    //  submissions and returning to submit button click
    function codewars_do(username){
      console.log("codewars - start ajax call");
       return_val = false;
       $.ajax({
        url:'codewars_data.php',
        data:{username: username},
        async: false,
        success: function(data){
            if(data == 'ERROR'){
               return_val = false;
            }else{
                return_val = data;
                return return_val;
            }
        },
        error: function(data){
          console.log("ERROR WITH AJAX CALL");
          console.log(data);
        }
       });
       console.log("I have finished the ajax call - codewars");
       console.log(return_val);
       return return_val;
    }

    function database_connect(){
      console.log("start database_connect()");
      return_val = false;
      params = {hab_user: localStorage.hab_user_id, hab_key: localStorage.hab_api_tok, code_complete: localStorage.code_completed, code_goal: localStorage.num_complete, code_user: localStorage.code_user};
      $.ajax({
       url:'database_data.php',
       data:{data_params: params},
       async: false,
       success: function(data){
           if(data == 'ERROR'){
              return_val = false;
              console.log(data);
           }else{
             console.log(data);
             return_val = data;
           }
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
