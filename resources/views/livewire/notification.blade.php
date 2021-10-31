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
    @if(in_array(auth()->user()->is_admin, [0,null]))
    <a href="{{ url('/riwayat/detail') }}/{{$notification->data['id_pesanan']}}" class="dropdown-item" type="button" style="font-size: small;">
        <p wire:ignore.self class="@if($notification->read_at === null){{'font-weight-bold'}}@endif"> 
            {{$notification->data['message']}}
            <span class="text-right">
        </p>
    </a>
    @elseif(in_array(auth()->user()->is_admin, [2]))
    <a href="{{ route('akpk.'.$notification->data['model_pesanan'].'.detail', [$notification->data['model_pesanan'] => $notification->data['id_pesanan']])}}" class="dropdown-item" type="button" style="font-size: small;">
        <p wire:ignore.self class="@if($notification->read_at === null){{'font-weight-bold'}}@endif"> 
            {{$notification->data['message']}}
            <span class="text-right">
        </p>
    </a>
    @elseif(in_array(auth()->user()->is_admin, [3] && $notification->data['model_pesanan'] == 'legalisir'))
    <a href="{{ route('dekan.'.$notification->data['model_pesanan'].'.detail', [$notification->data['model_pesanan'] => $notification->data['id_pesanan']])}}" class="dropdown-item" type="button" style="font-size: small;">
        <p wire:ignore.self class="@if($notification->read_at === null){{'font-weight-bold'}}@endif"> 
            {{$notification->data['message']}}
            <span class="text-right">
        </p>
    </a>
    @endif
    @empty
        {{"Empty"}}
    @endforelse
    </div>
</div>
