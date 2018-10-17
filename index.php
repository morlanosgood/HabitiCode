<!DOCTYPE html>
<html lang="en">
      <head>
       <title>HabitiCode</title>
         <script src="js/jquery-2.1.4.min.js"></script>
         <script src="js/bootstrap.min.js"></script>
         <script src="js/index.js"></script>
         <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
         <link rel="stylesheet" href="css/app.css" type="text/css" />
      </head>
      <body>
        <!--  TOP BANNER-->
        <div class="container-fluid">
          <div class="row" style="height: 250px">
            <div class="col bg-purple"></div>
            <div class="col-7 text-white bg-purple">
              <br>
              <h1 class="text-center"> Welcome to HabitiCode</h1>
              <br>
              <h5 class="text-lavender text-center"> Our goal is to make technical interview preparation more engaging by enabling users to easily gamify the process. HabitiCode will connect Habitica with LeetCode to create and update goals in Habitica that will earn you points. By following the directions below, you will be auto-awarded coins in Habitica for your progress in LeetCode.</h5>
            </div>
            <div class="col bg-purple"></div>
          </div>
          <!-- Directions Row -->
          <div class="row align-items-center" style="height: 175px">
              <div class="col-3"></div>
              <div class="col">
                <h4>Directions:</h4>
                <h6> 1.) Log into LeetCode using the button on the right</h6>
                <h6> 2.) Input your Habitica User ID and API Token located in Settings -> API and click Submit</h6>
                <h6> 3.) Enter the metrics you want to track (and click the checkbox) and click Submit</h6>
              </div>
              <div class="col-3"></div>
          </div>
        </div>
          <!-- 3 COLS BELOW -->
          <div  class="container">
            <div class="row">
              <!-- LeetCode Column -->
              <div class="col pt-2">
                <img src="img/leetcode_logo.png" class="mx-auto d-block" alt="..." style="max-height: 100px; max-width: 100px;">
                <h5 class="text-center">Enter LeetCode Data Here:</h5>
                <div class="col justify-content-center">
                  <a href="" class="btn btn-secondary d-block mx-5">Login to LeetCode</a>
                </div>
                <div class="container" id="main_view">
                  <div class="row">
                    <div class="col fitbit-color text-center">
                      <a class="btn btn-default" id="get-data">Refresh LeetCode Data</a><br>
                      <br>
                      <h6>Problems Attempted Today: <span id="attempted"></span></h6>
                      <h6>Problems Solved Today: <span id="solved"></span></h6>
                      <h6>Miles Walked Today: <span id="miles"></span></h6>
                    <br>
                    <a href="/" class="btn btn-danger" id="logout">Reset All Data (logout)</a><br>
                </div>
                </div>
             </div>
                <h4 class="control-label">
              </div>
              <!--  Goal Stats Column -->
              <div class="col pt-4">
                   <div class="form-group">
                      <h5 class="control-label">Select the Metrics You Want to Track!</h5>
                      <br>
                      <div class="row px-2">
                        <div class="input-group">
                          <div class="col-1 bg-lavender rounded-left border-right-0"><span class="input-group-addon center">
                                <input type="checkbox" aria-label="..." id="track_problems">
                            </span></div>
                          <div class="col-4 bg-lavender rounded-0 border-left-0 border-right-0 px-0"><input type="text" id="problems_value" class="form-control"></div>
                          <div class="col-6 bg-lavender rounded-right border-left-0"><span class="input-group-addon">problems attempted</span></div>
                          <div class="col-1"></div>
                        </div>
                    </div>
                    <br>
                    <div class="row align-items-center px-2">
                        <div class="input-group">
                          <div class="col-1 bg-lavender rounded-left border-right-0"><span class="input-group-addon center">
                                <input type="checkbox" aria-label="..." id="track_solved">
                            </span></div>
                          <div class="col-4 bg-lavender border-left-0 border-right-0 px-0"><input type="text" id="solved_value" class="form-control"></div>
                          <div class="col-6 bg-lavender rounded-right border-left-0"><span class="input-group-addon">problems solved</span></div>
                          <div class="col-1 bg-light"></div>
                        </div>
                    </div>
                  </div>
                  <h5 class="btn btn-secondary" id="update_submit">Submit</h5>
                  </div>
                    <!-- <h3 id="up_output" style="display:none"></h3> -->
              <!-- Habitica Column -->
              <div class="col pt-3">
                <img src="img/habitica_logo.png" class="mx-auto d-block" alt="..." style="max-height: 100px; max-width: 100px;">
                <h5 class="text-center pt-1">Enter Habitica Data Here:</h5>
                 <div class="form-group">
                      <label class="control-label">User ID</label>
                      <input  class="form-control" type="text" id="user_id"/>
                      <br>
                      <label class="control-label">API Token</label>
                     <input class="form-control" name="searchTxt" type="password" id="api_token"/><br>
                     <h5 class="btn btn-secondary" id="habitica_info_submit">Submit</h5>
                 </div>
                 <!-- <h3 id="hab_output" style="display:none"></h3> -->
              </div>
            </div>
        </div>
      </body>
 </html>
