<div class="my-4 card">
    <ul>
        @foreach($project->activity as $activity)
            <li>
                @include("projects.activity.{$activity->description}")
                {{ $activity->created_at->diffForHumans() }}
            </li>
        @endforeach
    </ul>
</div>