@extends("master")

@section("title")
    GitHub Repositories
@endsection

@section("content")
    <div class="container">
        <div class="content-block">
            <div class="blue">
                <center>
                    <h1>Take a Look Below at Some of My Projects!</h1>
                </center>
            </div>
        </div>
        <div class="content-block">
            <div class="gray">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Repository Name</th>
                            <th>Description</th>
                            <th>Language</th>
                            <th>Commits in the Last 30 Days</th>
                            <th>Most Recent Commit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($all_repos as $r)
                            <tr class="clickable" onclick="window.open('{{ $r->url }}');">
                                <td>{{ $r->name }}</td>
                                <td>{{ str_limit($r->desc, 40) }}</td>
                                <td>{{ $r->lang }}</td>
                                <td>{{ $r->commits }}</td>
                                <td>{{ $r->most_recent_commit }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <center><a href="https://github.com/iccowan" target="_blank"><i><h5>View all of my Projects!</h5></i></a></center>
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
