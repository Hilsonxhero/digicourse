<x-panel-dashboard>
    <x-slot name="breadcrumb">
        <div class="breadcrumb">
            <ul>
                <li><a href="{{route('dashboard.index')}}">پیشخوان</a></li>
                <li><a href="" class="is-active">نمایش تیکت </a></li>
                <li><a href="" class="is-active">{{$ticket->title}}</a></li>
            </ul>
        </div>
    </x-slot>
    <div class="main-content">
        <div class="show-comment">
            <div class="ct__header">
                <div class="comment-info">
                    <a class="back" href="{{route('tickets.index')}}"></a>
                    <div>
                        <p class="comment-name"><a href="">{{$ticket->title}}   </a></p>
                    </div>
                </div>
            </div>
            @foreach($ticket->replies as $reply)
                <div class="transition-comment {{$reply->user_id == $ticket->user_id ? '' : 'is-answer'}}">
                    <div class="transition-comment-header">
                       <span>
                            <img src="{{$reply->user->image()}}" class="logo-pic">
                       </span>
                        <span class="nav-comment-status">
                            <p class="username">کاربر :  {{$reply->user->name}}</p>
                            <p class="comment-date">{{$reply->created_at->diffForHumans()}}</p></span>
                        <div>

                        </div>
                    </div>
                    <div class="transition-comment-body">
                        <div> {{$reply->body}}</div>

                            @if($reply->media)
                                <a class="download-box-ui" href="{{$reply->downloadLink()}}">دانلود فایل</a>
                            @endif

                    </div>
                </div>
            @endforeach

        </div>
        <div class="answer-comment">
            <p class="p-answer-comment">ارسال پاسخ</p>
            <form action="{{route('tickets.reply',$ticket->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <x-textarea name="body" placeholder="متن تیکت" class="text"></x-textarea>
                <x-file name="attachment" placeholder="فایل"></x-file>
                <button class="btn btn-webamooz_net">ارسال پاسخ</button>
            </form>
        </div>
    </div>

</x-panel-dashboard>
