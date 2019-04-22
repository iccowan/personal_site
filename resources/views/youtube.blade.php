@extends("master")

@section("title")
    YouTube Videos
@endsection

@section("content")
    <div class="container">
        <div class="content-block">
            <div class="blue">
                <center>
                    <h1>Take a Look at My Recent YouTube Videos!</h1>
                </center>
            </div>
        </div>
        @foreach($videos as $v)
            <div class="content-block">
                <div class="gray">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="aspect-ratio">
                                <iframe width="560" height="360" src="https://www.youtube.com/embed/{{ $v->video_id }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <h3>{{ $v->title }}</h3>
                            <i><p>{{ number_format($v->views) }} Views - {{ $v->upload_date }}</p></i>
                            <p>{{ $v->desc }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="content-block">
            <div class="blue">
                <center><a href="https://www.youtube.com/channel/UCfEj4FfmymrdtcENSrRbdhw" target="_blank"><h3>Check Out More of my Videos!</h3></a></center>
            </div>
        </div>
    </div>

<script>
// Add is-selected when hovering over a row
$('.clickable').hover(
    function(){ $(this).addClass('is-selected'); $(this).css('cursor', 'pointer')},
    function(){ $(this).removeClass('is-selected') }
)
</script>
@endsection
