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
        <div class="content-block">
            <div class="gray">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="aspect-ratio">
                            <iframe width="560" height="360" src="https://www.youtube.com/embed/txkNwm0S-yk" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <h3>Flight Vlog - First Flight as an INSTRUMENT PILOT to AGS!!</h3>
                        <i><p>17 Views - Apr 20, 2019</p></i>
                        <p>Thank you for watching! This is my first video as an instrument rated private pilot filmed back in December, 2018. My private pilot certificate and my instrument rating have been a long work in progress and I’m excited to say they’re complete! Now onto commercial! I hope you enjoyed! Please make sure to like and subscribe! Music: Your Eyes, by Joey Pecoraro (http://bit.ly/2VYbBkX) Disclaimer: This video is not to be used as a substitute for proper ground/flight training.</p>
                    </div>
                </div>
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
