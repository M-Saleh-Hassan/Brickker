@extends('tashtebk.arabic.layouts.master')

@section('content') 
    <main>
      <div class="messaging" >
        <h3 class="text-center">الرسائل</h3>
        <div class="container inbox_msg">
            <div class="row">
                <div class="col-md-4 col-xs-4 inbox_people" style="padding: 0">
                <div class="headind_srch">
                    <h4>الأحدث</h4>
                 </div>
                  <div class="tab ">
                    @foreach(Auth::User()->chatUsers() as $user)
                    <button class="tablinks chat_list" onclick="openChat(event, 'chat-{{$user->id}}')" id="defaultOpen">
                        <div class="chat_people">
                          <div class="chat_img"> <img src="{{asset('') . $user->avatar}}" alt=""> </div>
                          <div class="chat_ib">
                            <h5>{{$user->username}} <span class="chat_date">{{--Dec 25--}}</span></h5>
                            <!--<p>Test, which is a new approach to have all solutions -->
                            <!--  astrology under one roof.</p>-->
                          </div>
                        </div>
                    </button>
                    @endforeach
                  </div>
                </div>
                <div class="col-md-8 col-xs-8 mesgs">
                    @foreach(Auth::User()->chatUsers() as $user)
                    <div id="chat-{{$user->id}}" class="tabcontent">
                        <div class="msg_history ">
                          @foreach(Auth::User()->getUserMessages($user->id) as $message)
                            @if($message->to->id == Auth::User()->id)
                              <div class="incoming_msg">
                                <div class="incoming_msg_img"> <img src="{{asset('') . $message->from->avatar}}" alt=""> </div>
                                <div class="received_msg">
                                  <div class="received_withd_msg">
                                    <p>{{$message->message}}</p>
                                    <!--<span class="time_date"> 11:01 AM    |    June 9</span></div>-->
                                    <span class="time_date">{{$message->created_at}}</span>
                                  </div>
                                </div>
                              </div>
                            @else
                              <div class="outgoing_msg">
                                <div class="sent_msg">
                                  <p>{{$message->message}}</p>
                                  <!--<span class="time_date"> 11:01 AM    |    June 9</span> </div>-->
                                  <span class="time_date">{{$message->created_at}}</span> </div>
                              </div>
                            @endif
                          @endforeach
                        </div>
                          <div class="type_msg">
                            <div class="input_msg_write">
                                <form class="form-horizontal" method="POST" action="{{ route('ar.chat.send') }}" enctype="multipart/form-data">
                                    @csrf

                                  <input type="text" name="message" class="write_msg" placeholder="اكتب رسالتك ..." />
                                  <input type="hidden" name="user" value="{{$user->id}}" />
                                  <button class="msg_send_btn" type="submit"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                                </form>
                            </div>
                          </div>
                    </div>
                    @endforeach

                </div>
              </div>
        </div>
        
      </div>

      <!--<div class="chat-window col-xs-9 col-sm-4 col-md-3"  id="chat_window_1">-->
      <!--    <div class="panel panel-default" >-->
      <!--        <a class="chat-close" href="#"><span class="glyphicon glyphicon-remove icon_close" data-id="chat_window_1"></span></a>-->
      <!--        <div class="panel-heading top-bar" >-->
      <!--            <h3 class="panel-title"><span class="glyphicon glyphicon-comment"></span> Chat </h3>-->
      <!--            <a href="#" class="text-right"><span id="minim_chat_window" class="glyphicon glyphicon-minus icon_minim"></span></a>-->
      <!--        </div>-->
      <!--        <div class="panel-body msg_container_base">-->
      <!--          <div class="contain-chat">-->
      <!--            <div class="incoming_msg">-->
      <!--                <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>-->
      <!--                <div class="received_msg">-->
      <!--                  <div class="received_withd_msg">-->
      <!--                    <p>Test, which is a new approach to have</p>-->
      <!--                    <span class="time_date"> 11:01 AM    |    Yesterday</span></div>-->
      <!--                </div>-->
      <!--              </div>-->
      <!--              <div class="outgoing_msg">-->
      <!--                <div class="sent_msg">-->
      <!--                  <p>Apollo University, Delhi, India Test</p>-->
      <!--                  <span class="time_date"> 11:01 AM    |    Today</span> </div>-->
      <!--              </div>-->
      <!--              <div class="outgoing_msg">-->
      <!--                  <div class="sent_msg">-->
      <!--                    <p>Apollo University, Delhi, India Test</p>-->
      <!--                    <span class="time_date"> 11:01 AM    |    Today</span> </div>-->
      <!--                </div>-->
      <!--              <div class="incoming_msg">-->
      <!--                <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>-->
      <!--                <div class="received_msg">-->
      <!--                  <div class="received_withd_msg">-->
      <!--                    <p>Test, which is a new approach to have</p>-->
      <!--                    <span class="time_date"> 11:01 AM    |    Yesterday</span></div>-->
      <!--                </div>-->
      <!--              </div>-->
      <!--            </div>-->
      <!--              <div class="type_msg">-->
      <!--              <div class="input_msg_write">-->
      <!--                <input type="text" class="write_msg" placeholder="Type a message" />-->
      <!--                <button class="msg_send_btn" type="button"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>-->
      <!--              </div>-->
      <!--            </div>-->
                   
      <!--        </div>-->
      <!--      </div>-->
      <!--</div>-->

    </main>
@endsection

@section('custom-js')

@endsection