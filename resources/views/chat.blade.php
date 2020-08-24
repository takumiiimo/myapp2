@extends('layouts.app')
@include('navbar')
@include('footer')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        </div>
    </div>
    <div id="room">
        @foreach($messages as $key => $message)
            <!--送信-->
            @if($message->send == Auth::user()->id)
            <div class="send" style="text-align: right">
                <p>{{ $message->message }}</p>
            </div>
            @endif
            <!-- 受信 -->
            @if($message->recieve == Auth::user()->id)
            <div class="recieve" style="text-align: left">
                <p>{{ $message->message }}</p>
            </div>    
            @endif
        @endforeach
    </div>
    
    <form>
        <textarea name="message" style="width:100%"></textarea>
        <button type="button" id="btn_send">送信</button>
    </form>
    
    <input type="hidden" name="send" value="{{ $param['send'] }}">
    <input type="hidden" name="recieve" value="{{ $param['recieve'] }}">
    <input type="hidden" name="login" value="{{ Auth::user()->id }}">
</div>
@endsection
@section('script')
    <script type="text/javascript">
        // ログを有効にする
        Pusher.logToConsole = true;
        
        var pusher = new Pusher('dad5c8fb37c27e8f02ae' , {
            cluster : 'ap3' ,
            encrypted: true 
        });
        
        // 購読するチャンネルを指定
        var pusherChannel = pusher.subscribe('chat');
        
        // イベントを受信したら、以下を処理
        pusherChannel.bind('chat_event', function(data) {
            let appendText;
            let login = $('input[name="login"]').val();
            
            if(data.send === login) {
                appendText = '<div class="send" style="text-align:right"><p>' + data.message + '</p></div> ';
            }else if(data.recieve === login) {
                appendText = '<div class="recieve" style="text-align:left"><p>' + data.message + '</p></div> ';
            }else {
                return false;
            }
            
            // メッセージを表示
            $("#room").append(appendText);
            
            if(data.recieve === login ) {
                Push.create("新着メッセージ",
                {
                    body: data.message,
                    timeout: 8000,
                    onClick: function () {
                        window.focus();
                        this.close();
                    }
                })
            }
        });
        
        $.ajaxSetup({
            headers : {
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content'),
            }});
            
        // メッセージ送信
        $('#btn_send').on('click' , function(){
            $.ajax({
                type : 'POST',
                url : '/chat/send',
                data : {
                    message : $('textarea[name="message"]').val(),
                    send : $('input[name="send"]').val(),
                    recieve : $('input[name="recieve"]').val(),
                }
            }).done(function(result){
                $('textarea[name="message"]').val('');
            }).fail(function(result){
            })
        });
    </script>
@endsection    