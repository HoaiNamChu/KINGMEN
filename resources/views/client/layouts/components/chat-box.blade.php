
<div class="chat-box position-fixed bottom-0 end-0 m-3 shadow">
    <div class="chat-header bg-primary text-white p-2 d-flex justify-content-between align-items-center">
        <span>Hỗ trợ trực tuyến</span>
        <button class="btn btn-sm btn-light toggle-chat-btn">+</button>
    </div>
    <div class="chat-body bg-light p-2 d-none" style="max-height: 300px; overflow-y: auto;">
        <p class="mb-2">Xin chào! Tôi có thể giúp gì cho bạn?</p>
        <ul class="chat-box-list">
{{--            @if(\Auth::check() && \Auth::user()->chatRoomCustomer())--}}
{{--                @foreach(\Auth::user()->chatRoomCustomer()->with('messages')->first()->messages as $item)--}}
{{--                    @if($item->sender_id == Auth::id())--}}
{{--                        <li class="clearfix odd">--}}
{{--                            <div class="chat-conversation-text ms-0">--}}
{{--                                <div class="d-flex justify-content-end">--}}
{{--                                    <div class="chat-ctext-wrap">--}}
{{--                                        <p>{{ $item->message }}</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <p class="text-muted fs-12 mb-0 mt-1 d-flex justify-content-end">{{ $item->created_at }}<i class="bx bx-check-double ms-1 text-primary"></i></p>--}}
{{--                            </div>--}}
{{--                        </li>--}}
{{--                    @else--}}
{{--                        <li class="clearfix">--}}
{{--                            <div class="chat-conversation-text">--}}
{{--                                <div class="d-flex">--}}
{{--                                    <div class="chat-ctext-wrap">--}}
{{--                                        <p>{{ $item->message }}</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <p class="text-muted fs-12 mb-0 mt-1 ms-2">{{ $item->created_at }}</p>--}}
{{--                            </div>--}}
{{--                        </li>--}}
{{--                    @endif--}}
{{--                @endforeach--}}
{{--            @endif--}}
        </ul>
    </div>
    <div class="chat-footer bg-white p-2 border-top d-none">
        <div class="input-group">
            <input type="text" class="form-control message" placeholder="Nhập tin nhắn...">
            <button class="btn btn-primary btn-send">Gửi</button>
        </div>
    </div>
</div>

