<nav class="bottom-nav">
    <div class="py-2 d-flex">
        <a onclick="$('.tutorial-list-container').toggleClass('show')" class="sidebar-toggle-button">
            <span></span>
            <span></span>
            <span></span>
        </a>
        <a href="/" class="home-link"><i class="fas fa-home"></i></a>
        <div class="slider-wrapper">
            <a class="left"><i class="fas fa-chevron-left"></i></a>
            <div class="topics-container">
                @foreach($nav_topics as $nav_topic)
                    <a href="{{route('home.tutorials.default',$nav_topic->name)}}">{{$nav_topic->name}}</a>
                @endforeach
            </div>
            <a class="right"><i class="fas fa-chevron-right"></i></a>
        </div>
    </div>
</nav>