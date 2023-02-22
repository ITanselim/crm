
  <!-- page content -->

     <div class="right_col" role="main">

          <!-- top tiles -->

          <div class="row" style="display: inline-block;" >

          <div class="tile_count">

            

            <div class="col-md-12 col-sm-4  tile_stats_count">

              <span class="count_top"><i class="fa fa-user"></i> Total Call logs</span>

              <div class="count total_call_logs">0.00</div>

            </div>


          </div>

        </div>

           <div class="row ml-3" style="display: inline-block;" >

          <div class="tile_count">

            

            <div class="col-md-12 col-sm-4  tile_stats_count">

              <span class="count_top"><i class="fa fa-user"></i> Total Average Call logs</span>

              <div class="count total_average_call_logs">0.00</div>

            </div>
            

          </div>


        </div>

        <div class="row ml-3" style="display: inline-block;" >

          <div class="tile_count">

            

            <div class="col-md-12 col-sm-4  tile_stats_count">

              <span class="count_top"><i class="fa fa-user"></i> Total Phone Time Call logs</span>

              <div class="count total_time_average_call_logs">0.00</div>

            </div>
            

          </div>


        </div>


        <div class="row ml-5" style="display: inline-block;" >

          <div class="tile_count">

            

            <div class="col-md-12 col-sm-4  tile_stats_count">

              <span class="count_top"><i class="fa fa-user"></i> Average Phone Time Call logs</span>

              <div class="count total_average_handling_call_logs">0.00</div>

            </div>
            

          </div>


        </div>




        


          <form id="call_logs_form">

             <div class="col-sm-3 inline-block">

                <label for="validationCustom03">Date</label>

                  <div id="call_log_reportrange" style="background: #fff; cursor: pointer; padding: 10px 15px; border: 1px solid #ccc;" >

                      <i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;

                      <span></span> <b class="caret"></b>

                     </div><!-- DEnd ate Picker Input -->            

              </div>

                   <div class="col-sm-3 inline-block">

                       <input type="hidden" class="form-control" name="from_date" placeholder="from_date" required="required">
                       <input type="hidden" class="form-control" name="to_date" placeholder="to_date" required="required">

                 </div>

            </form>



      <br>



          <!-- /top tiles -->



  <div class="card mb-3">



          <div class="card-header">



            <i class="fa fa-table"></i>List of Agent Users



              <div style="float:right; ">



      </div>



  </div>



          <div class="card-body">



          <div class="table-responsive">



            <table class="table table-bordered" id="call_log_historytable" width="100%" cellspacing="0">



                    <thead>



                      <tr>



                        <th>Type</th>



                        <th>From</th>



                        <th>To</th>



                        <th>Ext</th>



                        <th>Area</th>



                        <th>Date/Time</th>


                         <th style="display: none;">Date</th>



                        <th>Action</th>



                        <th>Result</th>



                        <th class="average_time">Length</th>



                      </tr>



                    </thead>



                    <tbody class="test_table">






                    </tbody>


                  </table>


                 </div>



                </div>



              </div>



           </div>



