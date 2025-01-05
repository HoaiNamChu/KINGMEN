@extends('admin.layouts.main')


@section('content')
    <div class="container-xxl">

        <div class="row g-1">
            <div class="col-xxl-3">
                <div class="offcanvas-xxl offcanvas-start h-100" tabindex="-1" id="Contactoffcanvas"
                     aria-labelledby="ContactoffcanvasLabel">
                    <div class="card position-relative overflow-hidden">
                        <div class="card-header border-0 d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Chat</h4>
                        </div>

                        <form class="chat-search px-3">
                            <div class="chat-search-box">
                                <input class="form-control" type="text" name="search" placeholder="Search ...">
                                <button type="submit" class="btn btn-sm btn-link search-icon p-0"><i
                                            class="bx bx-search-alt"></i></button>
                            </div>
                        </form>

                        <ul class="nav nav-tabs nav-justified nav-bordered border-top mt-2">
                            <li class="nav-item">
                                <a href="#chat-list" data-bs-toggle="tab" aria-expanded="false"
                                   class="nav-link active py-2">
                                    Chat
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#group-list" data-bs-toggle="tab" aria-expanded="true"
                                   class="nav-link py-2">
                                    Group
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#contact-list" data-bs-toggle="tab" aria-expanded="true"
                                   class="nav-link py-2">
                                    Contact
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="chat-list">

                                <div class="px-3 mb-3 chat-setting-height" data-simplebar>
                                    @foreach($chatRooms as $item)
                                        <a href="{{ route('admin.chats.show', $item->id) }}" class="text-body">
                                            <div class="d-flex align-items-center p-2">
                                                <div class="flex-shrink-0 position-relative">
                                                    <img
                                                            src="{{ asset('theme/admin/assets/images/users/avatar-2.jpg') }}"
                                                            class="me-2 rounded-circle" height="36" alt="avatar-2"/>
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <h5 class="my-0">
                                                        {{ $item->customer->username ?? 'Client' }}
                                                    </h5>
                                                    <p class="mt-1 mb-0 fs-13 text-muted d-flex align-items-end justify-content-between">
                                                        <span class="w-75"></span>
                                                        {{--                                                        <i class="bx bx-check-double text-success"></i>--}}
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>


                        </div>

                    </div> <!-- end card -->
                </div>
            </div> <!-- end col -->

            <div class="col-xxl-9">
                <div class="card position-relative overflow-hidden">

                    <div class="card-header d-flex align-items-center mh-100">
                        <button class="btn btn-light d-xxl-none d-flex align-items-center px-2 me-2" type="button"
                                data-bs-toggle="offcanvas" data-bs-target="#Contactoffcanvas"
                                aria-controls="Contactoffcanvas">
                            <i class="bx bx-menu fs-18"></i>
                        </button>

                        <div class="d-flex align-items-center">
                            <img src="{{ asset('theme/admin/assets/images/users/avatar-4.jpg') }}" class="me-2 rounded"
                                 height="36"
                                 alt="avatar-4"/>
                            <div class="d-none d-md-flex flex-column">
                                <h5 class="my-0 fs-16 fw-semibold">
                                    <a data-bs-toggle="offcanvas" href="#user-profile" class="text-dark">
                                        {{ $chatRoom->customer->username ?? 'Client' }}
                                    </a>
                                </h5>
                                <p class="mb-0 text-success fw-semibold fst-italic">typing...</p>
                            </div>
                        </div>
                    </div>

                    <div class="chat-box">
                        <ul class="chat-conversation-list p-3 chatbox-height">

                            @foreach($chatRoom->messages as $item)
                                @if($item->sender_id == \Illuminate\Support\Facades\Auth::id())
                                    <li class="clearfix odd">
                                        <div class="chat-conversation-text ms-0">
                                            <div class="d-flex justify-content-end">
                                                <div class="chat-conversation-actions dropdown dropstart">
                                                    <a href="javascript: void(0);" class="pe-1"
                                                       data-bs-toggle="dropdown"
                                                       aria-expanded="false"><i
                                                                class='bx bx-dots-vertical-rounded fs-18'></i></a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="javascript: void(0);">
                                                            <i class="bx bx-share me-2"></i>Reply
                                                        </a>
                                                        <a class="dropdown-item" href="javascript: void(0);">
                                                            <i class="bx bx-share-alt me-2"></i>Forward
                                                        </a>
                                                        <a class="dropdown-item" href="javascript: void(0);">
                                                            <i class="bx bx-copy me-2"></i>Copy
                                                        </a>
                                                        <a class="dropdown-item" href="javascript: void(0);">
                                                            <i class="bx bx-bookmark me-2"></i>Bookmark
                                                        </a>
                                                        <a class="dropdown-item" href="javascript: void(0);">
                                                            <i class="bx bx-star me-2"></i>Starred
                                                        </a>
                                                        <a class="dropdown-item" href="javascript: void(0);">
                                                            <i class="bx bx-info-square me-2"></i>Mark as Unread
                                                        </a>
                                                        <a class="dropdown-item" href="javascript: void(0);">
                                                            <i class="bx bx-trash me-2"></i>Delete
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="chat-ctext-wrap">
                                                    <p>{{ $item->message }}</p>
                                                </div>
                                            </div>
                                            <p class="text-muted fs-12 mb-0 mt-1">{{ $item->created_at }}<i
                                                        class="bx bx-check-double ms-1 text-primary"></i></p>
                                        </div>
                                    </li>
                                @else
                                    <li class="clearfix">
                                        <div class="chat-conversation-text ms-0">
                                            <div class="d-flex">
                                                <div class="chat-ctext-wrap">
                                                    <p>{{ $item->message }}</p>
                                                </div>
                                                <div class="chat-conversation-actions dropdown dropend">
                                                    <a href="javascript: void(0);" class="ps-1"
                                                       data-bs-toggle="dropdown"
                                                       aria-expanded="false"><i
                                                                class='bx bx-dots-vertical-rounded fs-18'></i></a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="javascript: void(0);">
                                                            <i class="bx bx-share me-2"></i>Reply
                                                        </a>
                                                        <a class="dropdown-item" href="javascript: void(0);">
                                                            <i class="bx bx-share-alt me-2"></i>Forward
                                                        </a>
                                                        <a class="dropdown-item" href="javascript: void(0);">
                                                            <i class="bx bx-copy me-2"></i>Copy
                                                        </a>
                                                        <a class="dropdown-item" href="javascript: void(0);">
                                                            <i class="bx bx-bookmark me-2"></i>Bookmark
                                                        </a>
                                                        <a class="dropdown-item" href="javascript: void(0);">
                                                            <i class="bx bx-star me-2"></i>Starred
                                                        </a>
                                                        <a class="dropdown-item" href="javascript: void(0);">
                                                            <i class="bx bx-info-square me-2"></i>Mark as Unread
                                                        </a>
                                                        <a class="dropdown-item" href="javascript: void(0);">
                                                            <i class="bx bx-trash me-2"></i>Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="text-muted fs-12 mb-0 mt-1">{{ $item->created_at }}</p>
                                        </div>
                                    </li>
                                @endif

                            @endforeach

                        </ul> <!-- end chat-conversation-list -->
                        <div class="bg-light bg-opacity-50 p-2">
                            <form class="needs-validation" action="{{ route('admin.chats.update', $chatRoom->id) }}"
                                  name="chat-form" id="chat-form">
                                <div class="row align-items-center">
                                    <div class="col mb-2 mb-sm-0 d-flex">
                                        <div class="input-group">
                                            <a href="javascript: void(0);"
                                               class="btn btn-sm btn-light d-flex align-items-center input-group-text"><i
                                                        class="bx bx-smile fs-18"></i></a>
                                            <input type="text" class="form-control border-0 message"
                                                   placeholder="Enter your message">
                                        </div>
                                    </div>
                                    <div class="col-sm-auto">
                                        <div class="">
                                            <div class="btn-group btn-toolbar">
                                                <a href="javascript: void(0);" class="btn btn-sm btn-light"><i
                                                            class="bx bx-paperclip fs-18"></i></a>
                                                <a href="javascript: void(0);" class="btn btn-sm btn-light"><i
                                                            class="bx bx-video fs-18"></i></a>
                                                <button type="submit" class="btn btn-sm btn-primary chat-send"><i
                                                            class="bx bx-send fs-18"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                </div> <!-- end card -->
            </div> <!-- end col -->
        </div> <!-- end row -->

    </div>
@endsection
<script>
    let customerId = {{ $chatRoom->customer_id ? $chatRoom->customer_id : null}}
</script>
@section('lib-script')
    <script src="{{ asset('theme/admin/assets/js/pages/app-chat.js') }}"></script>
@endsection

