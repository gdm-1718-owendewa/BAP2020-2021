@extends('layouts.app')
@section('title','TattooEase | Admin Dasboard')

@section('content')
{{-- Admin Delete Modal --}}
<div id="admin-delete-blackout"></div>
<div id="admin-delete-modal">
    <a id="admin-delete-modal-close-button" href="#">&#10005;</a>
    <div id="admin-delete-modal-content-div">
        <div id="admin-delete-modal-message-div">
            <p id="admin-delete-modal-message"></p>
        </div>
        <div id="admin-delete-modal-buttons-div">
            <a href="#" id="admin-delete-accept">Ja</a>
            <a href="#" id="admin-delete-decline">Nee</a>
        </div>  
    </div>
</div>
{{-- Admin dashbord div --}}
<div id="admin-dashbord">
    {{-- Admin dashbord sidebar --}}
    {{-- Admin dashbord main div --}}
    <div id="dashbord-main-div">
        <div id="content-head">
            <input type="text" id="admin-dash-search" placeholder=" Zoek naar content">
        </div>
        <div id="search-content-result">
        </div>
        <div id="admin-content-table">
            {{-- Toon Evenementen --}}
            @if($countdata['events'] == 0)
            @else
                <div class="content-item">
                    <h4>Evenementen</h4>    
                    <table>
                        <thead>
                            <tr>
                                <th>Gebruiker</th>
                                <th>Titel</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($data['event'] as $event)
                            <tr>
                                <td>{{$event->author}}</td>
                                <td>{{$event->title}}</td>
                                <td><a href="{{route('event-detail', $event->id)}}" class="detail-button"><i class="fas fa-info-circle"></i></a></td>
                                <td><a href="{{route('event-edit', $event->id)}}" class="edit-button"><i class="far fa-edit"></i></a></td>
                                <td><a class="admin-delete-project-button" data-t="event" data-id="{{$event->id}}" data-title="{{$event->title}}" href="#" ><i class="far fa-trash-alt"></i></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            {{-- Toon Artikelen --}}
            @if($countdata['articles'] == 0)
            @else
            <div class="content-item">
                <h4>Artikels</h4>    
                <table>
                    <thead>
                        <tr>
                            <th>Gebruiker</th>
                            <th>Titel</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['article'] as $article)
                            <tr>
                                <td>{{$article->author}}</td>
                                <td>{{$article->title}}</td>
                                <td><a href="{{route('article-detail', $article->id)}}" class="detail-button"><i class="fas fa-info-circle"></i></a></td>
                                <td><a href="{{route('article-edit', $article->id)}}" class="edit-button"><i class="far fa-edit"></i></a></td>
                                <td><a class="admin-delete-project-button" data-t="article" data-id="{{$article->id}}" data-title="{{$article->title}}" href="#" ><i class="far fa-trash-alt"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
            {{-- Toon Tutorials --}}
            @if($countdata['tutorials'] == 0)
            @else
            <div class="content-item">

                <h4>Tutorials</h4>   
                <table>
                    <thead>
                        <tr>
                            <th>Gebruiker</th>
                            <th>Titel</th>
                        </tr>
                    </thead>
                    <tbody> 
                    @foreach ($data['tutorial'] as $tutorial)
                        <tr>
                            <td>{{$tutorial->author}}</td>
                            <td>{{$tutorial->title}}</td>
                            <td><a href="{{route('tutorial-detail', $tutorial->id)}}" class="detail-button"><i class="fas fa-info-circle"></i></a></td>
                            <td><a href="{{route('tutorial-edit', $tutorial->id)}}" class="edit-button"><i class="far fa-edit"></i></a></td>
                            <td><a class="admin-delete-project-button" data-t="tutorial" data-id="{{$tutorial->id}}" data-title="{{$tutorial->title}}" href="#" ><i class="far fa-trash-alt"></i></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @endif
            {{-- Toon Discussies --}}
            @if($countdata['threads'] == 0)
            @else
            <div class="content-item">
                <h4>Discussies</h4>    
                <table>
                    <thead>
                        <tr>
                            <th>Gebruiker</th>
                            <th>Titel</th>
                        </tr>
                    </thead>
                    <tbody> 
                    @foreach ($data['thread'] as $thread)
                        <tr>
                            <td>{{$thread->author}}</td>
                            <td>{{$thread->title}}</td>
                            <td><a href="{{route('thread-detail', $thread->id)}}" class="detail-button"><i class="fas fa-info-circle"></i></a></td>
                            <td><a href="{{route('thread-edit', $thread->id)}}" class="edit-button"><i class="far fa-edit"></i></a></td>
                            <td><a class="admin-delete-project-button" data-t="thread" data-id="{{$thread->id}}" data-title="{{$thread->title}}" href="#" ><i class="far fa-trash-alt"></i></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @endif
            {{-- Toon Cursussen --}}
            @if($countdata['courses'] == 0)
            @else
            <div class="content-item">
                <h4>Cursussen</h4>    
                <table>
                    <thead>
                        <tr>
                            <th>Gebruiker</th>
                            <th>Titel</th>
                        </tr>
                    </thead>
                    <tbody> 
                    @foreach ($data['course'] as $course)
                        <tr>
                            <td>{{$course->author}}</td>
                            <td>{{$course->title}}</td>
                            <td><a href="{{route('course-detail', $course->id)}}" class="detail-button"><i class="fas fa-info-circle"></i></a></td>
                            <td><a href="{{route('course-edit', $course->id)}}" class="edit-button"><i class="far fa-edit"></i></a></td>
                            <td><a class="admin-delete-project-button" data-t="course" data-id="{{$course->id}}" data-title="{{$course->title}}" href="#" ><i class="far fa-trash-alt"></i></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @endif
            {{-- Toon Gebruikers --}}
            @if($countdata['users'] == 0)
            @else
            <div class="content-item">
                <h4>Gebruikers</h4>    
                <table>
                    <thead>
                        <tr>
                            <th>Gebruiker</th>
                            <th>Titel</th>
                        </tr>
                    </thead>
                    <tbody> 
                    @foreach ($data['user'] as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td><a href="{{route('profile', $user->id)}}" class="detail-button"><i class="fas fa-info-circle"></i></a></td>
                            <td><a href="{{route('profile-edit', $user->id)}}" class="edit-button"><i class="far fa-edit"></i></a></td>
                            <td><a class="admin-delete-project-button" data-t="user" data-id="{{$user->id}}" data-title="{{$user->name}}" href="#" ><i class="far fa-trash-alt"></i></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @endif
            {{-- Toon Commentaar --}}
            @if($countdata['comments'] == 0)
            @else
            <div class="content-item">

                <h4>Comments</h4>    
                <table>
                    <thead>
                        <tr>
                            <th>Gebruiker</th>
                            <th>Titel</th>
                        </tr>
                    </thead>
                    <tbody> 
                    @foreach ($data['comment'] as $comment)
                        <tr>
                            <td>{{$comment->author}}</td>
                            <td id="comment-content">{!! $comment->content !!}</td>
                            <td><a href="{{route('thread-detail', $comment->thread_id)}}" class="detail-button"><i class="fas fa-info-circle"></i></a></td>
                            <td><a href="{{route('edit-comment', $comment->id)}}" class="edit-button"><i class="far fa-edit"></i></a></td>
                            <td><a class="admin-delete-project-button" data-t="comment" data-id="{{$comment->id}}" data-title="{{$comment->author}}" href="#" ><i class="far fa-trash-alt"></i></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
