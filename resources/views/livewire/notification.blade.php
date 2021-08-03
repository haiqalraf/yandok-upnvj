<div wire:ignore.self>
    <a wire:click="read" style="text-decoration: none;" class="btn btn-light" data-toggle="dropdown" href="#"
    aria-expanded="@if($dropdown){{'true'}}@else{{'false'}}@endif">

        <i class="fa fa-bell-o fa-fw align-self-center mb-2" aria-hidden="true"></i>
        @if ($showCount)
        <span class="badge badge-danger">{{$count}}</span>
        @endif

    </a>
    <div wire:ignore.self class="dropdown-menu dropdown-menu-sm-right pre-scrollable">
    @forelse (auth()->user()->notifications as $notification)
        <a href="{{route('alur')}}" class="dropdown-item" type="button" style="font-size: small;">
            <p wire:ignore.self class="@if($notification->read_at === null){{'font-weight-bold'}}@endif"> 
                {{$notification->data['message']}}
                <span class="text-right">
            </p>
        </a>
    @empty
        {{"Empty"}}
    @endforelse
    </div>
</div>
