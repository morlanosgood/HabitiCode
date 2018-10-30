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
              console.log("have user_stats");
              console.log(user_stats);
            }
          });
            //
    // Updates habitica habit -- MAKES AJAX CALL
    // Object params depends on type of action. Currently two actions supported: "change_habit" | "get_stats"
    // change_habit required variables: task_name (string), direction ('up' | 'down'), user_id (string), api_tok (string)
    // get_stats required variables: user_id (string), api_tok (string)
    //
    function habitica_do(params, action){
      console.log("start ajax call");
       return_val = false;
       $.ajax({
        url:'habit_data.php',
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
       console.log("end ajax call");
       return return_val;
    }
 });
