<div class="container" id="errorsStatus">

    <div class="row">
        <div class="span12 errorsStatusWrap">

            @if (!is_null($message = Session::get('status_error')))
            <div class="alert alert-danger">
                <a class="close" data-dismiss="alert" href="#">&times;</a>
                <h4 class="alert-heading">Oh Snap!</h4>
                @if (is_array($message))
                    <ul>
                    @foreach ($message as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                @else
                    {{ $message }}
                @endif
            </div>
            @elseif (isset($errors) && count($errors->all()) > 0)
            <div class="alert alert-danger">
                <a class="close" data-dismiss="alert" href="#">&times;</a>
                <h4 class="alert-heading">Oh Snap!</h4>
                <ul>
                    @foreach ($errors->all('<li>:message</li>') as $message)
                    {{ $message }}
                    @endforeach
                </ul>
            </div>
            @endif

            @if (!is_null($message = Session::get('status_success')))
            <div class="alert alert-success">
                <a class="close" data-dismiss="alert" href="#">&times;</a>
                <!--<h4 class="alert-heading">Success:</h4>-->
                @if (is_array($message))
                    <ul>
                    @foreach ($message as $success)
                        <li>{{ $success }}</li>
                    @endforeach
                    </ul>
                @else
                    {{ $message }}
                @endif
            </div>
            @endif

            @if (!is_null($message = Session::get('status_warning')))
            <div class="alert alert-warning">
                <a class="close" data-dismiss="alert" href="#">&times;</a>
                <h4 class="alert-heading">Warning:</h4>
                @if (is_array($message))
                <ul>
                    @foreach ($message as $warning)
                    <li>{{ $warning }}</li>
                    @endforeach
                </ul>
                @else
                {{ $message }}
                @endif
            </div>
            @endif

            @if (!is_null($message = Session::get('status_info')))
            <div class="alert alert-info">
                <a class="close" data-dismiss="alert" href="#">&times;</a>
                <h4 class="alert-heading">&nbsp;</h4>
                @if (is_array($message))
                <ul>
                    @foreach ($message as $info)
                    <li>{{ $info }}</li>
                    @endforeach
                </ul>
                @else
                {{ $message }}
                @endif
            </div>
            @endif

        </div>
    </div>

</div>
