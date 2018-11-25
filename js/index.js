$(document).ready(function() {
  var popup;
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

     // when Codewars Submit Button clicked
      $("#codewars_info_submit").click(function( event ) {
        if($('#username').val()){
           console.log("codewars button clicked & fields populated");
            localStorage.code_user = $('#username').val();
            console.log(localStorage.code_user);
            localStorage.code_stats = codewars_do(localStorage.code_user);
            code_subs = JSON.parse(localStorage.code_stats);
            console.log("click method");
            console.log(code_subs);
            console.log(code_subs['codeChallenges']['totalCompleted']);
            // if (!localStorage.old_completed){
            //   localStorage.old_completed = code_subs['codeChallenges']['totalCompleted'];
            //   console.log(localStorage.old_completed);
            // }

       }
      });

      //when Goals button clicked
      $("#update_submit").click(function( event ) {
        localStorage.num_complete = $('#completed_value').val(); // int
        num_complete = $('#completed_value').val(); // int
        localStorage.track_complete = $('#track_complete').val(); //bool
        localStorage.task_name = "Codewar - complete " + num_complete + "challenges";
      });

      //repeat while window is open!
      window.setInterval(function(){
        //check that all necessary data is inputted
        if (localStorage.hab_user_id && localStorage.hab_api_tok && localStorage.task_name && localStorage.code_user){
          //see if we should increment tasks
          localStorage.code_stats = codewars_do(localStorage.code_user);
          code_subs = JSON.parse(localStorage.code_stats);
          localStorage.new_completed = code_subs['codeChallenges']['totalCompleted'];
          console.log(localStorage.new_completed);
          if (localStorage.new_completed > localStorage.old_completed){
            diff = localStorage.new_completed - localStorage.old_completed;
            hab_params = {user_id: localStorage.hab_user_id, api_tok: localStorage.hab_api_tok, task_name: localStorage.task_name, direction: "up"};
            //increment habit diff times
            for (var i = 0; i < diff; i++){
              localStorage.hab_goal[i] = habitica_do(hab_params, "change_habit");
            }
            //should check if any failed
            localStorage.old_completed = localStorage.new_completed;
          }
      }}, 30000)


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

    // Gets Codewars submissions by calling leetcode_data.php, getting
    //  submissions and returning to submit button click
    function codewars_do(username){
      console.log("codewars - start ajax call");
       return_val = false;
       $.ajax({
        url:'codewars_data.php',
        data:{username: username},
        async: true,
        success: function(data){
            if(data == 'ERROR'){
               return_val = false;
               console.log(return_val);
            }else{
                return_val = data;
                console.log(return_val);
            }
        },
        error: function(data){
          console.log("ERROR WITH AJAX CALL");
          console.log(data);
        }
       });
       console.log("I have finished the ajax call - codewars");
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

//----------------------------------LEETCODE METHODS----------------------------
   // // when LeetCode Login Button clicked
   // $("#login").click(function( event ) {
   //      	popup = window.open("https://leetcode.com/accounts/login", "", "width=500,height=500");
   //        console.log("I've hit the leetcode url");
   //        console.log(popup.location.href);
   //        console.log(typeof popup);
   //        console.log(popup.closed);
   //        checkPopup();
   //      });


    // // Gets LeetCode submissions by calling leetcode_data.php, getting
    // //  submissions and returning to submit button click
    // function leetcode_do(){
    //   console.log("leetcode - start ajax call");
    //    return_val = false;
    //    $.ajax({
    //     url:'leetcode_data.php',
    //     // data:{data_params: params},
    //     async: true,
    //     success: function(data){
    //         if(data == 'ERROR'){
    //            return_val = false;
    //            console.log(return_val);
    //         }else{
    //             return_val = data;
    //             console.log(return_val);
    //         }
    //         $('#user_id').val('');
    //         $('#api_token').val('');
    //     },
    //     error: function(data){
    //       console.log("ERROR WITH AJAX CALL");
    //       console.log(data);
    //     }
    //    });
    //    console.log("I have finished the ajax call");
    // }


   // //Get's Popup window's status
   // function checkPopup() {
   //     if(popup.closed) {
   //         console.log("the popup has closed");
   //         leetcode_do();
   //     } else {
   //       window.setTimeout(checkPopup, 1000);
   //       console.log("the popup is open");
   //     }
   // }
 });
