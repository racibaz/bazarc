<div class="col-sm-6">
    <h1 class="m-0 text-dark">
        @yield('breadcrumbs')
    </h1>
</div><!-- /.col -->


<div class="col-sm-6">
    @if (Breadcrumbs::exists())
        <ol class="breadcrumb float-sm-right">
            @foreach (Breadcrumbs::generate() as $breadcrumb)

                @dd($breadcrumb)
                @if ($breadcrumb->url && !$loop->last)
                    <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
                @else
                    <li class="breadcrumb-item active">{{ $breadcrumb->title }}</li>
                @endif
            @endforeach
        </ol>
    @endif
</div><!-- /.col -->
