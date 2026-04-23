
<h2>{{$sideBarData['title']}}</h2>

<div class="sidebar-sticky">
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link active" href="#">Home</a>
        </li>
        <table>
            @foreach (config('app.available_locales') as $key => $local_name)
            <tr>
                <td><a href="{{ route('admin.language.set', $local_name)}}">{{ $key}}</a></td>
                <td>- </td>
            </tr>
            @endforeach
        </table>            
            <!-- Add more languages as needed -->
        </li>
    </ul>
    
</div>
