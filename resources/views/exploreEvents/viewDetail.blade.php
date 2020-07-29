         
              <!-- The Modal to show detail of explore event-->
              <div class="modal fade" id="viewDetail{{$exploreEvent->id}}" style="background-color:lightblue;">
                    <div class="modal-dialog" id="dialog" role="dialog">
                      <div class="modal-content">
                  
                        <!-- Modal body -->
                        <div class="modal-body">
                          <div class="row">
                              <div class="col-6 mt-3">
                                    <img src="{{asset('asset/eventimage/'.$exploreEvent->picture)}}" style="width: 150px; height:150px" id="img">
                              </div>
                              <div class="col-6">
                                    {{$exploreEvent->category->category}}
                                    <h4><b>{{$exploreEvent->title}}</b></h4>
                                    <i class="material-icons">place</i> {{$exploreEvent->city}} <br>
                                    <i class="material-icons">people_outline</i> <br>
                                    <i class="material-icons">person_outline</i> Organized by: {{$exploreEvent->user->firstname}} <br>
                                    <i class="material-icons">access_time</i> {{$exploreEvent->startDate}}-{{$exploreEvent->startTime}}
                                    <a class="btn btn-sm mt-4 float-right delete" style="background: rgb(182, 182, 182)" href="#!"><b><i class="material-icons">access_time</i> Join</b></a>
                              </div>
                          </div>
                        </div>
                        <!-- Modal footer -->
                            <div class="modal-footer"> 
                                <div class="container ml-5">
                                    {{$exploreEvent->description}}
                                </div>
                            </div> 
        
                            </div>
                        </div>
                    </div>