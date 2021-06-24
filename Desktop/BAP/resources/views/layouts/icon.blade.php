<?php 
    if(Auth::user()){
    $userId = Auth::user()->id;
    $count = DB::table('ch_messages')
                ->where(['to_id'=> $userId, 'seen' => 0])
                ->get(); 
    $totalNewMessages = count($count);
    }
    
?>
@auth
    <div id="message-icon-div">
        <div id="count-div">
            @if(isset($totalNewMessages))
                {{$totalNewMessages}}
            @endif
        </div>
        <div id="link-div">
            <a href="{{route('chatify')}}" id="link-div-button"><i class="fas fa-comments"></i></a>
        </div>
    </div>
@endauth