@extends('layouts.app')
<style>
        #users>li{
            cursor: pointer;
        }
</style>
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
    <div class="col-md-12">
            <div class="card">
                <div class="card-header">Chat</div>

                <div class="card-body">
                   <div class="row p-2"> 
                        <div class="col-10">
                            <div class="row">
                                <div class="col-12 border rounded-lg p-3">
                                    <ul id="messages" class="list-unstyled overflow-auto" style="height:45vh">
                                    </ul>
                                </div>
                            </div>
                            <div class="row">
                                <form>
                                    <div class="row py-3">
                                        <div class="col-10">
                                            <input type="text" class="form-control" id="message">
                                        </div>
                                        <div class="col-2">
                                            <button id="send" type="submit" class="btn btn-primary btn-block">Send</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-2">
                            <p><strong>Online Now</strong></p>
                            <ul id="users" class="list-unstyled overflow-auto text-info" style="height:45vh">
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    const usersElement= document.getElementById('users');
    const messagesElement= document.getElementById('messages');

    document.onreadystatechange = function () {
    if (document.readyState === 'complete') {


        Echo.join('chat')
            .here((users)=>{
                users.forEach((user,index)=>{
                    let element=document.createElement('li');
                    element.setAttribute('id',user.id);
                    element.setAttribute('onclick','greetUser("'+user.id+'")');
                    element.innerText= user.name;
                    usersElement.appendChild(element);
                });
            })
            .joining((user)=>{
                let element=document.createElement('li');
                    element.setAttribute('id',user.id);
                    element.setAttribute('onclickid','greetUser("'+user.id+'")');
                    element.innerText= user.name;
                    usersElement.appendChild(element);
            })
            .leaving((user)=>{
                const element=document.getElementById(users.id); 
                element.parentNode.removeChild(element);
            })
            .listen('MessageSent',(e)=>{
                let element=document.createElement('li');
                    element.innerText=e.user.name+": "+e.message;
                    messagesElement.appendChild(element);
            });

            Echo.private('chat.greet.{{ auth()->user()->id }}')
                .listen('GreetingSent',(e)=>{
                    let element=document.createElement('li');
                    element.innerText=e.message;
                    element.classList.add('pm');
                    messagesElement.appendChild(element);
                });
    }};
</script>

<script>
    const messageElement= document.getElementById('message');
    const sendElement= document.getElementById('send');

    sendElement.addEventListener('click',(e)=>{
            e.preventDefault();
            axios.post('/chat/message',{
                message: messageElement.value,
            });

            messageElement.value='';
            })
</script>

<script>
    function greetUser(id){
        axios.post('/chat/greet/'+id);
    }
</script>

<script>
</script>
@endsection
