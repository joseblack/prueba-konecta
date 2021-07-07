@if ($message = Session::get('succes'))
<div class="row justify-content-center flash-message" >
    <div class="col-md-8">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Succes!</strong> {{ $message }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
</div>  
@endif

@if ($message = Session::get('warning'))
<div class="row justify-content-center flash-message" >
    <div class="col-md-8">
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Warning!</strong> {{ $message }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
</div>  
@endif

@if ($message = Session::get('danger'))
<div class="row justify-content-center flash-message" >
    <div class="col-md-8">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Danger!</strong> {{ $message }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
</div>  
@endif
